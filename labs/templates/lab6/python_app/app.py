from flask import Flask, jsonify


app = Flask(__name__)

@app.route("/articles")
def get_articles():
    articles = [
        {
            "title": "First Article",
            "image": "https://picsum.photos/id/1/300/200",
            "description": "This is a short description of the first article."
        },
        {
            "title": "Second Article",
            "image": "https://picsum.photos/id/11/300/200",
            "description": "This is a short description of the second article."
        },
        {
            "title": "Third Article",
           "image": "https://picsum.photos/id/20/300/200",
            "description": "This is a short description of the third article."
        }
    ]
    return jsonify(articles)


if __name__ == "__main__":
    app.run()
