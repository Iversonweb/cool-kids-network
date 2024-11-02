<?php

namespace CoolKidsDashboard\Inc\Api\V1;

class ChangeRole {

	/**
	 * Change the role of a user based on their email or name.
	 *
	 * @param WP_REST_Request $request The request object.
	 * @return WP_REST_Response The response object.
	 */
	public function ckn_rest_api_change_user_role( \WP_REST_Request $request ) {
		// Sanitize and get parameters from request
		$params = [
			'email'      => [ 'sanitize_email', '' ],
			'first_name' => [ 'sanitize_text_field', '' ],
			'last_name'  => [ 'sanitize_text_field', '' ],
			'role'       => [ 'sanitize_text_field', '' ],
		];

		$sanitized = [];
		foreach ( $params as $key => $config ) {
			list( $sanitize_fn, $default ) = $config;
			$value                         = $request->get_param( $key );
			$sanitized[ $key ]             = $value !== null ? $sanitize_fn( $value ) : $default;
		}

		$email      = $sanitized['email'];
		$first_name = $sanitized['first_name'];
		$last_name  = $sanitized['last_name'];
		$new_role   = $sanitized['role'];

		// Validate required parameters
		if ( ! $new_role || ( ! $email && ( ! $first_name || ! $last_name ) ) ) {
			return new \WP_Error(
				'invalid_input',
				esc_html__( 'Please provide either an email or both first and last name, along with the new role.', 'cool-kids-dashboard' ),
				[ 'status' => 400 ]
			);
		}

		// Find user by email or name
		$user = $this->get_user( $email, $first_name, $last_name );

		if ( ! $user ) {
			return new \WP_Error(
				'user_not_found',
				esc_html__( 'User not found.', 'cool-kids-dashboard' ),
				[ 'status' => 404 ]
			);
		}

		// Convert readable role name to role slug if needed
		$role_slug = $this->get_role_slug( $new_role );

		// Verify role exists
		if ( ! get_role( $role_slug ) ) {
			return new \WP_Error(
				'invalid_role',
				esc_html__( 'Invalid role specified.', 'cool-kids-dashboard' ),
				[ 'status' => 400 ]
			);
		}

		// Update user role
		$user->set_role( $role_slug );

		return rest_ensure_response(
			[
				'code'    => 'success',
				'message' => esc_html__( 'User role updated successfully.', 'cool-kids-dashboard' ),
				'data'    => [
					'status' => 200,
				],
			]
			);
	}

	/**
	 * Get user by email or name
	 *
	 * @param string $email      User email.
	 * @param string $first_name User first name.
	 * @param string $last_name  User last name.
	 * @return WP_User|false User object if found, false otherwise.
	 */
	private function get_user( $email, $first_name, $last_name ) {
		if ( $email ) {
			return get_user_by( 'email', $email );
		}

		$user_query = new \WP_User_Query(
			[
				'meta_query' => [
					'relation' => 'AND',
					[
						'key'     => 'first_name',
						'value'   => $first_name,
						'compare' => '=',
					],
					[
						'key'     => 'last_name',
						'value'   => $last_name,
						'compare' => '=',
					],
				],
			]
			);

		$users = $user_query->get_results();
		return ! empty( $users ) ? $users[0] : false;
	}

	/**
	 * Convert readable role name to role slug
	 *
	 * @param string $role The role name or slug
	 * @return string The role slug
	 */
	private function get_role_slug( $role ) {
		$role_mappings = [
			'Cool Kid'    => 'cool_kid',
			'Cooler Kid'  => 'cooler_kid',
			'Coolest Kid' => 'coolest_kid',
		];

		// If the role matches a readable name, return the corresponding slug
		if ( isset( $role_mappings[ $role ] ) ) {
			return $role_mappings[ $role ];
		}

		// If no match found, assume it's already a slug and return as is
		return strtolower( $role );
	}
}
