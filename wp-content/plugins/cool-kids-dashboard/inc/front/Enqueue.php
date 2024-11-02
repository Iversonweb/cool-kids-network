<?php

namespace CoolKidsDashboard\Inc\Front;

use CoolKidsDashboard\Inc\Interface\RegisterInterface;

class Enqueue implements RegisterInterface 
{
    /**
     * Array of custom styles
     *
     * @var array
     */
    protected $styles = [
        'ckn_shortcode_styles' => [
            'url' => 'assets/css/shortcodes.css',
        ],
        'ckn_index_styles' => [
            'url' => 'assets/css/index.css',
        ],
    ];

    public function register() 
    {
        add_action( 'wp_enqueue_scripts', [$this, 'ckn_enqueue_scripts'] );
        add_action( 'wp_enqueue_scripts', [$this, 'ckn_enqueue_styles'] );
    }

    /**
     * Enqueue auth scripts
     *
     * @return void
     */
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

    /**
     * Enqueue custom styling
     *
     * @return void
     */
    function ckn_enqueue_styles() {
        foreach ( $this->styles as $key => $value ) {
            $url = CKD_PLUGIN_URL . $value['url'];

            // Register Style
            wp_register_style(
                $key,
                $url,
                [],
                file_exists( $url ) ? filemtime( $url ) : false
            );

            // Enqueue Style
            wp_enqueue_style( $key );
        }
    }
}