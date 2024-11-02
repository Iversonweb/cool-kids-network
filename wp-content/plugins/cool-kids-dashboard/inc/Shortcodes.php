<?php

namespace CoolKidsDashboard\Inc;

use WP_User;
use CoolKidsDashboard\Inc\Interface\RegisterInterface;

/**
 * Class created to generate shortcodes
 */
class Shortcodes implements RegisterInterface {

	/**
	 * Current user object
	 *
	 * @var WP_User|null
	 */
	protected $user;

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
	 * Define the role-based image filenames
	 *
	 * @var array
	 */
	protected $role_images = [
		'cool_kid'    => 'cool_kid.png',
		'cooler_kid'  => 'cooler_kid.png',
		'coolest_kid' => 'coolest_kid.png',
	];

	/**
	 * Constructor to initialize the current user.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'init_user_role' ] );
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
	 * Registers all new shortcodes
	 *
	 * @return void
	 */
	public function register() {
		add_shortcode( 'ckn_user_dashboard', [ $this, 'user_dashboard_shortcode' ] );
		add_shortcode( 'ckn_user_directory', [ $this, 'user_directory_shortcode' ] );
	}

	/**
	 * Generate Dashboard Shortcode
	 *
	 * @return void
	 */
	public function user_dashboard_shortcode() {
		ob_start();
		require CKD_PLUGIN_DIR . 'templates/shortcodes/ckd-user-dashboard.php';
		return ob_get_clean();
	}

	/**
	 * Generate Directory Shortcode
	 *
	 * @return void
	 */
	public function user_directory_shortcode() {
		// Set up pagination variables
		$users_per_page = 2;

		$current_page = isset( $_GET['paged'] ) ? max( 1, intval( $_GET['paged'] ) ) : 1;

		// Calculate offset
		$offset = ( $current_page - 1 ) * $users_per_page;

		$total_pages = ceil( count( $this->get_total_users() ) / $users_per_page );

		$users = get_users(
			[
				'role__in' => [ 'cool_kid', 'cooler_kid', 'coolest_kid' ],
				'exclude'  => [ get_current_user_id() ],
				'number'   => $users_per_page,
				'offset'   => $offset,
			]
		);

		ob_start();
		require CKD_PLUGIN_DIR . 'templates/shortcodes/ckd-user-directory.php';
		return ob_get_clean();
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
	 * Get the avatar image URL based on the user's role.
	 *
	 * @return string URL of the avatar image.
	 */
	public function get_role_avatar() {
		// Get the image filename based on the current user's role key
		$image_filename = $this->role_images[ $this->role_key ] ?? 'others.png';

		// Construct the full URL to the image in the uploads directory
		return( wp_get_upload_dir()['baseurl'] . '/2024/11/' . $image_filename );
	}

	/**
	 * Get the avatar image URL based on the user's role or specific conditions.
	 *
	 * @return string URL of the avatar image.
	 */
	public function get_user_avatar( $user ) {

		$this->role_key = $this->user->roles[0] ?? 'guest';

		if ( $this->role_key === 'cooler_kid' ) {
			return wp_get_upload_dir()['baseurl'] . '/2024/11/unkown-kid.png';
		}

		$image_filename = $this->role_images[ $user->roles[0] ] ?? 'others.png';

		return wp_get_upload_dir()['baseurl'] . '/2024/11/' . $image_filename;
	}

	/**
	 * Get the total users
	 *
	 * @return array
	 */
	public function get_total_users() {
		return get_users(
			[
				'role__in' => [ 'cool_kid', 'cooler_kid', 'coolest_kid' ],
				'exclude'  => [ get_current_user_id() ],
			]
			);
	}
}
