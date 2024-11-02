<?php

namespace CoolKidsDashboard\Inc;

use CoolKidsDashboard\Inc\Interface\RegisterInterface;

class AccessControl implements RegisterInterface
{
    protected $pages = [
        'ckn_my-dashboard_page_id',
        'ckn_kids-directory_page_id',
    ];

    /**
     * Initialize hooks for access control.
     *
     * @return void
     */
    public function register() {
        add_action( 'template_redirect', [$this, 'restrict_auth_pages'] );
        add_action( 'template_redirect', [$this, 'redirect_cool_kid_to_404'] );
    }

    /**
     * Restrict access to dashboard and directory pages for non-logged-in users.
     *
     * @return void
     */
    public function restrict_auth_pages() 
    {
        foreach( $this->pages as $page ) {
            // Retrieve the stored page IDs
            $page_id = get_option( $page );

            // Check if the current page is one of the restricted pages and if the user is logged out
            if ( is_page( $page_id ) && !is_user_logged_in() ) {
                // Redirect to home with a custom query parameter for the signin modal
                wp_redirect( home_url( '/?show_signin=true' ) );
                exit;
            }
        }
    }

    /**
     * Redirect cool kid to 404
     *
     * @return void
     */
    public function redirect_cool_kid_to_404() {
        if (is_user_logged_in() && current_user_can('cool_kid')) {
            if (strpos($_SERVER['REQUEST_URI'], 'kids-directory') !== false) {
                global $wp_query;
                $wp_query->set_404();
                status_header(404); 
                include(get_404_template());
                exit;
            }
        }
    }
}