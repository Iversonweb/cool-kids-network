<?php

namespace CoolKidsNetwork\Front;

use CoolKidsNetwork\Front\Enqueue;
use CoolKidsNetwork\Front\Head;
use CoolKidsNetwork\Front\ThemeSetup;

class Theme {

    /**
     * The services
     *
     * @var array
     */
    protected $services = [];

    public function __construct( Enqueue $enqueue, Head $head, ThemeSetup $themesetup )
    {
        /**
         * The services
         *
         * @var array
         */
        $this->services = [
            $enqueue,
            $head,
            $themesetup
        ];
    }

    /**
     * Register the services
     *
     * @return void
     */
    public function register_services()
    {
        foreach( $this->services as $service ) {
            if( method_exists($service, 'register') ) {
                $service->register();
            }
        }
    }
} 