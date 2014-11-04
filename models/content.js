'use strict';

var Constants = require('../models/constants');

var Content = module.exports.Content = function() {
  var livefyre = require('livefyre');
  this.network = livefyre.getNetwork(Constants.LIVEFYRE_NETWORK, Constants.LIVEFYRE_NETWORK_SECRET);
  this.site = this.network.getSite(Constants.LIVEFYRE_SITE_ID, Constants.LIVEFYRE_SITE_KEY);

  return this;
};
