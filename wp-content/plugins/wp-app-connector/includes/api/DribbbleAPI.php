<?php

/**
 * Class DribbbleAPI
 */
class DribbbleAPI {


	// url to Dribbble api
	protected $apiUrl = 'http://api.dribbble.com/';


	// Dribbble username or user id
	protected $user;


	/**
	 * DribbbleAPI constructor.
	 *
	 * @param $user
	 */
	public function __construct( $user ) {
		$this->user = $user;
	}

	/**
	 * Get Shots form the player
	 *
	 * @param int $perPage
	 *
	 * @return mixed
	 */
	public function getPlayerShots( $perPage = 15 ) {
		$user = $this->user;

		$json = wp_remote_get( $this->apiUrl . 'players/' . $user . '/shots?per_page=' . $perPage );

		$array = json_decode( $json['body'] );

		$shots = $array->shots;

		return $shots;
	}
}