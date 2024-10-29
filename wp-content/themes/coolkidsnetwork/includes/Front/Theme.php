<?php

namespace CoolKidsNetwork\Front;

use CoolKidsNetwork\Front\Enqueue;
use CoolKidsNetwork\Front\Head;
use CoolKidsNetwork\Front\ThemeSetup;

class Theme {

    protected $services = [];

    public function __construct( Enqueue $enqueue, Head $head, ThemeSetup $themesetup )
    {
        $this->services = [
            $enqueue,
            $head,
            $themesetup
        ];
    }

    public function register_services()
    {
        foreach( $this->services as $service ) {
            if( method_exists($service, 'register') ) {
                $service->register();
            }
        }
    }
} 