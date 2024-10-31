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

namespace CoolKidsDashboard;

require_once __DIR__ . '../../../../vendor/autoload.php';

defined( 'ABSPATH' ) || die( 'Seems like you stumbled here by accident mate!' );
define( 'CKD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define('CKD_PLUGIN_FILE', __FILE__);

use CoolKidsDashboard\Config\Plugin;
use CoolKidsDashboard\Includes\Admin\CountryMeta;
use CoolKidsDashboard\Includes\Api\V1\Init;
use CoolKidsDashboard\Includes\Api\V1\Signin;
use CoolKidsDashboard\Includes\Api\V1\Signup;
use CoolKidsDashboard\Includes\Blocks\AuthModal;
use CoolKidsDashboard\Includes\Blocks\RegisterBlocks;
use CoolKidsDashboard\Includes\Blocks\HeaderTools;
use CoolKidsDashboard\Includes\CustomMetadata;
use CoolKidsDashboard\Includes\Front\Enqueue;
use CoolKidsDashboard\Includes\Roles;

$register = new Plugin(
    new RegisterBlocks ( 
        new HeaderTools,
        new AuthModal
    ),
    new Init (
        new Signup,
        new Signin
    ),
    new Roles,
    new Enqueue,
    new CustomMetadata,
    new CountryMeta,
);

$register->register_services();