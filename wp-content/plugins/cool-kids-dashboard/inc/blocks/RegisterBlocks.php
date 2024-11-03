<?php

namespace Cool_Kids_Dashboard\Inc\Blocks;

use Cool_Kids_Dashboard\Inc\Interfaces\RegisterInterface;
use Cool_Kids_Dashboard\Inc\Blocks\HeaderTools;
use Cool_Kids_Dashboard\Inc\Blocks\AuthModal;
use Cool_Kids_Dashboard\Inc\Blocks\AuthToggler;

class RegisterBlocks implements RegisterInterface {
	/**
	 * HeaderTools instance
	 *
	 * @var HeaderTools
	 */
	protected $header_tools;

	/**
	 * AuthModal instance
	 *
	 * @var AuthModal
	 */
	protected $auth_modal;

	/**
	 * AuthToggler instance
	 *
	 * @var AuthToggler
	 */
	protected $auth_toggler;

	/**
	 * Constructor to initialize the instances
	 *
	 * @param HeaderTools $header_tools Instance of HeaderTools class.
	 * @param AuthModal   $auth_modal   Instance of AuthModal class.
	 * @param AuthToggler $auth_toggler Instance of AuthToggler class.
	 */
	public function __construct( HeaderTools $header_tools, AuthModal $auth_modal, AuthToggler $auth_toggler ) {
		$this->header_tools = $header_tools;
		$this->auth_modal   = $auth_modal;
		$this->auth_toggler = $auth_toggler;
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
					'render_callback' => [ $this->header_tools, 'render_header_tools' ],
				],
			],
			[
				'name'    => 'auth-modal',
				'options' => [
					'render_callback' => [ $this->auth_modal, 'render_auth_modal' ],
				],
			],
			[
				'name'    => 'auth-toggler',
				'options' => [
					'render_callback' => [ $this->auth_toggler, 'render_auth_toggler' ],
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
