<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '$]9E6&B#)!B*RQ 65<K*@dr[h0lI<wuUSScM9w-5payD JYcbL7>J2,~QulKp %h' );
define( 'SECURE_AUTH_KEY',   'Wo5jdJ| .~pfplfa%$qd=O_kbms>^CS,g[IxSd87p|sY}17dY2^X1#4#XO}@)lP ' );
define( 'LOGGED_IN_KEY',     'TWmyR-F/:N_h@.a~>~JLEz=k4l/B2CG.R-fMpDQ}6k),A}3c]E2Pbi`X5WPT;|L=' );
define( 'NONCE_KEY',         '|-)^lyU1{&|+(s;FY+fJhswzip!&.w>InFA}`JUS_0V7gf)I@ud|f|c)G|j/sdc`' );
define( 'AUTH_SALT',         '}|mbg+3~Ba J<*>-1Pix|SDEnv~TYav:_7+;bSCIsmX6CJpG1Hys%MuC(d,.4^,D' );
define( 'SECURE_AUTH_SALT',  'uvS+QDM]<|:2%?zF>neEdbBrVakvgEQ?=Dorl>=fud~2c<HBA4+%i*`YQ8Ys+Zzk' );
define( 'LOGGED_IN_SALT',    'X fl^q(4~6B0mbOlITQ>z!Xs7rCpJoS00r9!TO0![D%X~[c=otX[pCv@De#U1|38' );
define( 'NONCE_SALT',        'KKFc+wZ8N:<W)74$lgos>2i_qy^?ef`Cl#I%SGG+aJCERhLTI~-n:GXWQEL;tUtx' );
define( 'WP_CACHE_KEY_SALT', '0Jb8pGT,GI{Z$[yD2JG5!t^vP&*@eU[fNX^9%?Mq=Vwe.PJq*&9U#j8 z:[qK!H$' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
