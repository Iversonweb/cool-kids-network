<?php
/*
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

//Defines
define( 'CKD_PLUGIN_FILE', __FILE__ );
define( 'CKD_PLUGIN_DIR', plugin_dir_path(CKD_PLUGIN_FILE ) );
define( 'CKD_PLUGIN_URL', plugin_dir_url( CKD_PLUGIN_FILE ) );

require_once CKN_DEFAULT_PATH . '/vendor/autoload.php';

/**
 * Minimum required PHP version.
 *
 * @access public
 * @var    string
 */
$php_version = '5.3.0';

// Check if we meet the minimum PHP version.
if ( version_compare( PHP_VERSION, $php_version, '<' ) ) {

    // Add admin notice.
    add_action( 'admin_notices', array( $this, 'php_admin_notice' ) );

    // Bail.
    return;
}

use CoolKidsDashboard\Config\Plugin;
use CoolKidsDashboard\Inc\AccessControl;
use CoolKidsDashboard\Inc\Admin\CountryMeta;
use CoolKidsDashboard\Inc\Api\V1\Init;
use CoolKidsDashboard\Inc\Api\V1\Signin;
use CoolKidsDashboard\Inc\Api\V1\Signup;
use CoolKidsDashboard\Inc\Blocks\AuthModal;
use CoolKidsDashboard\Inc\Blocks\RegisterBlocks;
use CoolKidsDashboard\Inc\Blocks\HeaderTools;
use CoolKidsDashboard\Inc\CreatePages;
use CoolKidsDashboard\Inc\CustomMetadata;
use CoolKidsDashboard\Inc\Front\Enqueue;
use CoolKidsDashboard\Inc\Roles;
use CoolKidsDashboard\Inc\Shortcodes;
use CoolKidsDashboard\Inc\Blocks\AuthToggler;
/**
 * Initializes the main plugin services and registers them in a modular way.
 * */

// Initialize core dependencies
$headerTools = new HeaderTools();
$authModal = new AuthModal();
$authToggler = new AuthToggler();
$signup = new Signup();
$signin = new Signin();
// Initialize grouped dependency instances
$registerBlocks = new RegisterBlocks($headerTools, $authModal, $authToggler);
$init = new Init($signup, $signin);

// Create other individual dependencies
$roles = new Roles();
$enqueue = new Enqueue();
$customMetadata = new CustomMetadata();
$countryMeta = new CountryMeta();
$shortcodes = new Shortcodes();
$createPages = new CreatePages();
$accessControl = new AccessControl();

// Instantiate the main Plugin class with all dependencies
$plugin = new Plugin(
    $registerBlocks,
    $init,
    $roles,
    $enqueue,
    $customMetadata,
    $countryMeta,
    $shortcodes,
    $createPages,
    $accessControl,
);

// Register plugin services
$plugin->register_services();