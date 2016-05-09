from .views import *
class Object(file):
    object_name = []
    filename = []
    share = []

    # The class "constructor" - It's actually an initializer
    def __init__(self, object_name, filename, share):
        self.filename = filename
        self.object_name = FS.get(ObjectId(object_name))
        self.share = share

    def get_id(self):
        return self.object_name

    def get_filename(self):
        return self.filename

    def get_share(self):
        return self.share

    def make_object(object_name, filename,share):
        object = Object(object_name, filename,share)
        return object
