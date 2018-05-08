<?php

require_once "OAuth_API.php";

/**
 * Class TwitterAPI
 */
class TwitterAPI extends OAuth_API {

	/**
	 * TwitterAPI constructor.
	 */
	public function __construct() {
		parent::__construct();

		$this->api_name      = 'twitter';
		$this->apiUrl        = 'https://api.twitter.com';
		$this->server        = 'Twitter';
		$this->client_ID     = '';
		$this->client_secret = '';
		$this->scope         = '';

	}

}

