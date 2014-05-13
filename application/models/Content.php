<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once './vendor/autoload.php';
use Livefyre\Livefyre;

class Content extends CI_Model {
	private $_network;
	private $_site;
	
	function __construct() {
		parent::__construct();
		
		$this->_network = Livefyre::getNetwork(LIVEFYRE_NETWORK, LIVEFYRE_NETWORK_KEY);
		$this->_site = $this->_network->getSite(LIVEFYRE_SITE_ID, LIVEFYRE_SITE_KEY);
	}
	
	public function generateCollectionMetadata($params) {
		$defaults = array(
			'tags' => NULL,
			'stream_type' => NULL,
			'ratingDimensions' => NULL
		);
		
		$params = $params + $defaults;
				
		if (LIVEFYRE_LIBRARY) {
			if (!isset($params['title']) || 
				!isset($params['url'])	||
				!isset($params['article_id'])) {
				die("Something's not set for the collectionmetadata.");
			}
			
			$checksum = $this->_site->buildChecksum($params['title'], $params['url'], $params['tags']);
			$collectionMeta = $this->_site->buildCollectionMetaToken($params['title'], $params['article_id'], $params['url'], $params['tags'], $params['type'], $params['ratingDimensions']);
			return array(
				'checksum' => $checksum,
				'collectionMeta' => $collectionMeta
			);
		}
	}
}