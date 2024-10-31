<?php

namespace CoolKidsDashboard\Includes\Blocks;

class HeaderTools 
{
    public function render_header_tools($atts) 
    {
        $atts = shortcode_atts([
            'showAuth' => true,
        ], $atts);

        ob_start();
        require CKD_PLUGIN_DIR . 'templates/header-tools.php';
        return ob_get_clean();
    }
}