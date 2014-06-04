'use strict';

var express = require('express');
var router = express.Router();
var Constants = require('../models/constants');
var Bootstrap = require('../models/bootstrap');
var Content = require('../models/content');
var Firebase = require('firebase');
var firebase = new Firebase('https://popping-fire-1902.firebaseio.com/kitchen-sink/' + Constants.DEMO_ARTICLE_ID_PREFIX);

var articles = [];
for (var articleType in Bootstrap) {
  articles.push(Bootstrap[articleType][0]);
}

/** comments page */
router.get('/', function (req, res) {
  if (!req.params.index) {
    req.params.index = 0; // default to zeroith
  }

  firebase.child('collection').child('livechat').once('value', function (collections) {
    var article = collections.val()[req.params.index];
    var content = new Content.Content();

    var meta = content.buildCollectionMeta(article.title, article.articleId, article.url, [], []);

    res.render('livechat', {
      pagetitle: 'LiveChat',
      Constants: Constants,
      Bootstrap: Bootstrap,
      articles: articles,
      article: article,
      meta: meta
    });
  });
});

module.exports = router;
