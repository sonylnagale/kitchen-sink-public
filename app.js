'use strict';
var evh = require('express-vhost'),
 express = require('express'),
 path = require('path'),
 favicon = require('static-favicon'),
 logger = require('morgan'),
 cookieParser = require('cookie-parser'),
 home = require('./routes/index'),
 users = require('./routes/users'),
 comments = require('./routes/comments'),
 mediawall = require('./routes/mediawall'),
 liveblog = require('./routes/liveblog'),
 livereviews = require('./routes/livereviews'),
 livechat = require('./routes/livechat'),
 sidenotes = require('./routes/sidenotes');

var appFactory = function(echo) {
    var app = express();
    app.get('/', function(req, res) {
        res.send(req.get('host'));
    });

    return app;
};

var app = express();

app.use(evh.vhost());

evh.register('test1-local', appFactory('test1'));
evh.register('*.sales.livefyre.com', appFactory());

app.engine('html', require('hogan-express'));

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'html');
app.set('partials', {header: '_header', navbar: '_navbar', sidenotesContent: '_sidenotesContent', footer: '_footer'});

app.use(favicon());
app.use(logger('dev'));
//app.use(bodyParser.json());
//app.use(bodyParser.urlencoded());
app.use(cookieParser());
app.use(express.static(__dirname + '/public'));

app.use('/', home);
app.use('/comments', comments);
app.use('/users', users);
app.use('/mediawall', mediawall);
app.use('/liveblog', liveblog);
app.use('/livereviews', livereviews);
app.use('/livechat', livechat);
app.use('/sidenotes', sidenotes);

/// catch 404 and forward to error handler
app.use(function(req, res, next) {
    var err = new Error('Not Found');
    err.status = 404;
    next(err);
});

/// error handlers

// development error handler
// will print stacktrace
if (app.get('env') === 'development') {
    app.use(function (err, req, res, next) {
        res.status(err.status || 500);
        res.render('error', {
            message: err.message,
            error: err
        });
    });
}

// production error handler
// no stacktraces leaked to user
app.use(function (err, req, res, next) {
    res.status(err.status || 500);
    res.render('error', {
        message: err.message,
        error: {}
    });
});

module.exports = app;
