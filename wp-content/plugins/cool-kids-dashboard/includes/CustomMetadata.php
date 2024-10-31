<?php

namespace CoolKidsDashboard\Includes;

use CoolKidsDashboard\Includes\Interface\RegisterInterface;

class CustomMetadata implements RegisterInterface
{
    public function register()
    {
        register_activation_hook( CKD_PLUGIN_FILE, [$this, 'ckd_create_country_metadata'] );
    }

    function ckd_create_country_metadata() 
    {
        $users = get_users();
    
        foreach ( $users as $user ) {
            if ( !metadata_exists('user', $user->ID, 'country' )) {
                update_user_meta( $user->ID, 'country', '' );
            }
        }
    }
}