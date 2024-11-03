<?php

namespace Cool_Kids_Dashboard\Inc\Blocks;

class AuthModal {
	/**
	 * Render the authentication modal dialog
	 *
	 * @param array $atts Array of attributes for the auth modal. Accepts 'showRegister' parameter to control registration form display.
	 * @return bool|string Returns the rendered auth modal HTML or false if user is already logged in
	 */
	public function render_auth_modal( $atts ) {
		if ( is_user_logged_in() ) {
			return false;
		}

		$atts = shortcode_atts(
			[
				'showRegister' => true,
			],
			$atts
			);

		ob_start();
		require CKD_PLUGIN_DIR . 'templates/auth-modal.php';
		return ob_get_clean();
	}
}
