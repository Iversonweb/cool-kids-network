<?php

namespace CoolKidsDashboard\Inc\Api\V1;

class Signup 
{
    /**
     * Handle the signup request
     *
     * @param WP_REST_Request $request
     * @return WP_REST_Response|WP_Error
     */
    public function ckn_rest_api_signup_handler($request)
    {
        $email = sanitize_email( $request->get_param( 'email' ) );
        $password = 'CoolKidsNetwork@24';

        $validation = $this->validate( $email );
        if ( is_wp_error( $validation ) ) {
            return $validation;
        }

        $user_id = wp_insert_user( [
            'user_login' => $email,
            'user_email' => $email,
            'user_pass'  => $password,
            'role'       => 'cool_kid',
        ] );

        $error_response = $this->signup_error( $user_id );
        if ( is_wp_error( $error_response ) ) {
            return $error_response;
        }

        $this->fetch_and_update_user_data($user_id);
        return $this->authenticate( $user_id );
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

        if ( email_exists( $email ) ) {
            return new \WP_Error(
                'email_exists',
                'Oops, we already have a cool kid with that email! Try something else.',
                ['status' => 400]
            );
        }

        return true;
    } 

    /**
     * Authenticate the user
     *
     * @param int $user_id
     * @return WP_REST_Response|WP_Error
     */
    public function authenticate( $user_id )
    {
        $user = get_user_by( 'id', $user_id );

        do_action( 'wp_login', $user->user_login, $user );

        wp_set_current_user( $user_id );

        wp_set_auth_cookie( $user_id, true );

        return new \WP_REST_Response( [
            'message' => 'Signup successful.',
            'status' => 'success',
        ], 201 );
    }

    /**
     * Fetch and update user data
     *
     * @param int $user_id
     * @return void
     */
    private function fetch_and_update_user_data($user_id)
    {
        $response = wp_remote_get( 'https://randomuser.me/api/' );
        if ( is_wp_error( $response ) ) {
            return;
        }

        $data = json_decode( wp_remote_retrieve_body( $response ), true );
        if ( isset( $data['results'][0] ) ) {
            $user_data = $data['results'][0];
            update_user_meta( $user_id, 'first_name', $user_data['name']['first'] );
            update_user_meta( $user_id, 'last_name', $user_data['name']['last'] );
            update_user_meta( $user_id, 'country', $user_data['location']['country'] );
        }
    }

    /**
     * Handle the signup error
     *
     * @param WP_Error|int $user_id
     * @return WP_Error|true
     */
    public function signup_error($user_id)
    {
        if ( is_wp_error( $user_id ) ) {
            return new \WP_Error(
                'signup_failed',
                $user_id->get_error_message(),
                ['status' => 500]
            );
        }

        return true;
    }
}