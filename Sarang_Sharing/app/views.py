
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

from copy import *
USER_LOGIN = []
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


@app.route('/settings', methods=['GET', 'POST'])
@login_required
def settings():
    tmp = check_user()
    if tmp:
        size = count_usage()
        return render_template('settings.html',size=size)
    else:
        return render_template('settings.html')

##




ALLOWED_EXTENSIONS = set(['txt', 'pdf', 'png', 'jpg', 'jpeg', 'gif', 'svg'])
FILE_LOCATION = '/home/ardi/PycharmProjects/KomputasiAwanGG/Sarang_Sharing/app/FILES/'

DB = MongoClient().gridfs_server_test  # DB Name
FS = GridFS(DB)

# app = Flask(__name__)


def allowed_file(filename):
    return '.' in filename and \
            filename.rsplit('.', 1)[1] in ALLOWED_EXTENSIONS


@app.route('/main', methods=['GET', 'POST'])
@login_required
def upload_file():
    if request.method == 'POST':
        file = request.files['file']
        if file and allowed_file(file.filename):
            filename = secure_filename(file.filename)

            # print USER_LOGIN
            oid = FS.put(file, content_type=file.content_type, user=USER_LOGIN, location = FILE_LOCATION, filename=filename)
            outputdata = FS.get(oid).read()
            file_name = FS.get(oid).filename
            # print file_name
            file_save = FILE_LOCATION + file_name
            outfilename = file_save
            output = open(outfilename,'wb')
            output.write(outputdata)
            output.close()

            #
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
        banyak_data = 0
        # print FS.exists(user="ardinusawan")
        for grid_out in FS.find({"user": USER_LOGIN}):
            data = grid_out
            print data.filename
            data_user_filename.append(str(data.filename))
            data_user_obj.append(str(data._id))
            banyak_data +=1
        print data_user_filename;
        print FS.list()
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
        return render_template('files.html', file_object=Object,file_count=banyak_data)
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

##
@app.route('/update/<oid>')
@login_required
def update(oid):
    try:
        # Convert the string to an ObjectId instance
        file_object = FS.get(ObjectId(oid))
        response = make_response(file_object.read())
        response.mimetype = file_object.content_type
        print file_object.upload_date
        return response
    except NoFile:
        abort(404)

@app.route('/dict/<oid>')
def dict(oid):
    file_object = FS.get(ObjectId(oid))

    return '''
    aa
    '''



##

# if __name__ == '__main__':
    # app.run(host='0.0.0.0', debug=True)

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
