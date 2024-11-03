<?php

namespace Cool_Kids_Dashboard\Inc\Admin;

class CountryMeta {
	/**
	 * Register the country meta
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'show_user_profile', [ $this, 'display_country_meta' ] );
		add_action( 'edit_user_profile', [ $this, 'display_country_meta' ] );
		add_action( 'personal_options_update', [ $this, 'save_country_meta' ] );
		add_action( 'edit_user_profile_update', [ $this, 'save_country_meta' ] );
	}

	/**
	 * Displays the country field in the user profile
	 *
	 * @param WP_User $user The user object.
	 * @return void
	 */
	public function display_country_meta( $user ) {
		$country = get_user_meta(
			$user->ID,
			'country',
			true
		);

		require CKD_PLUGIN_DIR . 'templates/admin/admin-country-meta.php';
	}

	/**
	 * Saves the user's country to user meta
	 *
	 * @param int $user_id The ID of the user being edited.
	 * @return void
	 */
	public function save_country_meta( $user_id ) {
		// Check if the current user can edit the specified user.
		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return;
		}

		// Verify nonce for security.
		if ( ! isset( $_POST['country_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['country_nonce'] ) ), 'save_country_meta_action' ) ) {
			return;
		}

		// Check if 'country' is set in the POST request.
		if ( isset( $_POST['country'] ) ) {
			// Sanitize and update the 'country' user meta.
			update_user_meta(
				$user_id,
				'country',
				sanitize_text_field( wp_unslash( $_POST['country'] ) )
			);
		}
	}
}
