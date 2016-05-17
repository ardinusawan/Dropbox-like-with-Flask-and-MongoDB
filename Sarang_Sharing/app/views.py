import flask
from flask.ext.json import json_response

from app import app, lm
from flask import request, redirect, render_template, url_for, flash
from flask.ext.login import login_user, logout_user, login_required,current_user
from .forms import LoginForm
from .forms import RegisterForm
from .user import User
from .object import *
import json

from flask import Flask, request, redirect, url_for, make_response, abort
from werkzeug import secure_filename

from bson.objectid import ObjectId

from gridfs import GridFS
from gridfs.errors import NoFile

from werkzeug.security import generate_password_hash
from pymongo import MongoClient
from pymongo.errors import DuplicateKeyError

import collections
import bson
from bson.codec_options import CodecOptions
from copy import *


USER_LOGIN = []

ALLOWED_EXTENSIONS = set(['txt', 'pdf', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'exe', 'deb', 'doc', 'xls', 'ppt', 'pps', 'odt', 'ods', 'odp', 'docx'])

DB = MongoClient(["localhost:27017"]).gridfs_server
FS = GridFS(DB)

users = MongoClient(["localhost:27017"])["gridfs_server"]["users"]


def allowed_file(filename):
    return '.' in filename and \
           filename.rsplit('.', 1)[1] in ALLOWED_EXTENSIONS


@app.route('/', methods=['GET'])
def home():
    # if request.method == 'GET' and current_user.is_authenticated():
    if request.method == 'GET' and USER_LOGIN:
        # user = app.config['USERS_COLLECTION'].find_one({"_id": current_user.username})
        user = app.config['USERS_COLLECTION'].find_one({"_id": USER_LOGIN})
        if user:
            # Message = "Hey " + current_user.username + "!"
            Message = "Hey " + USER_LOGIN+ "!"
            return flask.jsonify(Message=Message)
    return flask.jsonify(Message="Welcome to Sharang Sharing, please login")

@app.route("/register", methods=['GET','POST'])
def register():
    if request.method == 'GET':
        return json.dumps({"register":"Hallo this is register page"})
    if request.method == 'POST':
        collection = MongoClient()["gridfs_server"]["users"]
        username_post = request.form['username_post']
        password_post = request.form['password_post']
        user = app.config['USERS_COLLECTION'].find_one({"_id": username_post})
        if not user:
            user = username_post
            password = password_post
            pass_hash = generate_password_hash(password, method='pbkdf2:sha256')
            collection.insert({"_id": user, "password": pass_hash, "usage": 0, "limit": 3000000, "money": 0})
            return flask.jsonify(Message='data inserted')
        return flask.jsonify(Message="Maaf, data telah ada")

@app.route("/login", methods=['GET','POST'])
def login():
    # global USER_LOGIN
    if request.method == 'POST':
        username_post = request.form['username_post']
        password_post = request.form['password_post']
        user = app.config['USERS_COLLECTION'].find_one({"_id": username_post})
        if user and User.validate_login(user['password'],password_post):
            user_obj = User(user['_id'])
            login_user(user_obj)
            # return flask.jsonify(Message='True')
            return json_response(Message='True')
        return flask.jsonify(Message="Wrong username or password")
    if request.method == 'GET':
        return flask.jsonify(Message="Hello this is login page")


@app.route('/logout',methods=['GET'])
def logout():
    # global USER_LOGIN
    logout_user()
    # USER_LOGIN=""
    return flask.jsonify(Message="Logout Success")

@app.route('/upload/<file_name>,<file_type>', methods=['PUT'])
def upload(file_name,file_type):
    # with FS.new_file(filename=file_name+"."+file_type, content_type=file_type ,user=current_user.username, share="No") as fp:
    with FS.new_file(filename=file_name+"."+file_type, content_type=file_type ,user=USER_LOGIN, share="No") as fp:
        fp.write(request.data)
        file_id = fp._id
    if FS.find_one(file_id) is not None:
        return flask.jsonify(Message='File saved successfully'),200
    else:
        return flask.jsonify(Message='Error occurred while saving file.'), 500

@app.route('/download/<file_name>')
def index(file_name):
    grid_fs_file = FS.find_one({'filename': file_name})
    response = make_response(grid_fs_file.read())
    response.headers['Content-Type'] = 'application/octet-stream'
    response.headers["Content-Disposition"] = "attachment; filename={}".format(file_name)
    return response

@app.route('/main', methods=['GET'])
@login_required
def upload_file():
    if request.method == 'GET':
        # return flask.jsonify(List_Data=FS.list(), current_user=current_user.username)
        return flask.jsonify(List_Data=FS.list(), current_user=current_user.username)


@app.route('/settings', methods=['GET', 'POST'])
@login_required
def settings():
    if request.method == 'POST':
        if request.form['submit'] == '1 MB = 10K':
            money = find_money_limit()[0] - 10000
            limit = find_money_limit()[1] + 1000000
            return check(money, limit)
        elif request.form['submit'] == '5 MB = 50K':
            money = find_money_limit()[0] - 50000
            limit = find_money_limit()[1] + 5000000
            return check(money, limit)
        elif request.form['submit'] == '10 MB = 100K':
            money = find_money_limit()[0] - 100000
            limit = find_money_limit()[1] + 10000000
            return check(money, limit)
        elif request.form['submit'] == '15 MB = 150K':
            money = find_money_limit()[0] - 150000
            limit = find_money_limit()[0] + 15000000
            return check(money, limit)
    elif request.method == 'GET':
        # if current_user.is_authenticated():
        if USER_LOGIN:
            size = count_usage()
            update_usage_user(size)
            # u = app.config['USERS_COLLECTION'].find_one({"_id": current_user.username})
            u = app.config['USERS_COLLECTION'].find_one({"_id": USER_LOGIN})
            money_user = (u['money'])
            limit_user = (u['limit'])
            # return flask.jsonify(current_user=current_user.username,size=size, money_user=money_user, limit_user=limit_user)
            return flask.jsonify(current_user=USER_LOGIN,size=size, money_user=money_user, limit_user=limit_user)
        else:
            return flask.jsonify(Message="Nothing to see")

