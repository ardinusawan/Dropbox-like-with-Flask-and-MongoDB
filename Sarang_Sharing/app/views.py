from app import app, lm
from flask import request, redirect, render_template, url_for, flash
from flask.ext.login import login_user, logout_user, login_required
from .forms import LoginForm
from .user import User
from .object import *

from flask import Flask, request, redirect, url_for, make_response, abort
from werkzeug import secure_filename

from pymongo import MongoClient
from bson.objectid import ObjectId

from gridfs import GridFS
from gridfs.errors import NoFile

import collections
import bson
from bson.codec_options import CodecOptions
from copy import *

USER_LOGIN = []

ALLOWED_EXTENSIONS = set(['txt', 'pdf', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'exe', 'deb'])
# FILE_LOCATION = '/home/ardi/PycharmProjects/KomputasiAwanGG/Sarang_Sharing/app/FILES/'

DB = MongoClient(["localhost:27017"]).gridfs_server  # DB Name
# DB = MongoClient(["localhost:27017"])["gridfs_server"]["filess"]
# FS = GridFS(DB.database)
FS = GridFS(DB)

users = MongoClient(["localhost:27017"])["gridfs_server"]["users"]


def allowed_file(filename):
    return '.' in filename and \
           filename.rsplit('.', 1)[1] in ALLOWED_EXTENSIONS

@app.route('/')
def home():
    return render_template('home.html')


@app.route('/login', methods=['GET', 'POST'])
def login():
    global USER_LOGIN
    form = LoginForm()
    if request.method == 'POST' and form.validate_on_submit():
        user = app.config['USERS_COLLECTION'].find_one({"_id": form.username.data})
        if user and User.validate_login(user['password'], form.password.data):
            user_obj = User(user['_id'])
            login_user(user_obj)
            a = str(user_obj.username)
            USER_LOGIN = ""
            # try:
            USER_LOGIN = a
            # finally:
            # return USER_LOGIN
            flash("Logged in successfully!", category='success')
            return redirect(request.args.get("next") or url_for("write"))
        flash("Wrong username or password!", category='error')
    return render_template('login.html', title='login', form=form)


@app.route('/logout')
def logout():
    # print USER_LOGIN
    logout_user()
    return redirect(url_for('login'))


@app.route('/write', methods=['GET', 'POST'])
@login_required
def write():
    return render_template('write.html')


##





def find_money_limit():
    u = app.config['USERS_COLLECTION'].find_one({"_id": USER_LOGIN})
    money_user = (u['money'])
    limit_user = (u['limit'])
    mylist = [money_user,limit_user]
    return (mylist)

def is_money_not_enough(money):
    u = app.config['USERS_COLLECTION'].find_one({"_id": USER_LOGIN})
    print "uang =" + str(money)
    print "money = " + str((u['money']))
    if (int(money) - int((u['money']))   < 0):
        return 1
    else:
        return 0

def check(money,limit):
    u = app.config['USERS_COLLECTION'].find_one({"_id": USER_LOGIN})
    if money<0:
        return refill_money()
    else:
        update_data_limit(money,limit)
        return render_template('main.html')

@app.route('/settings', methods=['GET', 'POST'])
@login_required
def settings():
    if request.method == 'POST':
        if request.form['submit'] == '1 MB = 10K':
            money = find_money_limit()[0] - 10000
            limit = find_money_limit()[1] + 1000000
            return check(money,limit)

        elif request.form['submit'] == '5 MB = 50K':
            money = find_money_limit()[0] - 50000
            limit = find_money_limit()[1] + 5000000
            return check(money,limit)
        elif request.form['submit'] == '10 MB = 100K':
            money = find_money_limit()[0] - 100000
            limit = find_money_limit()[1] + 10000000
            return check(money,limit)
        elif request.form['submit'] == '15 MB = 150K':
            money = find_money_limit()[0] - 150000
            limit = find_money_limit()[0] + 15000000
            return check(money,limit)
    elif request.method == 'GET':
        tmp = check_user()
        if tmp:
            size = count_usage()
            update_usage_user(size)
            u = app.config['USERS_COLLECTION'].find_one({"_id": USER_LOGIN})
            money_user = (u['money'])
            limit_user = (u['limit'])
            return render_template('settings.html',size=size,money_user=money_user,limit_user=limit_user)
        else:
            return render_template('settings.html')

@app.route('/refill',methods=['GET', 'POST'])
@login_required
def refill_money():
    return render_template('refill_money.html')

