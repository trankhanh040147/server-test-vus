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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

// $testConnection = mysqli_init();
// mysqli_ssl_set($testConnection, NULL, NULL, NULL, NULL, NULL); 
// mysqli_real_connect($testConnection, 'mysqlvuswebsite.mysql.database.azure.com', 'VUS', 'Vu$@!@#456789', 'demo_vus_db', 3306, MYSQLI_CLIENT_SSL);

// if (!$testConnection) {
//     die('Error: ' . mysqli_connect_errno());
// } else {
//     echo 'Database connection working!';
// }

// $testConnection = mysqli_init();
// mysqli_ssl_set($testConnection, '/path/to/client-key.pem', '/path/to/client-cert.pem', '/path/to/ca-cert.pem', NULL, NULL); 
// mysqli_real_connect($testConnection, 'mysqlvuswebsite.mysql.database.azure.com', 'VUS', 'Vu$@!@#456789', 'demo_vus_db', 3306, MYSQLI_CLIENT_SSL);

// if (!$testConnection) {
//     die('Error: ' . mysqli_connect_errno());
// } else {
//     echo 'Database connection working!';
// }

define( 'DB_NAME', 'demo_vus_db' );

/** Database username */
// define( 'DB_USER', 'root' );
define( 'DB_USER', 'VUS' );

/** Database password */
// define( 'DB_PASSWORD', '040147' );
define( 'DB_PASSWORD', 'Vu$@!@#456789' );

/** Database hostname */
// define( 'DB_HOST', 'localhost' );
define( 'DB_HOST', 'mysqlvuswebsite.mysql.database.azure.com' );
// define( 'DB_HOST', '20.195.62.54' );


/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );


define( 'DB_SSL', true );
define( 'MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL );


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
define( 'AUTH_KEY',         '[XIcEnP%p](wecu@{3REL!BE)Tq;Jg=c;{h?1XCI58BlbgSBd.:OM9^S*Vw|m6nK' );
define( 'SECURE_AUTH_KEY',  'x|;vGR$ 0#:Givo5>5];a040t<MF<hBt/mMD>1!:)0:* d4-97*=vx}+B/9^P&6+' );
define( 'LOGGED_IN_KEY',    '_Zit[W 1MesD+zUqnV.%3u63b38LG5D9!hZB9S/=SMWtWy@X6+qy)O-L2Y)qmEW!' );
define( 'NONCE_KEY',        'X!zL{nP.2gB7[xz}LIy5O8CHD,ZT}h+=<CqF9+S[&KRjSj3z?5k6<!R}/U*z7vzi' );
define( 'AUTH_SALT',        '6>gMbW %VW/Pt$:SuFK+0!Z2b/:uw*YZ*sd5Y/B83#)(^PNV(6lo.A!F=5dTFX9s' );
define( 'SECURE_AUTH_SALT', '|RZrcNLepb:Pz]?]})c?6f]&uv#`^Qh@Fzm[[Tx0r$VUJ7?M3VZ>6jS>_Zr|Q7vC' );
define( 'LOGGED_IN_SALT',   'vKPsK7s3{R@kf&J$8g.2f/(80jf%Cxjdqt[gsCN]d5b3*!z. `XeL-T01 ]awN+^' );
define( 'NONCE_SALT',       '~7>k#Vr5W7}~{]1>1)[J~zH-I^tRVC)[0{N<d%]37&@T<@,BN:Cxuh(~)f=)gi,0' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
