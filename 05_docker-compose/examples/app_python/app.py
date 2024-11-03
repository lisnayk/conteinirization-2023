from flask import Flask
import os

app = Flask(__name__)

@app.route("/")
def index():
    return os.environ.get('PYTHON_APP_NAME', 'Default App Name')

@app.route("/test")
def hello():
    return "hello world!"

if __name__ == "__main__":
    app.run()
