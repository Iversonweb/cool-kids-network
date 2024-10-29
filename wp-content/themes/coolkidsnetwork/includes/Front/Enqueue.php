<?php

namespace CoolKidsNetwork\Front;
use CoolKidsNetwork\Front\ThemeInterface;

class Enqueue implements ThemeInterface {

    private $container;

    protected $styles = [
        'ckn_font_rubik_and_pacifico' => [
            'relative' => null,
            'url' => 'https://fonts.googleapis.com/css2?family=Pacifico&family=Rubik:wght@300;400;500;700&display=swap',
        ],
        'ckn_font_montserrat' => [
            'relative' => null,
            'url' => 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap',
        ],
        'ckn_font_kanit' => [
            'relative' => null,
            'url' => 'https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap',
        ],
        'ckn_bootstrap_icons' => [
            'relative' => false,
            'url' => 'assets/bootstrap-icons/bootstrap-icons.css',
        ],
        'ckn_theme' => [
            'relative' => false,
            'url' => 'assets/css/index.css',
        ],
        'ckn_custom_style' => [
            'relative' => false,
            'url' => 'assets/css/custom.css',
        ],
    ];
    
    public function register() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    public function enqueue_styles(): void 
    {
        foreach ( $this->styles as $key => $value ) {
            $url = null !== $value['relative'] ? get_theme_file_uri( $value['url'] ) : $value['url'];

            wp_register_style(
                $key,
                $url,
                [],
                $value['relative'],
            );

            wp_enqueue_style( $key );
        }
    }
}