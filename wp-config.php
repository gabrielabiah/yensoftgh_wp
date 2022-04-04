<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'yensoft_db' );

/** MySQL database username */
define( 'DB_USER', 'yensoft_user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'p@$$wordGH13' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ':V<q^aXSY,x>Kvv<M6)wko1|Aoa{wJl]u1!kxMvuS9|O1jf;1Q%N/J7G8O}_]:%2' );
define( 'SECURE_AUTH_KEY',  '~/rupFi%y(OoX>=T|T&>0[Q]X3`&o)@k=4oP-hZL=0qD:o(2tM4o!gEpHuwTwO9D' );
define( 'LOGGED_IN_KEY',    'sYu?eT1*f?SGE{9*z]vlAI?o8K1n%q~(2H>wrAy?RqQzZu;h?D|7GGJ;^^:G/Oh4' );
define( 'NONCE_KEY',        '5+JN,x3?>ZQ?DudDeh%KyVa~I5;l?op^s*EQv%IW?CPbN`7IY!P:<wY9{^*2P&Jg' );
define( 'AUTH_SALT',        '&M}G*o,ooB1GXA<R27Q[BP`8X@QlsDVf nceuW Zp3*d|tKZG ^Irw2uqCtd0W~8' );
define( 'SECURE_AUTH_SALT', '/uGyZk@)&jj-6]1VZCA#=tVuz_$Mv:*x6p0Si{l:`mIw3$&>=l Y0-U B^_B~QbW' );
define( 'LOGGED_IN_SALT',   'Q^23,8BM;!h|bt?ZC*e 2m<~mRnIBuMr)pS:896eKdNo!me|=<y$5&h*4JkGSCE&' );
define( 'NONCE_SALT',       '-+lx?Ec~O:_CXt?OVj)!vKt7X$X%)n7cVdv-P;[6DvVFBu{)`hDd$5Rl-]G]jxxx' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'xwp_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
