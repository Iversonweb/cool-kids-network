<?php

namespace CoolKidsDashboard\Inc\Blocks;

class AuthModal 
{
    /**
     * Render the auth modal
     *
     * @param array $atts
     * @return bool|string
     */
    public function render_auth_modal($atts) 
    {
        if( is_user_logged_in() )
        {
            return false;
        }

        $atts = shortcode_atts([
            'showRegister' => true,
        ], $atts);

        ob_start();
        require CKD_PLUGIN_DIR . 'templates/auth-modal.php';
        return ob_get_clean();
    }
}