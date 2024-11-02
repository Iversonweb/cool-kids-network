<?php

namespace CoolKidsDashboard\Inc\Api\V1;

class Signin 
{
    /**
     * Handle the signin request
     *
     * @param WP_REST_Request $request
     * @return WP_REST_Response|WP_Error
     */
    public function ckn_rest_api_signin_handler($request)
    {
        $email = sanitize_email( $request->get_param( 'email' ) );

        $validation = $this->validate( $email );
        if ( is_wp_error( $validation ) ) {
            return $validation;
        }

        return $this->authenticate( $email );
    }

    /**
     * Validate the email
     *
     * @param string $email
     * @return WP_Error|true
     */
    public function validate( $email )
    {
        if ( empty( $email ) || ! is_email( $email ) ) {
            return new \WP_Error(
                'invalid_email',
                'Yo that\'s not even an email! Try again.',
                ['status' => 400]
            );
        }

        $user = get_user_by('email', $email);

        if ( ! $user ) {
            return new \WP_Error(
                'email_exists',
                'Oops, you\'re not yet a cool kid! Sign up to become one.',
                ['status' => 400]
            );
        }

        return true;
    } 
    
    /**
     * Authenticate the user
     *
     * @param string $email
     * @return WP_REST_Response|WP_Error
     */
    public function authenticate( $email )
    {
        $user = get_user_by( 'email', $email );

        do_action( 'wp_login', $user->user_login, $user );

        wp_set_current_user( $user->ID );
        wp_set_auth_cookie( $user->ID, true );

        $error_response = $this->signin_error( $user->id );
        if ( is_wp_error( $error_response ) ) {
            return $error_response;
        }

        return new \WP_REST_Response( [
            'message' => 'Login successful.',
            'status' => 'success',
        ], 201 );
    }

    /**
     * Handle the signin error
     *
     * @param WP_Error|int $user_id
     * @return WP_Error|true
     */
    public function signin_error($user_id)
    {
        if ( is_wp_error($user_id) ) {
            return new \WP_Error(
                'signin_failed',
                $user_id->get_error_message(),
                ['status' => 500]
            );
        }

        return true;
    }
}