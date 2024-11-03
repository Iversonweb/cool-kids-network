<?php
/**
 * Cool Kids Dashboard Plugin
 *
 * @package Cool_Kids_Dashboard
 * @author  Iversonweb
 * @license GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:       Cool Kids Dashboard
 * Plugin URI:        https://wordpress.org/plugin/cool-kids-dashboard/
 * Description:       Handles authentication and dashboard functionality.
 * Version:           1.0
 * Requires at least: 5.9
 * Requires PHP:      8.0
 * Author:            Iversonweb
 * Update URI:        https://example.com/my-plugin/
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || die( 'Seems like you stumbled here by accident mate!' );

// Defines.
define( 'CKD_PLUGIN_FILE', __FILE__ );
define( 'CKD_PLUGIN_DIR', plugin_dir_path( CKD_PLUGIN_FILE ) );
define( 'CKD_PLUGIN_URL', plugin_dir_url( CKD_PLUGIN_FILE ) );

require_once CKN_DEFAULT_PATH . '/vendor/autoload.php';

/**
 * Minimum required PHP version.
 *
 * @access public
 * @var    string
 */
$ckd_php_version = '5.3.0';

// Check if we meet the minimum PHP version.
if ( version_compare( PHP_VERSION, $ckd_php_version, '<' ) ) {

	// Add admin notice.
	add_action( 'admin_notices', [ $this, 'php_admin_notice' ] );

	// Bail.
	return;
}

use Cool_Kids_Dashboard\Config\Plugin;
use Cool_Kids_Dashboard\Inc\AccessControl;
use Cool_Kids_Dashboard\Inc\Admin\CountryMeta;
use Cool_Kids_Dashboard\Inc\Api\V1\Init;
use Cool_Kids_Dashboard\Inc\Api\V1\Signin;
use Cool_Kids_Dashboard\Inc\Api\V1\Signup;
use Cool_Kids_Dashboard\Inc\Blocks\AuthModal;
use Cool_Kids_Dashboard\Inc\Blocks\RegisterBlocks;
use Cool_Kids_Dashboard\Inc\Blocks\HeaderTools;
use Cool_Kids_Dashboard\Inc\CreatePages;
use Cool_Kids_Dashboard\Inc\CustomMetadata;
use Cool_Kids_Dashboard\Inc\Front\Enqueue;
use Cool_Kids_Dashboard\Inc\Roles;
use Cool_Kids_Dashboard\Inc\Shortcodes;
use Cool_Kids_Dashboard\Inc\Api\V1\ChangeRole;
use Cool_Kids_Dashboard\Inc\Blocks\AuthToggler;

/**
 * Initializes the main plugin services and registers them in a modular way.
 */

// Initialize core dependencies.
$ckd_header_tools = new HeaderTools();
$ckd_auth_modal   = new AuthModal();
$ckd_auth_toggler = new AuthToggler();
$ckd_signup       = new Signup();
$ckd_signin       = new Signin();
$ckd_change_role  = new ChangeRole();

// Initialize grouped dependency instances.
$ckd_register_blocks = new RegisterBlocks( $ckd_header_tools, $ckd_auth_modal, $ckd_auth_toggler );
$ckd_init            = new Init( $ckd_signup, $ckd_signin, $ckd_change_role );

// Create other individual dependencies.
$ckd_roles           = new Roles();
$ckd_enqueue         = new Enqueue();
$ckd_custom_metadata = new CustomMetadata();
$ckd_country_meta    = new CountryMeta();
$ckd_shortcodes      = new Shortcodes();
$ckd_create_pages    = new CreatePages();
$ckd_access_control  = new AccessControl();

// Instantiate the main Plugin class with all dependencies.
$ckd_plugin = new Plugin(
	$ckd_register_blocks,
	$ckd_init,
	$ckd_roles,
	$ckd_enqueue,
	$ckd_custom_metadata,
	$ckd_country_meta,
	$ckd_shortcodes,
	$ckd_create_pages,
	$ckd_access_control
);

// Register plugin services.
$ckd_plugin->register_services();
