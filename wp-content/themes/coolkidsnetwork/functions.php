<?php

namespace CoolKidsNetwork;

require_once __DIR__ . '/vendor/autoload.php';

use CoolKidsNetwork\Front\Enqueue;
use CoolKidsNetwork\Front\Head;
use CoolKidsNetwork\Front\ThemeSetup;

class Theme {

    protected $services = [];

    public function __construct()
    {
        $this->services = [
            new Enqueue(),
            new Head(),
            new ThemeSetup()
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

$enqueue = new Theme();
$enqueue->register_services();
