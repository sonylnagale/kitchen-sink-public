<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('./application/libraries/Firebase.php');

class Data extends CI_Model {
	private $_firebase;
	
	function __construct() {
		parent::__construct();
		$this->_firebase = new Firebase(FIREBASE_INSTANCE);
	}
	
	function getArticle($param) {
		return $data = $this->_firebase->get(DEMO_ARTICLE_ID_PREFIX . "/collection/$param");
	}
}