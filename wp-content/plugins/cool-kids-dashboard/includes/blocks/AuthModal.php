<?php

namespace CoolKidsDashboard\Includes\Blocks;

class AuthModal 
{
    public function render_auth_modal($atts) 
    {
        $atts = shortcode_atts([
            'showRegister' => true,
        ], $atts);

        ob_start();
        require CKD_PLUGIN_DIR . 'templates/auth-modal.php';
        return ob_get_clean();
    }
}