let http = require('http');
let fs = require('fs');

http.createServer(function(req, res) {

    switch (req.url) {
        case '/':
            sendFile("index.html", res);
            break;
        default:
            res.statusCode = 404;
            res.end("Not found");
    }
}).listen(8080);

function sendFile(fileName, res) {
    let fileStream = fs.createReadStream(fileName);
    fileStream
        .on('error', function () {
            res.statusCode = 500;
            res.end("Server error");
        })
        .pipe(res)
        .on('close', function () {
            fileStream.destroy();
        });
}