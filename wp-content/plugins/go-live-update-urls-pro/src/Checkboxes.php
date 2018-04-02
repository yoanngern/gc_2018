<?php


/**
 * Go_Live_Update_URLS_Pro_Checkboxes
 *
 * @author Mat Lipe
 *
 */
class Go_Live_Update_URLS_Pro_Checkboxes {
	/**
	 * checkboxes
	 *
	 * @var array
	 */
	protected $checkboxes;

	/**
	 * wpdb
	 *
	 * @var wpdb $wpdb ;
	 */
	protected $wpdb;


	public function __construct() {
		$this->wpdb = $GLOBALS['wpdb'];

		$this->create_checkbox_list();
	}


	/**
	 * Retrieve the list of tables to update based on
	 * which types are checked.
	 * We we have no matching sections is it assumed we have an
	 * array of tables not sections and therefor return what we
	 * started with.
	 *
	 *
	 * @param array $sections
	 *
	 * @return array
	 */
	public function swap_tables( array $sections ) {
		$tables = array();

		foreach ( $sections as $_table ) {
			if ( isset( $this->checkboxes[ $_table ] ) ) {
				$tables[] = $this->checkboxes[ $_table ]->tables;
			}
		}
		//we were passed tables instead of sections (to be used with upcoming feature)
		if ( empty( $tables ) && ! empty( $sections ) ) {
			return $sections;
		}
		//see https://github.com/kalessil/phpinspectionsea/blob/master/docs/performance.md#slow-array-function-used-in-loop
		$tables = call_user_func_array( 'array_merge', $tables );

		return array_flip( $tables );
	}


	private function create_checkbox_list() {
		$this->checkboxes = array(
			'posts'    => $this->posts(),
			'comments' => $this->comments(),
			'terms'    => $this->terms(),
			'options'  => $this->options(),
			'user'     => $this->users(),
			'custom'   => $this->custom(),
		);
		if ( is_multisite() ) {
			$this->checkboxes['network'] = $this->network();
		}
	}


	public function render() {
		?>
		<ul id="gluu-checkboxes">
			<?php
			foreach ( $this->checkboxes as $checkbox => $data ) {
				?>
				<li>
					<?php
					printf( '<input name="%s[]" type="checkbox" value="%s" checked /> %s', esc_attr( Go_Live_Update_Urls_Admin_Page::TABLE_INPUT_NAME ), esc_attr( $checkbox ), esc_html( $data->label ) );
					?>
				</li>
				<?php

			}
			?>
		</ul>
		<?php
	}


	private function comments() {
		return (object) array(
			'label'  => __( 'Comments', 'go-live-update-urls' ),
			'tables' => array(
				$this->wpdb->commentmeta,
				$this->wpdb->comments,
			),
		);
	}


	private function users() {
		return (object) array(
			'label'  => __( 'Users', 'go-live-update-urls' ),
			'tables' => array(
				$this->wpdb->usermeta,
			),
		);
	}


	private function terms() {
		$data = (object) array(
			'label'  => __( 'Categories, Tags, Custom Taxonomies', 'go-live-update-urls' ),
			'tables' => array(
				$this->wpdb->terms,
				$this->wpdb->term_relationships,
				$this->wpdb->term_taxonomy,
			),
		);

		//term meta support since WP 4.4
		if ( isset( $this->wpdb->termmeta ) ) {
			$data->tables[] = $this->wpdb->termmeta;
		}

		return $data;

	}


	private function options() {
		return (object) array(
			'label'  => __( 'Site Options, Widgets', 'go-live-update-urls' ),
			'tables' => array(
				$this->wpdb->options,
			),
		);
	}


	private function posts() {
		return (object) array(
			'label'  => __( 'Posts, Pages, Custom Post Types', 'go-live-update-urls' ),
			'tables' => array(
				$this->wpdb->posts,
				$this->wpdb->postmeta,
				$this->wpdb->links,
			),
		);
	}


	private function network() {
		return (object) array(
			'label'  => __( 'Network Settings', 'go-live-update-urls' ),
			'tables' => array(
				$this->wpdb->sitemeta,
				$this->wpdb->site,
			),
		);
	}


	public function custom() {
		static $custom;
		if ( ! empty( $custom ) ) {
			return $custom;
		}

		$default_tables = $this->wpdb->tables();
		$all_tables     = wp_list_pluck( Go_Live_Update_Urls_Database::instance()->get_all_tables(), 'TABLE_NAME' );
		$all_tables     = array_flip( $all_tables );
		foreach ( $default_tables as $table ) {
			unset( $all_tables[ $table ] );
		}

		$custom = (object) array(
			'label'  => __( 'Custom tables created by plugins', 'go-live-update-urls' ),
			'tables' => array_flip( $all_tables ),
		);

		return $custom;


	}


}
