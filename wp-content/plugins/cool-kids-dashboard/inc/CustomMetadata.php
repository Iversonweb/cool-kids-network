<?php

namespace Cool_Kids_Dashboard\Inc;

use Cool_Kids_Dashboard\Inc\Interfaces\RegisterInterface;

class CustomMetadata implements RegisterInterface {

	/**
	 * Register the custom metadata
	 *
	 * @return void
	 */
	public function register() {
		register_activation_hook( CKD_PLUGIN_FILE, [ $this, 'ckd_create_country_metadata' ] );
	}

	/**
	 * Create the country metadata
	 *
	 * @return void
	 */
	public function ckd_create_country_metadata() {
		$users = get_users();

		foreach ( $users as $user ) {
			if ( ! metadata_exists( 'user', $user->ID, 'country' ) ) {
				update_user_meta( $user->ID, 'country', '' );
			}
		}
	}
}
