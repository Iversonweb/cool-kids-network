<?php

namespace CoolKidsDashboard\Includes\Admin;

class CountryMeta 
{
    public function register()
    {
        add_action('show_user_profile', [$this, 'display_country_meta']);
        add_action('edit_user_profile', [$this, 'display_country_meta']);
        add_action('personal_options_update', [$this, 'save_country_meta']);
        add_action('edit_user_profile_update', [$this, 'save_country_meta']);
    }

    public function display_country_meta( $user )
    {
        $country = get_user_meta( 
            $user->ID, 
            'country', 
            true 
        );

        require CKD_PLUGIN_DIR . 'templates/admin/admin-country-meta.php';
    }

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