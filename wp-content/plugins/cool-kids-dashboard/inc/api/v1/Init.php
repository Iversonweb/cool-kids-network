<?php

namespace CoolKidsDashboard\Inc\Api\V1;

use CoolKidsDashboard\Inc\Api\V1\Signup;
use CoolKidsDashboard\Inc\Api\V1\Signin;
use CoolKidsDashboard\Inc\Api\V1\ChangeRole;
use CoolKidsDashboard\Inc\Interface\RegisterInterface;
use WP_REST_Server;

class Init implements RegisterInterface
{
    /**
     * @var Signup
     */
    protected $signup;

    /**
     * @var Signin
     */
    protected $signin;

    /**
     * @var ChangeRole
     */
    protected $change_role;

    public function __construct( Signup $signup, Signin $signin, ChangeRole $change_role )
    {
        $this->signup = $signup;
        $this->signin = $signin;
        $this->change_role = $change_role;
    }

    /**
     * Register hooks
     *
     * @return void
     */
    public function register()
    {
        add_action( 'rest_api_init', [$this, 'ckn_rest_api_init'] );
    }

    /**
     * Register REST API routes
     *
     * @return void
     */
    public function ckn_rest_api_init()
    {
        register_rest_route( 'ckn/v1', '/signup', [
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => [$this->signup, 'ckn_rest_api_signup_handler'],
            'permission_callback' => '__return_true'
        ] );

        register_rest_route( 'ckn/v1', '/signin', [
            'methods' => WP_REST_Server::EDITABLE,
            'callback' => [$this->signin, 'ckn_rest_api_signin_handler'],
            'permission_callback' => '__return_true'
        ] );

        register_rest_route( 'ckn/v1', '/change-role', [
            'methods' => WP_REST_Server::EDITABLE,
            'callback' => [$this->change_role, 'ckn_rest_api_change_user_role'],
            'permission_callback' => function() {
                return current_user_can('administrator');
            },
        ] );
    }
}