<?php

namespace CoolKidsDashboard\Includes\Front;

use CoolKidsDashboard\Includes\Interface\RegisterInterface;

class Enqueue implements RegisterInterface 
{
    public function register() 
    {
        add_action( 'wp_enqueue_scripts', [$this, 'ckn_enqueue_scripts'] );
    }

    public function ckn_enqueue_scripts(): void 
    {
        $styles = json_encode( [
            'signup' => esc_url_raw( rest_url( 'ckn/v1/signup' ) ),
            'signin' => esc_url_raw( rest_url( 'ckn/v1/signin' ) )
        ] );

        wp_add_inline_script(
            'cool-kids-dashboard-auth-modal-script',
            'const ckn_auth_rest = '.$styles.';',
            'before',
        );
    }
}