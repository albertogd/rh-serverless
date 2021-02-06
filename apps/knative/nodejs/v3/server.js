var express = require('express'),
    os = require('os');

var app = express(),
    port = process.env.PORT || process.env.OPENSHIFT_NODEJS_PORT || 8080,
    ip   = process.env.IP   || process.env.OPENSHIFT_NODEJS_IP || '0.0.0.0',
    version = '3.0';

app.get('/', function(req, res) {
    message = "<html>";
    message += "<h1>NodeJS test application</h1>";
    message += "Version: " + version + "<br /><br />";
    message += "Container: " + os.hostname();
    message += "</html>";

    res.send(message);
});


app.listen(port, ip);

module.exports = app;
