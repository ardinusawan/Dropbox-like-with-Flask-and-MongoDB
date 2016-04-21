'''
tutorial api : http://api.mongodb.org/python/current/api/gridfs/
http://flask.pocoo.org/docs/0.10/patterns/fileuploads/
https://api.mongodb.org/python/current/examples/gridfs.html
/home/ardi/PycharmProjects/KomputasiAwanGG/images
Flask-PyMongo : https://flask-pymongo.readthedocs.org/en/latest/
'''
from flask import Flask, request, redirect, url_for, make_response, abort
from werkzeug import secure_filename

from pymongo import MongoClient
from bson.objectid import ObjectId

from gridfs import GridFS
from gridfs.errors import NoFile

import collections
import bson
from bson.codec_options import CodecOptions

ALLOWED_EXTENSIONS = set(['txt', 'pdf', 'png', 'jpg', 'jpeg', 'gif', 'svg'])
FILE_LOCATION = '/home/ardi/PycharmProjects/KomputasiAwanGG/flask_gridfs_server/FILE/'

DB = MongoClient().gridfs_server_test  # DB Name
FS = GridFS(DB)

app = Flask(__name__)


def allowed_file(filename):
    return '.' in filename and \
            filename.rsplit('.', 1)[1] in ALLOWED_EXTENSIONS


@app.route('/', methods=['GET', 'POST'])
def upload_file():
    if request.method == 'POST':
        file = request.files['file']
        if file and allowed_file(file.filename):
            filename = secure_filename(file.filename)
            oid = FS.put(file, content_type=file.content_type,
                         filename=filename)
            #
            outputdata = FS.get(oid).read()
            file_name = FS.get(oid).filename
            file_save = FILE_LOCATION + file_name
            outfilename = file_save
            output = open(outfilename,'wb')
            output.write(outputdata)
            output.close()
            #
            return redirect(url_for('serve_gridfs_file', oid=str(oid)))
    return '''
    <!DOCTYPE html>
    <html>
    <head>
    <title>Upload new file</title>
    </head>
    <body>
    <h1>Upload new file</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <p><input type="file" name="file"></p>
    <p><input type="submit" value="Upload"></p>
    </form>
    <a href="%s">All files</a>
    </body>
    </html>
    ''' % url_for('list_gridfs_files')


@app.route('/files')
def list_gridfs_files():
    files = [FS.get_last_version(file) for file in FS.list()]
    file_list = "\n".join(['<li><a href="%s">%s</a></li>' %
                          (url_for('serve_gridfs_file', oid=str(file._id)),
                           file.name) for file in files])
    # print FS.list()
    # print "\n"

    return '''
    <!DOCTYPE html>
    <html>
    <head>
    <title>Files</title>
    </head>
    <body>
    <h1>Files</h1>
    <ul>
    %s
    </ul>
    <a href="%s">Upload new file</a>
    </body>
    </html>
    ''' % (file_list, url_for('upload_file'))


@app.route('/files/<oid>')
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
    # file_object.__setattr__("test","testtt")

    # file_object({'filename':'Selection_026.png'}, {'$set':{'hak_cipta':"bebasss", 'keterangan':"foto_fahrulsss"}})
    # print file_object.test
    # gout = FS.get_last_version(file_object.filename)
    # outfilename = '/home/ardi/PycharmProjects/KomputasiAwanGG/flask_gridfs_server/FILE/'

    # fout = open(file_object.filename, 'wb')
    # fout.writelines(gout.read(),'/home/ardi/PycharmProjects/KomputasiAwanGG/flask_gridfs_server/', )
    # fout.write(gout.read())
    # fout.close()
    # gout.close()
    # print file_object.keterangan #5717aa43c90d7d37e97cc9b2
    return '''
    aa
    '''



##

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)