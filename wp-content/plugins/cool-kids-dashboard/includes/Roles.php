<?php

namespace CoolKidsDashboard\Includes;

use CoolKidsDashboard\Includes\Interface\RegisterInterface;

class Roles implements RegisterInterface
{
    public function register() 
    {
        register_activation_hook( CKD_PLUGIN_FILE, [$this, 'register_custom_roles'] );
        register_deactivation_hook( CKD_PLUGIN_FILE, [$this, 'remove_custom_roles'] );
    }

    public function register_custom_roles() 
    {
        add_role( 
            'cool_kid', 
            'Cool Kid', 
            [
                'read' => true, 
                'view_dashboard' => true,
            ] 
        );

        add_role( 
            'cooler_kid', 
            'Cooler Kid', 
            [
                'read' => true,
                'view_dashboard' => true, 
                'view_few_users_data' => true
            ] 
        );

        add_role( 
            'coolest_kid', 
            'Coolest Kid', 
            [
                'read' => true,
                'view_dashboard' => true, 
                'view_all_users_data' => true
            ] 
        );
    }

    public function remove_custom_roles() 
    {
        remove_role( 'cool_kid' );
        remove_role( 'cooler_kid' );
        remove_role( 'coolest_kid' );
    }
}