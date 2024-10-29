<?php

namespace CoolKidsNetwork\Front;
use CoolKidsNetwork\Front\ThemeInterface;

class ThemeSetup implements ThemeInterface {

    public function __construct() 
    {
        add_action('after_setup_theme', [$this, 'register']);
    }

    public function register(): void
    {
        add_theme_support('editor_styles');

        add_editor_style([
            'https://fonts.googleapis.com/css2?family=Pacifico&family=Rubik:wght@300;400;500;700&display=swap',
            'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap',
            'https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap',
            'assets/bootstrap-icons/bootstrap-icons.css',
            'assets/css/index.css',
            'assets/css/editor.css',
            'assets/css/custom.css',
        ]);
    }
}