def count_usage():
    size = 0
    # for grid_out in FS.find({"user": current_user.username}):
    for grid_out in FS.find({"user": USER_LOGIN}):
        data = grid_out
        size += data.length
        print size
    return size

def update_usage_user(size):
    users.update({
        # "_id": current_user.username
        "_id": USER_LOGIN
    }, {
        '$set': {
            "usage": size
        }
    }, upsert=False)


def find_money_limit():
    # u = app.config['USERS_COLLECTION'].find_one({"_id": current_user.username})
    u = app.config['USERS_COLLECTION'].find_one({"_id": USER_LOGIN})
    money_user = (u['money'])
    limit_user = (u['limit'])
    mylist = [money_user, limit_user]
    return (mylist)

def check(money, limit):
    # u = app.config['USERS_COLLECTION'].find_one({"_id": current_user.username})
    u = app.config['USERS_COLLECTION'].find_one({"_id": USER_LOGIN})
    if money < 0:
        # return refill_money()
        return flask.jsonify(Message="Uang anda tidak cukup saatnya membeli saldo pada page refill")
    else:
        update_data_limit(money, limit)
        return flask.jsonify(Message="Success")


def update_data_limit(money, limit):
    users.update({
        # "_id": current_user.username
        "_id": USER_LOGIN
    }, {
        '$set': {
            "money": money,
            "limit": limit
        }
    }, upsert=False)

@app.route('/refill', methods=['GET', 'POST'])
@login_required
def refill_money():
    if request.method == 'POST':
        if request.form['submit'] == '100K':
            money = find_money_limit()[0] + 100000
            return update_money(money)
        elif request.form['submit'] == '200K':
            money = find_money_limit()[0] + 200000
            return update_money(money)
        elif request.form['submit'] == '300K':
            money = find_money_limit()[0] + 300000
            return update_money(money)
        elif request.form['submit'] == '400K':
            money = find_money_limit()[0] + 400000
            return update_money(money)
    elif request.method == 'GET':
        return flask.jsonify(Message="refill your money!")


def update_money(money):
    # u = app.config['USERS_COLLECTION'].find_one({"_id": current_user.username})
    u = app.config['USERS_COLLECTION'].find_one({"_id": USER_LOGIN})
    update_data_money(money)
    return flask.jsonify(Message="Success adding "+str(money))

def update_data_money(money):
    users.update({
        # "_id": current_user.username
        "_id": USER_LOGIN
    }, {
        '$set': {
            "money": money
        }
    }, upsert=False)

@app.route('/share/<flag>/<oid>')
@login_required
def share(flag,oid):
    for grid_out in FS.find({'_id': ObjectId(oid)}):
        data = grid_out
        # FS.put(FS.get(ObjectId(oid)), share=flag, contentType=data.content_type, filename=data.filename, user=current_user.username)
        FS.put(FS.get(ObjectId(oid)), share=flag, contentType=data.content_type, filename=data.filename, user=USER_LOGIN)

        FS.delete(ObjectId(oid))
    return flask.jsonify(Message="Success edit share flag to "+flag)
#masih ngebug kalo ubah flag ke NO

@app.route('/files')
@login_required
def list_gridfs_files():
    # if current_user.is_authenticated():
    if USER_LOGIN:
        data_user_filename = []
        data_user_obj = []
        data_sharing = []
        # for grid_out in FS.find({"user": current_user.username}):
        for grid_out in FS.find({"user": USER_LOGIN}):
            data = grid_out
            print data.filename
            data_user_filename.append(str(data.filename))
            data_user_obj.append(str(data._id))
            data_sharing.append(str(data.share))
        Object.filename = data_user_filename
        Object.object_name = data_user_obj
        Object.share = data_sharing
        print Object.filename
        print Object.object_name
        print Object.share
        # return flask.jsonify(Message=Object)
        # return flask.jsonify(current_user=current_user.username,Message={"filename":Object.filename,"object_name":Object.object_name,"share_flag":Object.share})
        return flask.jsonify(current_user=USER_LOGIN,Message={"filename":Object.filename,"object_name":Object.object_name,"share_flag":Object.share})


@app.route('/files/<oid>')
@login_required
def serve_gridfs_file(oid):
    try:
        file_object = FS.get(ObjectId(oid))
        response = make_response(file_object.read())
        response.mimetype = file_object.content_type
        return response
    except NoFile:
        abort(404)

@app.route('/AllFiles')
@login_required
def list_all_gridfs_files():
    data_user_filename = []
    data_user_obj = []
    data_sharing = []
    for grid_out in FS.find({"share": "Yes"}):
        data = grid_out
        print data.filename
        data_user_filename.append(str(data.filename))
        data_user_obj.append(str(data._id))
        data_sharing.append(str(data.share))
    Object.filename = data_user_filename
    Object.object_name = data_user_obj
    Object.share = data_sharing
    print Object.filename
    print Object.object_name
    print Object.share
    return flask.jsonify(Message={"filename":Object.filename,"object_name":Object.object_name,"share_flag":Object.share})


@app.route('/delete/<oid>')
@login_required
def delete(oid):
    FS.delete(ObjectId(oid))
    return flask.jsonify(Message="Success Deleted")


@lm.user_loader
def load_user(username):
    u = app.config['USERS_COLLECTION'].find_one({"_id": username})
    if not u:
        return None
    return User(u['_id'])



