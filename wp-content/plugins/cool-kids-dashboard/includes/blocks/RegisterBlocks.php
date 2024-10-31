<?php

namespace CoolKidsDashboard\Includes\Blocks;

use CoolKidsDashboard\Includes\Interface\RegisterInterface;
use CoolKidsDashboard\Includes\Blocks\HeaderTools;
use CoolKidsDashboard\Includes\Blocks\AuthModal;

class RegisterBlocks implements RegisterInterface 
{
    protected $headerTools;
    protected $authModal;

    public function __construct( HeaderTools $headerTools, AuthModal $authModal ) {
        $this->headerTools = $headerTools;
        $this->authModal = $authModal;
    }

    public function register() 
    {
        add_action( 'init', [$this, 'ckn_register_blocks'] );
    }

    protected function get_blocks() 
    {
        return [
            [
                'name' => 'header-tools',
                'options' => [
                    'render_callback' => [$this->headerTools, 'render_header_tools']
                ]
            ], 
            [
                'name' => 'auth-modal',
                'options' => [
                    'render_callback' => [$this->authModal, 'render_auth_modal']
                ]
            ],
        ];
    }

    public function ckn_register_blocks() 
    {
        $blocks = $this->get_blocks();
        
        foreach ( $blocks as $block ) {
            register_block_type(
                CKD_PLUGIN_DIR . 'build/blocks/' . $block['name'],
                isset( $block['options'] ) ? $block['options'] : []
            );
        }
    }
}