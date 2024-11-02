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
     * The constructor
     *
     * @return void
     */
    public function __construct( Signup $signup, Signin $signin )
    {
        $this->signup = $signup;
        $this->signin = $signin;
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
    }
}