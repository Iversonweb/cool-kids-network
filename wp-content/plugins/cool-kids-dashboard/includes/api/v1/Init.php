<?php

namespace CoolKidsDashboard\Includes\Api\V1;

use CoolKidsDashboard\Includes\Api\V1\Signup;
use CoolKidsDashboard\Includes\Api\V1\Signin;
use CoolKidsDashboard\Includes\Interface\RegisterInterface;

class Init implements RegisterInterface
{
    protected $signup;
    protected $signin;

    public function __construct( Signup $signup, Signin $signin )
    {
        $this->signup = $signup;
        $this->signin = $signin;
    }

    public function register()
    {
        add_action( 'rest_api_init', [$this, 'ckn_rest_api_init'] );
    }

    public function ckn_rest_api_init()
    {
        register_rest_route('ckn/v1', '/signup', [
            'methods' => 'POST',
            'callback' => [$this->signup, 'ckn_rest_api_signup_handler'],
            'permission_callback' => '__return_true'
        ]);

        register_rest_route('ckn/v1', '/signin', [
            'methods' => 'POST',
            'callback' => [$this->signin, 'ckn_rest_api_signin_handler'],
            'permission_callback' => '__return_true'
        ]);
    }
}