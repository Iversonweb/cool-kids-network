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

use CoolKidsDashboard\Config\Plugin;
use CoolKidsDashboard\Includes\Blocks\RegisterBlocks;

$register = new Plugin(
    new RegisterBlocks
);

$register->register_services();
