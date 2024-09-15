var express = require('express');
var app = express();

app.get('/', function (req, res) {
    res.send(`
    <html>
        <head>
            <title>My First Express App</title>
        </head>
        <body style="color: ${process.env.COLOR};">
            <h1>It is docker args and env example. Node version: ${process.version}</h1>
        </body>
    </html>
`);
});
app.listen(3000);
