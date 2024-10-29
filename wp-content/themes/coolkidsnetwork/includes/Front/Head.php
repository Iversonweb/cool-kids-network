<?php

namespace CoolKidsNetwork\Front;
use CoolKidsNetwork\Front\ThemeInterface;

class Head implements ThemeInterface 
{

    public function register() {
        add_action('wp_head', [$this, 'add_preconnect_links'], 5);
    }

    public function add_preconnect_links() 
    {
        $urls = [
            'https://fonts.googleapis.com',
            'https://fonts.gstatic.com'
        ];

        $links = '';
        foreach ( $urls as $url ) {
            $sanitizedUrl = esc_url( $url );
            $crossorigin = ( $sanitizedUrl === 'https://fonts.gstatic.com' ) ? ' crossorigin' : '';
            $links .= "<link rel=\"preconnect\" href=\"$sanitizedUrl\"$crossorigin>\n";
        }

        echo $links;
    }
}