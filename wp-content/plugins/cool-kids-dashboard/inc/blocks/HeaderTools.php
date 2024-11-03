<?php

namespace Cool_Kids_Dashboard\Inc\Blocks;

class HeaderTools {
	/**
	 * Render the header tools
	 *
	 * @param array $atts Array of attributes for the header tools. Accepts 'showAuth' parameter to control authentication display.
	 * @return bool|string Returns the rendered header tools HTML or false on failure
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
