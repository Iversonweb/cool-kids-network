<?php

namespace Cool_Kids_Dashboard\Config;

use Cool_Kids_Dashboard\Inc\AccessControl;
use Cool_Kids_Dashboard\Inc\Admin\CountryMeta;
use Cool_Kids_Dashboard\Inc\Blocks\RegisterBlocks;
use Cool_Kids_Dashboard\Inc\Blocks\HeaderTools;
use Cool_Kids_Dashboard\Inc\Api\V1\Init;
use Cool_Kids_Dashboard\Inc\CreatePages;
use Cool_Kids_Dashboard\Inc\CustomMetadata;
use Cool_Kids_Dashboard\Inc\Front\Enqueue;
use Cool_Kids_Dashboard\Inc\Roles;
use Cool_Kids_Dashboard\Inc\Shortcodes;

class Plugin 
{
    /**
     * Services array
     *
     * @var array
     */
    protected $services = [];

    /**
     * Constructor to initialize the services
     *
     * @param RegisterBlocks $registerBlocks
     * @param Init $init
     * @param Roles $roles
     * @param Enqueue $enqueue
     * @param CustomMetadata $customMetadata
     * @param CountryMeta $countryMeta
     * @param Shortcodes $shortcodes
     * @param CreatePages $createPages
     * @param AccessControl $accessControl
     */
    public function __construct(
            RegisterBlocks $registerBlocks, 
            Init $init, 
            Roles $roles,
            Enqueue $enqueue,
            CustomMetadata $customMetadata,
            CountryMeta $countryMeta,
            Shortcodes $shortcodes,
            CreatePages $createPages,
            AccessControl $accessControl,
        )
    {
        $this->services = [
            $registerBlocks,
            $init,
            $roles,
            $enqueue,
            $customMetadata,
            $countryMeta,
            $shortcodes,
            $createPages,
            $accessControl,
        ];
    }

    /**
     * Register services
     *
     * @return void
     */
    public function register_services(){
        foreach($this->services as $service)
        {
            if( method_exists( $service, 'register' ) )
            {
                $service->register();
            }
        }
    }
}