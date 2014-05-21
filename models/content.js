var Constants = require('../models/constants');

var Content = module.exports.Content = function()  {
	var livefyre = require('livefyre');
	this.network = livefyre.getNetwork(Constants.LIVEFYRE_NETWORK, Constants.LIVEFYRE_NETWORK_SECRET);
	this.site = this.network.getSite(Constants.LIVEFYRE_SITE_ID, Constants.LIVEFYRE_SITE_KEY);
	
	return this;
};

Content.prototype.buildCollectionMeta = function(title, articleId, url, tags, type) {
	if (typeof type == 'undefined') {
		type = "livecomments";
	}

	return {
		"collectionMetaToken" : this.site.buildCollectionMetaToken(title, articleId, url),
		"checksum" : this.site.buildChecksum(title, url, tags)
	};
	
}