@app.route('/share/<oid>')
@login_required
def share(oid):
    # FS.delete(ObjectId(oid))
    for grid_out in FS.find({'_id': ObjectId(oid) }):
        data = grid_out
        FS.put(FS.get(ObjectId(oid)),share= True,contentType=data.content_type,filename=data.filename,user=USER_LOGIN)
        FS.delete(ObjectId(oid))
    return upload_file()

@app.route('/main', methods=['GET', 'POST'])
@login_required
def upload_file():
    if request.method == 'POST':
        file = request.files['file']
        if file and allowed_file(file.filename):
            filename = secure_filename(file.filename)

            oid = FS.put(file, content_type=file.content_type, user=USER_LOGIN, filename=filename,share=False)
            # tolong jangan dihapus
            # outputdata = FS.get(oid).read()
            # file_name = FS.get(oid).filename
            # file_save = FILE_LOCATION + file_name
            # outfilename = file_save
            # output = open(outfilename,'wb')
            # output.write(outputdata)
            # output.close()
            # tolong jangan dihapus
            return redirect(url_for('serve_gridfs_file', oid=str(oid)))
    return render_template('main.html')

    # return '''
    # <!DOCTYPE html>
    # <html>
    # <head>
    # <title>Upload new file</title>
    # </head>
    # <body>
    # <h1>Upload new file</h1>
    # <form action="" method="post" enctype="multipart/form-data">
    # <p><input type="file" name="file"></p>
    # <p><input type="submit" value="Upload"></p>
    # </form>
    # <a href="%s">All files</a>
    # </body>
    # </html>
    # ''' % url_for('list_gridfs_files')


def check_user():
    if not USER_LOGIN:
        return False;
    else:
        return True;


@app.route('/files')
@login_required
def list_gridfs_files():
    tmp = check_user()
    if tmp:
        data_user_filename = []
        data_user_obj = []
        # banyak_data = 0
        # print FS.exists(user="ardinusawan")
        for grid_out in FS.find({"user": USER_LOGIN}):
            data = grid_out
            print data.filename
            data_user_filename.append(str(data.filename))
            data_user_obj.append(str(data._id))
            # banyak_data += 1
        # print data_user_filename;
        # print FS.list()
        # files = [FS.get_last_version(file) for file in data_user_filename]
        #
        #
        # file_list = "\n".join(['<li><a href="%s">%s</a></li>' %
        #                       (url_for('serve_gridfs_file', oid=str(file._id)),
        #                        file.name) for file in files])
        print '########################################'
        Object.filename = data_user_filename
        Object.object_name = data_user_obj
        print Object.filename
        print Object.object_name
        return render_template('files.html', file_object=Object)
    else:
        # myuser = User.get_id()
        return render_template('files.html')
        # return render_template('files.html', file_object=file_list)
        # return render_template('files.html', file_object=data_user_obj, file_username=data_user_filename)

        # return '''
        # <!DOCTYPE html>
        # <html>
        # <head>
        # <title>Files</title>
        # </head>
        # <body>
        # <h1>Files</h1>
        # <ul>
        # %s
        # </ul>
        # <a href="%s">Upload new file</a>
        # </body>
        # </html>
        # ''' % (file_list, url_for('upload_file'))


@app.route('/files/<oid>')
@login_required
def serve_gridfs_file(oid):
    try:
        # Convert the string to an ObjectId instance
        file_object = FS.get(ObjectId(oid))
        response = make_response(file_object.read())
        response.mimetype = file_object.content_type
        return response
    except NoFile:
        abort(404)

@app.route('/delete/<oid>')
@login_required
def delete(oid):
    FS.delete(ObjectId(oid))
    return upload_file()



@lm.user_loader
def load_user(username):
    u = app.config['USERS_COLLECTION'].find_one({"_id": username})
    if not u:
        return None
    return User(u['_id'])


def count_usage():
    size = 0
    for grid_out in FS.find({"user": USER_LOGIN}):
        data = grid_out
        size += data.length
        print size
    return size
    # print data.filename
    # data_user_filename.append(str(data.filename))
    # data_user_obj.append(str(data._id))
    # banyak_data +=1


def update_usage_user(size):
    users.update({
        "_id": USER_LOGIN
    }, {
        '$set': {
            "usage": size
        }
    }, upsert=False)


def update_data_limit(money,limit):
    users.update({
        "_id": USER_LOGIN
    }, {
        '$set': {
            "money": money,
            "limit": limit
        }
    }, upsert=False)