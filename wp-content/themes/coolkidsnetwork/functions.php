<?php

namespace CoolKidsNetwork;

require_once __DIR__ . '../../../../vendor/autoload.php';

use CoolKidsNetwork\Front\Theme;
use CoolKidsNetwork\Front\Enqueue;
use CoolKidsNetwork\Front\Head;
use CoolKidsNetwork\Front\ThemeSetup;


$register = new Theme(
    new Enqueue(),  
    new Head(), 
    new ThemeSetup(),
);

$register->register_services();