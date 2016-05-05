from .views import *
class Object(file):
    object_name = []
    filename = []

    # The class "constructor" - It's actually an initializer
    def __init__(self, object_name, filename):
        self.filename = filename
        self.object_name = FS.get(ObjectId(object_name))

    def get_id(self):
        return self.object_name

    def get_filename(self):
        return self.filename

    def make_object(object_name, filename):
        object = Object(object_name, filename)
        return object
