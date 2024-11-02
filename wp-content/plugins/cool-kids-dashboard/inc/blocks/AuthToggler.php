<?php

namespace CoolKidsDashboard\Inc\Blocks;

use WP_User;

class AuthToggler {
	/**
	 * Current user object
	 *
	 * @var WP_User|null
	 */
	protected $user;

	/**
	 * Define articles for specific roles
	 *
	 * @var array
	 */
	protected $articles = [
		'cool_kid'    => 'a',
		'cooler_kid'  => 'the',
		'coolest_kid' => 'the',
	];

	/**
	 * Current user role
	 *
	 * @var string
	 */
	protected $role_key;

	/**
	 * Current user human-readable role name
	 *
	 * @var string
	 */
	protected $role_name;

	/**
	 * Constructor to initialize the current user.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'init_user_role' ] );
	}

	/**
	 * Renders the auth toggler block with different content for logged in users vs guests
	 *
	 * @param array $attributes Block attributes
	 * @return string Rendered block content
	 */
	public function render_auth_toggler( $attributes ) {
		$defaults = [
			'isAuth'    => true,
			'textColor' => '#151921',
		];

		$attributes = wp_parse_args( $attributes, $defaults );

		// Sanitize attributes
		$show_content = (bool) $attributes['isAuth'];
		$text_color   = sanitize_hex_color( $attributes['textColor'] );

		ob_start();

		require CKD_PLUGIN_DIR . 'templates/auth-toggler.php';

		return ob_get_clean();
	}

	/**
	 * Initializes the current user role and role name.
	 *
	 * This method retrieves the current user object using WordPress's
	 * `wp_get_current_user()` function, extracts the user's primary
	 * role key, and fetches the corresponding human-readable role name.
	 * If no user is logged in or the role is unknown, 'Unknown Role'
	 * will be assigned to the role name.
	 *
	 * @return void
	 */
	public function init_user_role() {
		$this->user      = \wp_get_current_user();
		$this->role_key  = $this->user->roles[0] ?? null;
		$this->role_name = wp_roles()->get_names()[ $this->role_key ] ?? 'Unknown Role';
	}

	/**
	 * Displays a formatted role string for the current user.
	 *
	 * @return string
	 */
	public function display_formatted_role() {
		// Check if the user has a role
		$role_key = $this->user->roles[0] ?? null;

		// Return message if no role is assigned
		if ( is_null( $role_key ) ) {
			return 'No role assigned';
		}

		// Determine the appropriate article
		$article = $this->articles[ $role_key ] ?? 'a';

		// Return the formatted role string
		return sprintf( '%s %s', $article, $this->role_name );
	}

	/**
	 * Get the dashboard URL
	 *
	 * @return string
	 */
	public function get_dashboard_url() {
		$dashboard_page = get_page_by_path( 'my-dashboard' );
		return $dashboard_page->guid;
	}
}
