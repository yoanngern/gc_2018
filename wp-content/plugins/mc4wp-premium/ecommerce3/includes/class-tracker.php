<?php

class MC4WP_Ecommerce_Tracker {

	public function __construct( $settings ) {
		$this->settings = $settings;
	}

    /**
	 * Add hooks
	 */
	public function hook() {
		add_action( 'init', array( $this, 'listen' ) );
		add_action( 'wp_footer', array( $this, 'output_mcjs_script' ), 60 );
		add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'attach_order_meta' ), 50 );
	}

	/**
	 * Listen for "mc_tc" in the URL.
	 */
	public function listen() {
		static $keys = array(
			'mc_tc',
			'mc_cid',
			'mc_eid',
		);
		$cookie_expiration_time = 14 * 24 * 60 * 60; // 14 days
		$expires_at = time() + $cookie_expiration_time;

		foreach( $keys as $key ) {
			$value = $this->get_url_value( $key );

			if( ! empty( $value ) ) {
				setcookie( $key, $value, $expires_at, '/' );
			}
		}

		// set landing_site cookie
		if( ! empty( $_GET['mc_cid'] )&& empty( $_COOKIE['mc_landing_site'] ) && ! is_admin() ) {
			setcookie( 'mc_landing_site', home_url( $_SERVER['REQUEST_URI'] ), $expires_at, '/' );
		}

	}

	public function output_mcjs_script() {
		if( ! $this->settings['load_mcjs_script'] || empty( $this->settings['store']['mcjs_url'] ) ) {
			return;
		}

		printf( '<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","%s");</script>', $this->settings['store']['mcjs_url'] );
	}

	/**
	 * @param int $order_id
	 */
	public function attach_order_meta( $order_id ) {

		$tracking_code = $this->get_tracking_code();
		if( ! empty( $tracking_code ) ) {
			update_post_meta( $order_id , 'mc_tc', $tracking_code );
		}

		$campaign_id = $this->get_campaign_id();
		if( ! empty( $campaign_id ) ) {
			update_post_meta( $order_id , 'mc_cid', $campaign_id );
		}

		$email_id = $this->get_email_id();
		if( ! empty( $email_id ) ) {
			update_post_meta( $order_id, 'mc_eid', $email_id );
		}

		$landing_site = $this->get_landing_site();
		if( ! empty( $landing_site ) ) {
			update_post_meta( $order_id, 'mc_landing_site', $landing_site );
		}
	}

	/**
	 * @param int $order_id (optional)
	 * @param string $key
     * @param bool $from_request
	 * @return string
	 */
	protected function get_value( $order_id, $key, $from_request = true ) {
		$value = '';

		// first, get from order meta
		if( $order_id && is_numeric( $order_id ) ) {
			$value = $this->get_meta_value( $order_id, $key );
		}

		if( $from_request ) {

            // then, get from URL
            if (empty($value)) {
                $value = $this->get_url_value($key);
            }

            // then, get from cookie
            if (empty($value)) {
                $value = $this->get_cookie_value($key);
            }

        }

		return (string) $value;
	}

	/**
	 * @param string $key
	 *
	 * @return string
	 */
	protected function get_url_value( $key ) {
		if( empty( $_GET[ $key ] ) ) {
			return '';
		}

		return sanitize_text_field( $_GET[ $key ] );
	}

	/**
	 * @param string $key
	 *
	 * @return string
	 */
	protected function get_cookie_value( $key ) {
		if( empty( $_COOKIE[ $key ] ) ) {
			return '';
		}

		return sanitize_text_field( $_COOKIE[ $key ] );
	}

	/**
	 * @param int $order_id
	 * @param string $key
	 *
	 * @return string
	 */
	protected function get_meta_value( $order_id, $key ) {
		return (string) get_post_meta( $order_id, $key, true );
	}

    /**
     * @param int $order_id
     * @param bool $from_request
     * @return string
     */
    public function get_tracking_code( $order_id = null, $from_request = true ) {
        return $this->get_value( $order_id, 'mc_tc', $from_request );
    }


    /**
	 * @param int $order_id (optional)
     * @param bool $from_request
	 *
	 * @return string
	 */
	public function get_campaign_id( $order_id = null, $from_request = true ) {
		return $this->get_value( $order_id, 'mc_cid', $from_request );
	}


	/**
	 * @param int $order_id (optional)
	 * @param bool $from_request
	 * @return string
	 */
	public function get_email_id( $order_id = null, $from_request = true ) {
		return $this->get_value( $order_id, 'mc_eid', $from_request );
	}

	/**
	 * @param int $order_id (optionaL)
     * @param bool $from_request
	 * @return string
	 */
	public function get_landing_site( $order_id = null, $from_request = true ) {
		return $this->get_value( $order_id, 'mc_landing_site', $from_request );
	}

}
