<?php

namespace Cool_Kids_Dashboard\Inc;

use Cool_Kids_Dashboard\Inc\Interfaces\RegisterInterface;

/**
 * Handles creating new pages upon plugin activation
 */
class CreatePages implements RegisterInterface {

	/**
	 * An array of pages to be created
	 *
	 * @var array
	 */
	protected $pages = [
		[
			'post_title'   => 'My Cool Dashboard',
			'post_content' => '<!-- wp:shortcode -->[ckn_user_dashboard]<!-- /wp:shortcode -->',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_name'    => 'my-dashboard',
			'template'     => [
				[
					'core/paragraph',
					[ 'placeholder' => 'Welcome to the User Dashboard.' ],
				],
				[
					'core/shortcode',
					[ 'text' => '[ckn_user_dashboard]' ],
				],
			],
		],
		[
			'post_title'   => 'Cool Kids Directory',
			'post_content' => '<!-- wp:shortcode -->[ckn_user_directory]<!-- /wp:shortcode -->',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_name'    => 'kids-directory',
			'template'     => [
				[
					'core/paragraph',
					[ 'placeholder' => 'Welcome to the User Directory.' ],
				],
				[
					'core/shortcode',
					[ 'text' => '[ckn_user_directory]' ],
				],
			],
		],
	];

	/**
	 * Registers the page creation
	 *
	 * @return void
	 */
	public function register() {
		register_activation_hook( CKD_PLUGIN_FILE, [ $this, 'create_pages_on_activation' ] );
	}

	/**
	 * Method to initialize page insertion into the database
	 *
	 * @return void
	 */
	public function create_pages_on_activation() {
		$pages   = $this->pages;
		$options = [];

		foreach ( $pages as $page ) {
			$slug    = $page['post_name'];
			$page_id = $this->create_or_update_page( $slug, $page );

			if ( $page_id instanceof \WP_Error ) {
				return;
			} else {
				$options[ "ckd_{$slug}_page_id" ] = $page_id;
			}
		}

		$this->update_options( $options );
	}

	/**
	 * Creates a new page or returns the ID of an existing page based on the provided slug.
	 *
	 * @param string $slug The slug of the page to create or update.
	 * @param array  $page_data The data for the page to be inserted.
	 * @return int|WP_Error The ID of the created or existing page, or a WP_Error object on failure.
	 */
	private function create_or_update_page( $slug, $page_data ) {
		if ( ! $this->page_exists( $slug ) ) {
			return wp_insert_post( $page_data );
		}

		return get_page_by_path( $slug )->ID;
	}

	/**
	 * Checks if a page exists by its slug.
	 *
	 * @param string $slug The slug of the page to check.
	 * @return WP_Post|null The page object if found, or null if not found.
	 */
	private function page_exists( $slug ) {
		return get_page_by_path( $slug );
	}

	/**
	 * Updates multiple options in the WordPress database.
	 *
	 * @param array $options An associative array of option names and their corresponding values.
	 * @return void
	 */
	private function update_options( $options ) {
		foreach ( $options as $option => $value ) {
			update_option( $option, $value );
		}
	}
}
