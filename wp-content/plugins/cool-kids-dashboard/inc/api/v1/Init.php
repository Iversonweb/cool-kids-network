<?php

namespace Cool_Kids_Dashboard\Inc\Api\V1;

use Cool_Kids_Dashboard\Inc\Api\V1\Signup;
use Cool_Kids_Dashboard\Inc\Api\V1\Signin;
use Cool_Kids_Dashboard\Inc\Api\V1\ChangeRole;
use Cool_Kids_Dashboard\Inc\Interfaces\RegisterInterface;
use WP_REST_Server;

class Init implements RegisterInterface {

	/**
	 * Signup instance for handling user registration.
	 *
	 * @var Signup
	 */
	protected $signup;

	/**
	 * Signin instance for handling user authentication.
	 *
	 * @var Signin
	 */
	protected $signin;

	/**
	 * ChangeRole instance for handling user role changes.
	 *
	 * @var ChangeRole
	 */
	protected $change_role;

	/**
	 * Initialize the API routes with required dependencies.
	 *
	 * @param Signup     $signup      Instance of Signup class.
	 * @param Signin     $signin      Instance of Signin class.
	 * @param ChangeRole $change_role Instance of ChangeRole class.
	 */
	public function __construct( Signup $signup, Signin $signin, ChangeRole $change_role ) {
		$this->signup      = $signup;
		$this->signin      = $signin;
		$this->change_role = $change_role;
	}

	/**
	 * Register hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'rest_api_init', [ $this, 'ckn_rest_api_init' ] );
	}

	/**
	 * Register REST API routes.
	 *
	 * @return void
	 */
	public function ckn_rest_api_init() {
		register_rest_route(
			'ckn/v1',
			'/signup',
			[
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => [ $this->signup, 'ckn_rest_api_signup_handler' ],
				'permission_callback' => '__return_true',
			]
		);

		register_rest_route(
			'ckn/v1',
			'/signin',
			[
				'methods'             => WP_REST_Server::EDITABLE,
				'callback'            => [ $this->signin, 'ckn_rest_api_signin_handler' ],
				'permission_callback' => '__return_true',
			]
		);

		register_rest_route(
			'ckn/v1',
			'/change-role',
			[
				'methods'             => WP_REST_Server::EDITABLE,
				'callback'            => [ $this->change_role, 'ckn_rest_api_change_user_role' ],
				'permission_callback' => function () {
					return 'administrator' === wp_get_current_user()->roles[0];
				},
			]
		);
	}
}
