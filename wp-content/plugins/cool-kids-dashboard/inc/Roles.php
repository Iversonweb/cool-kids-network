<?php

namespace Cool_Kids_Dashboard\Inc;

use Cool_Kids_Dashboard\Inc\Interfaces\RegisterInterface;

class Roles implements RegisterInterface {

	/**
	 * Array of custom roles with their capabilities
	 *
	 * @var array
	 */
	protected $roles = [
		[
			'name'                => 'cool_kid',
			'title'               => 'Cool Kid',
			'read'                => true,
			'view_dashboard'      => true,
			'view_few_users_data' => false,
		],
		[
			'name'                => 'cooler_kid',
			'title'               => 'Cooler Kid',
			'read'                => true,
			'view_dashboard'      => true,
			'view_few_users_data' => true,
		],
		[
			'name'                => 'coolest_kid',
			'title'               => 'Coolest Kid',
			'read'                => true,
			'view_dashboard'      => true,
			'view_few_users_data' => true,
		],
	];

	/**
	 * Register hooks for role management
	 *
	 * @return void
	 */
	public function register() {
		register_activation_hook( CKD_PLUGIN_FILE, [ $this, 'register_custom_roles' ] );
		register_deactivation_hook( CKD_PLUGIN_FILE, [ $this, 'remove_custom_roles' ] );
		add_action( 'show_admin_bar', [ $this, 'hide_admin_bar_for_custom_roles' ] );
		add_action( 'admin_init', [ $this, 'redirect_custom_roles' ] );
	}

	/**
	 * Adding new roles upon plugin activation
	 *
	 * @return void
	 */
	public function register_custom_roles() {
		foreach ( $this->roles as $role ) {
			add_role(
				$role['name'],
				$role['title'],
				[
					'read'                => $role['read'],
					'view_dashboard'      => $role['view_dashboard'],
					'view_few_users_data' => $role['view_few_users_data'],
				]
			);
		}
	}

	/**
	 * Remove custom roles
	 *
	 * @return void
	 */
	public function remove_custom_roles() {
		foreach ( $this->roles as $role ) {
			remove_role( $role['name'] );
		}
	}

	/**
	 * Redirect custom roles away from wp-admin
	 *
	 * @return void
	 */
	public function redirect_custom_roles() {
		if ( is_admin() && defined( 'DOING_AJAX' ) && current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( $this->is_custom_role() ) {
			wp_safe_redirect( home_url() );
			exit;
		}
	}

	/**
	 * Hide admin bar from users with custom roles
	 *
	 * @param boolean $show Whether to show the admin bar.
	 * @return boolean
	 */
	public function hide_admin_bar_for_custom_roles( $show ) {
		if ( ! is_user_logged_in() ) {
			return false;
		}

		if ( $this->is_custom_role() ) {
			return false;
		}

		return $show;
	}

	/**
	 * Check if the current user has a custom role
	 *
	 * @return boolean
	 */
	private function is_custom_role() {
		$user = wp_get_current_user();

		foreach ( $this->roles as $role ) {
			if ( $user->roles[0] !== $role['name'] ) {
				continue;
			}

			return true;
		}

		return false;
	}
}
