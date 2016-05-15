from flask import Flask
from flask.ext.json import FlaskJSON
from flask.ext.login import LoginManager


app = Flask(__name__)
json = FlaskJSON(app)
app.config.from_object('config')
lm = LoginManager()
lm.init_app(app)
lm.login_view = 'login'
from app import views

