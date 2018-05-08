<?php


/**
 * Class OAuth_API
 */
class OAuth_API {

	protected $api_name;
	protected $apiUrl;
	protected $server;
	protected $client_ID;
	protected $client_secret;
	protected $scope;

	protected $client;

	/**
	 * OAuth_API constructor.
	 */
	public function __construct() {

		$this->client = new OAuth_client_class;
	}

	/**
	 * Connect
	 */
	public function connect() {

		if ( isset( $_GET['api'] ) ) {
			if ( $_GET['api'] == $this->api_name ) {

				$PlanningCenterOnlineAPI = new OAuth_API();

				$this->init();

				$PlanningCenterOnlineAPI->start( $this->client );

			}
		}
	}

	/**
	 * Init
	 */
	public function init() {

		$this->client->debug = true;

		$this->client->debug_http = true;

		$this->client->server = $this->server;

		$this->client->redirect_uri = get_bloginfo( "url" ) . "/wp-admin/admin-post.php?action=api_connect&api=" . $this->api_name;

		$this->client->client_id = $this->client_ID;

		$this->client->client_secret = $this->client_secret;

		$this->client->scope = $this->scope;

		$oauth = get_option( 'wp_app_connector_oauth' );

		if ( array_key_exists( $this->api_name, $oauth ) ) {
			$this->client->StoreAccessToken( $oauth[ $this->api_name ]['access_token'] );
		}
	}


	/**
	 * Start
	 *
	 * @param OAuth_client_class $client
	 *
	 * @return bool $success
	 */
	public function start( $client ) {

		if ( ( $success = $client->Initialize() ) ) {
			if ( ( $success = $client->Process() ) ) {
				if ( strlen( $client->access_token ) ) {
					$this->setAccessToken();

					wp_redirect( admin_url( '/admin.php?page=wp-app-connector' ), 200 );
					exit;
				}
			}
			$success = $client->Finalize( $success );
		}

		echo $client->debug_output;

		return $success;
	}

	/**
	 * Call API
	 *
	 * @param string $url
	 * @param string $method
	 * @param array $data
	 *
	 * @return array $return
	 */
	public function callAPI( $url, $method = 'GET', $data = array() ) {

		$return = array();



		if ( ( $success = $this->client->Initialize() ) ) {
			if ( ( $success = $this->client->Process() ) ) {

				if ( strlen( $this->client->access_token ) ) {
					$this->setAccessToken();

					$success = $this->client->CallAPI( $url, $method, $data, array( 'FailOnAccessError' => true ), $return );

					if(!$success) {
						$return = $this->client->debug_output;
					}
				}
			} else {
				$return = $this->client->debug_output;
			}
			$this->client->Finalize( $success );
		}

		return $return;
	}


	/**
	 * Set AccessToken
	 *
	 * @return array $oauth
	 */
	private function setAccessToken() {

		$oauth = get_option( 'wp_app_connector_oauth' );

		$oauth[ $this->api_name ]['access_token']        = $this->client->access_token;
		$oauth[ $this->api_name ]['access_token_url']    = $this->client->access_token_url;
		$oauth[ $this->api_name ]['access_token_type']   = $this->client->access_token_type;
		$oauth[ $this->api_name ]['access_token_expiry'] = $this->client->access_token_expiry;
		$oauth[ $this->api_name ]['refresh_token']       = $this->client->refresh_token;
		$oauth[ $this->api_name ]['scope']               = $this->client->scope;

		update_option( 'wp_app_connector_oauth', $oauth );

		return $oauth;
	}


}