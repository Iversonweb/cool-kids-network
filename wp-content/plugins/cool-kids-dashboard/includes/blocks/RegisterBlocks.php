<?php

namespace CoolKidsDashboard\Includes\Blocks;

use CoolKidsDashboard\Includes\Interface\RegisterInterface;

class RegisterBlocks implements RegisterInterface 
{
    public function register() 
    {
        add_action( 'init', [$this, 'ckn_register_blocks'] );
    }

    public function ckn_register_blocks() {
        $blocks = [
            ['name' => 'header-tools', 'options' => [
                'render_callback' => 'ckn_header_tools_render_cb'
            ]]
        ];

        foreach( $blocks as $block )
        {
            register_block_type(
                CKD_PLUGIN_DIR . 'build/blocks/'. $block['name'],
                isset( $block['options'] ) ? $block['options'] : []
            );
        }
    }
}