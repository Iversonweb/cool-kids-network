<?php

namespace CoolKidsDashboard\Inc\Admin;

class CountryMeta 
{
    /**
     * Register the country meta
     *
     * @return void
     */
    public function register()
    {
        add_action('show_user_profile', [$this, 'display_country_meta']);
        add_action('edit_user_profile', [$this, 'display_country_meta']);
        add_action('personal_options_update', [$this, 'save_country_meta']);
        add_action('edit_user_profile_update', [$this, 'save_country_meta']);
    }

    /**
     * Display the country meta
     *
     * @param WP_User $user
     * @return void
     */
    public function display_country_meta( $user )
    {
        $country = get_user_meta( 
            $user->ID, 
            'country', 
            true 
        );

        require CKD_PLUGIN_DIR . 'templates/admin/admin-country-meta.php';
    }

    /**
     * Save the country meta
     *
     * @param int $user_id
     * @return void
     */
    public function save_country_meta( $user_id )
    {
        if ( current_user_can( 'edit_user', $user_id ) ) 
        {
            update_user_meta( 
                $user_id, 
                'country', 
                sanitize_text_field( $_POST['country'] ) 
            );
        }
    }
}