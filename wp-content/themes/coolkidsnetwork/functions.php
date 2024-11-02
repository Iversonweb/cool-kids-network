<?php

require_once CKN_DEFAULT_PATH . '/vendor/autoload.php';

use CoolKidsNetwork\Front\Theme;
use CoolKidsNetwork\Front\Enqueue;
use CoolKidsNetwork\Front\Head;
use CoolKidsNetwork\Front\ThemeSetup;

/**
 * The enqueue scripts
 *
 * @var object
 */
$enqueueScripts = new Enqueue();

/**
 * The head
 *
 * @var object
 */
$head           = new Head();

/**
 * The theme setup
 *
 * @var object
 */
$themeSetup     = new ThemeSetup();

/**
 * The theme
 *
 * @var object
 */
$theme          = new Theme(
    $enqueueScripts,  
    $head, 
    $themeSetup,
);

/**
 * Register the services
 *
 * @return void
 */
$theme->register_services();