class Object(file):
    object_name = []
    filename = []

    # The class "constructor" - It's actually an initializer
    def __init__(self, object_name, filename):
        self.filename = filename
        self.object_name = object_name

def make_object(object_name, filename):
    object = Object(object_name, filename)
    return object
