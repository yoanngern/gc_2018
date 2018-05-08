<?php

require_once "OAuth_API.php";


/**
 * Class PlanningCenterOnlineAPI
 */
class PlanningCenterOnlineAPI extends OAuth_API {


	/**
	 * PlanningCenterOnlineAPI constructor.
	 */
	public function __construct() {
		parent::__construct();

		$this->api_name      = 'planningcenteronline';
		$this->apiUrl        = 'https://api.planningcenteronline.com';
		$this->server        = 'PlanningCenterOnline';
		$this->client_ID     = '0681117f5acd66d9b65a64f5348713137f95f402b4e8fe51f5a17228eea0ac21';
		$this->client_secret = '5a4f2fc9328844c81ba067a4f454c7d016a8d75245e842ef01fb564f04af809f';
		$this->scope         = 'people';

	}


	/**
	 * Get a person
	 *
	 * @param integer $person_id
	 *
	 * @return array $person
	 */
	public function getPerson( $person_id ) {

		$person = $this->callAPI( $this->apiUrl . '/people/v2/people/' . $person_id, 'GET' );

		return $person;
	}

	/**
	 * Get addresses
	 *
	 * @return array addresses
	 */
	public function getAddresses() {

		$addresses = $this->callAPI( $this->apiUrl . '/people/v2/addresses', 'GET' );

		return $addresses;
	}

	/**
	 * Get an address
	 *
	 * @param integer $address_id
	 *
	 * @return array $address
	 */
	public function getAddress( $address_id ) {

		$this->init();

		$address = $this->callAPI( $this->apiUrl . '/people/v2/addresses/' . $address_id, 'GET' );

		return $address;
	}

	/**
	 * Create an address for a person
	 *
	 * @param integer $person_id
	 * @param array $data
	 *
	 * @return array $address
	 */
	public function createAddress( $person_id, $data ) {

		$this->init();

		$address = $this->callAPI( $this->apiUrl . '/people/v2/people/' . $person_id . '/addresses', 'POST', $data );

		return $address;
	}


}