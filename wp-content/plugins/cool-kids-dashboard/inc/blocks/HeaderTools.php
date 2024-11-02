<?php

namespace CoolKidsDashboard\Inc\Blocks;

class HeaderTools {
	/**
	 * Render the header tools
	 *
	 * @param array $atts
	 * @return bool|string
	 */
	public function render_header_tools( $atts ) {
		$is_logged_in = is_user_logged_in();

		$atts = shortcode_atts(
			[
				'showAuth' => true,
			],
			$atts
			);

		ob_start();
		require CKD_PLUGIN_DIR . 'templates/header-tools.php';
		return ob_get_clean();
	}
}
