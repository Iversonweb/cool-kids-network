<?php

namespace CoolKidsDashboard\Inc\Blocks;

use CoolKidsDashboard\Inc\Interface\RegisterInterface;
use CoolKidsDashboard\Inc\Blocks\HeaderTools;
use CoolKidsDashboard\Inc\Blocks\AuthModal;
use CoolKidsDashboard\Inc\Blocks\AuthToggler;

class RegisterBlocks implements RegisterInterface {
	/**
	 * HeaderTools instance
	 *
	 * @var HeaderTools
	 */
	protected $headerTools;

	/**
	 * AuthModal instance
	 *
	 * @var AuthModal
	 */
	protected $authModal;

	/**
	 * AuthToggler instance
	 *
	 * @var AuthToggler
	 */
	protected $authToggler;

	/**
	 * Constructor to initialize the instances
	 *
	 * @param HeaderTools $headerTools
	 * @param AuthModal   $authModal
	 * @param AuthToggler $authToggler
	 */
	public function __construct( HeaderTools $headerTools, AuthModal $authModal, AuthToggler $authToggler ) {
		$this->headerTools = $headerTools;
		$this->authModal   = $authModal;
		$this->authToggler = $authToggler;
	}

	/**
	 * Register all blocks
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'init', [ $this, 'ckn_register_blocks' ] );
	}

	/**
	 * Get all blocks
	 *
	 * @return array
	 */
	protected function get_blocks() {
		return [
			[
				'name'    => 'header-tools',
				'options' => [
					'render_callback' => [ $this->headerTools, 'render_header_tools' ],
				],
			],
			[
				'name'    => 'auth-modal',
				'options' => [
					'render_callback' => [ $this->authModal, 'render_auth_modal' ],
				],
			],
			[
				'name'    => 'auth-toggler',
				'options' => [
					'render_callback' => [ $this->authToggler, 'render_auth_toggler' ],
				],
			],
		];
	}

	/**
	 * Register all blocks
	 *
	 * @return void
	 */
	public function ckn_register_blocks() {
		$blocks = $this->get_blocks();

		foreach ( $blocks as $block ) {
			register_block_type(
				CKD_PLUGIN_DIR . 'build/blocks/' . $block['name'],
				isset( $block['options'] ) ? $block['options'] : []
			);
		}
	}
}
