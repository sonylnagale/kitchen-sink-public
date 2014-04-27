<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once './vendor/autoload.php';
use Livefyre\Livefyre;

class User extends CI_Model {
	private $_network;
	private $_site;
	
	function __construct() {
		parent::__construct();
		
		$this->_network = Livefyre::getNetwork(LIVEFYRE_NETWORK, LIVEFYRE_NETWORK_KEY);
	}
	
	public function getUserToken($params) {
		$defaults = array(
				'expires'=> time() + 7 * 24 * 60 * 60 // 7 days
		);
		
		$params = $params + $defaults;
		
		if (LIVEFYRE_LIBRARY) {
			if (!isset($params['user_id']) || !isset($params['display_name'])) {
				die("No User ID or Display Name");
			}
			
			return $this->_network->buildUserAuthToken($params['user_id'], $params['display_name'], $params['expires']);
		}
	}
}