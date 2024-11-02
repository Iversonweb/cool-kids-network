<?php

namespace CoolKidsDashboard\Config;

use CoolKidsDashboard\Inc\AccessControl;
use CoolKidsDashboard\Inc\Admin\CountryMeta;
use CoolKidsDashboard\Inc\Blocks\RegisterBlocks;
use CoolKidsDashboard\Inc\Blocks\HeaderTools;
use CoolKidsDashboard\Inc\Api\V1\Init;
use CoolKidsDashboard\Inc\CreatePages;
use CoolKidsDashboard\Inc\CustomMetadata;
use CoolKidsDashboard\Inc\Front\Enqueue;
use CoolKidsDashboard\Inc\Roles;
use CoolKidsDashboard\Inc\Shortcodes;

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