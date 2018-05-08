<?php

require_once "OAuth_API.php";

/**
 * Class FacebookAPI
 */
class FacebookAPI extends OAuth_API {

	/**
	 * FacebookAPI constructor.
	 */
	public function __construct() {
		parent::__construct();

		$this->api_name      = 'facebook';
		$this->apiUrl        = 'https://graph.facebook.com';
		$this->server        = 'Facebook';
		$this->client_ID     = '1818790621747945';
		$this->client_secret = 'c2035a420341be101ac6330aec5e7ef6';
		$this->scope         = 'email,publish_actions,user_friends';

	}

}

