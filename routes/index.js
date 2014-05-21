var express = require('express');
var router = express.Router();
var Constants = require('../models/constants');
var Bootstrap = require('../models/bootstrap');
var Content = require('../models/content');

var articles = [];
for (articleType in Bootstrap) {
	articles.push(Bootstrap[articleType][0]);
}

/* GET home page. */
router.get('/', function(req, res) {
	res.render('index', { pagetitle: 'Home', 
		Constants: Constants, 
		Bootstrap: Bootstrap,
		articles: articles
	});
});

/** comments page */
router.get('/comments', function(req, res) {
	var article = Bootstrap.comments[0];
	var content = new Content.Content();
	
	var meta = content.buildCollectionMeta(article.title, article.articleId, article.url, [], []);
		
	res.render('comments', { pagetitle: 'Comments', 
		Constants: Constants, 
		Bootstrap: Bootstrap,
		articles: articles,
		article: article,
		meta: meta
	});
});

module.exports = router;
