<?php

namespace CoolKidsDashboard\Config;

use CoolKidsDashboard\Includes\Admin\CountryMeta;
use CoolKidsDashboard\Includes\Blocks\RegisterBlocks;
use CoolKidsDashboard\Includes\Blocks\HeaderTools;
use CoolKidsDashboard\Includes\Api\V1\Init;
use CoolKidsDashboard\Includes\CustomMetadata;
use CoolKidsDashboard\Includes\Front\Enqueue;
use CoolKidsDashboard\Includes\Roles;

class Plugin 
{
    protected $services = [];

    public function __construct(
            RegisterBlocks $registerBlocks, 
            Init $init, 
            Roles $roles,
            Enqueue $enqueue,
            CustomMetadata $customMetadata,
            CountryMeta $countryMeta,
        )
    {
        $this->services = [
            $registerBlocks,
            $init,
            $roles,
            $enqueue,
            $customMetadata,
            $countryMeta,
        ];
    }

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