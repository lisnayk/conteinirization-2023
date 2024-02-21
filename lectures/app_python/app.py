from flask import Flask

app = Flask(__name__)

@app.route("/test")
def hello():
    return "hello world! from python!!!"

if __name__ == "__main__":
    app.run()
