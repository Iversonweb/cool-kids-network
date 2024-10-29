<?php

namespace CoolKidsDashboard\Config;

use CoolKidsDashboard\Includes\Blocks\RegisterBlocks;

class Plugin 
{
    protected $services = [];

    public function __construct(RegisterBlocks $registerBlocks)
    {
        $this->services = [
            $registerBlocks,
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