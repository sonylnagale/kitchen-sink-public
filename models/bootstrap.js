var Constants = require('../models/constants');
var Bootstrap = {
	"comments": [{
		"articleId" : Constants.DEMO_ARTICLE_ID_PREFIX + "_0001",
		"title" : "Comments",
		"url" : "http://" + Constants.DEMO_URL_PREFIX + "/comments"
	 }],
	 "liveblog": [{
	 	"articleId" : Constants.DEMO_ARTICLE_ID_PREFIX + "_0002",
	 	"title" : "Live Blog",
	 	"url" : "http://" + Constants.DEMO_URL_PREFIX + "/liveblog",
	 	"type": "liveblog"
	 }],
	 "livechat": [{
	 	"articleId": Constants.DEMO_ARTICLE_ID_PREFIX + "_0003",
	 	"title":"Live Chat",
	 	"url":"http://" + Constants.DEMO_URL_PREFIX + "/livechat",
	 	"type":"livechat"
	 }],
	 "livereviews": [{
	 	"articleId": Constants.DEMO_ARTICLE_ID_PREFIX + "_0004",
	 	"title": "Live Reviews",
	 	"url":"http://" + Constants.DEMO_URL_PREFIX + "/livereviews",
	 	"type":"reviews"
	 }],
	 "sidenotes": [{
	 	"articleId": Constants.DEMO_ARTICLE_ID_PREFIX + "_sidenotes_0001",
	 	"title": "Sidenotes",
	 	"url": "http://" + Constants.DEMO_URL_PREFIX + "/sidenotes",
	 	"type":"sidenotes"
	 }],
	 "mediawall": [{
	 	"articleId":"custom-1397754619766",
	 	"title":"Media Wall",
	 	"url":"http://" + Constants.DEMO_URL_PREFIX + "/mediawall"
	 }],
	 "gallery": [{
	 	"articleId":"custom-1395952392273",
	 	"title":"Streamhub Gallery",
	 	"url":"http://" + Constants.DEMO_URL_PREFIX + "/gallery"
	 }]
};

module.exports = Bootstrap;