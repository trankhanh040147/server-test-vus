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
define( 'DB_NAME', 'demo_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '040147' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         't#T~+CT4*Gd=N7(v/vR;>H_)v[eNk.%Bl`{/1}@p#PiY;H?#8CFV8z4Zf(RI[U.6' );
define( 'SECURE_AUTH_KEY',  'a,CADz}2PN!o(;[7;:F@G6l7j{N,;8+3rC-!ADk.i&CG,7K,!rZ-N.Sb:;oGSv w' );
define( 'LOGGED_IN_KEY',    '!/[;(_96VSgft(rmm{=cDx.t{.4IFERa^7)h2#+nWylOYrU+1YbhmwoBz*73zv+h' );
define( 'NONCE_KEY',        '5q+d^uAl&x>g8N@AFn#qd*PL<K7V4QZtpiIVn$1vXc(rN#).Qf8.W|dY 18[/V_?' );
define( 'AUTH_SALT',        '3X b/I:xyV% 7AYKy*Ja1aJ3!u^j2$Wx3;$3imD+Dd&Hm~+q-. w+s-zL{B`RloD' );
define( 'SECURE_AUTH_SALT', 'zX@Hu*dG0%`x;psTlumuWpyCL/a-n&/<vW@v4xsfHj1xK#!{gD*3Fr3x:PRSpb3(' );
define( 'LOGGED_IN_SALT',   'i4,!aCO$2*Qif1|Iu+p}Z}Y#A$!tKpB&d;f=6v;#5G2/[R%cYJQ?Js<)waPuwWr&' );
define( 'NONCE_SALT',       'i4f892I>~jO._[<;3132N!IfO4f2|5?lHZYN#dsUjjrrVqIz+omcjM^P4rM Gi~j' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
