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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'enyendira' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '7~{s|GpUBV~9[?),M&qGCB]YL=hjF}qL9lR/.I6#Obvs&}da,Z<&,<6,@0FDvbK(' );
define( 'SECURE_AUTH_KEY',  'FA(mzi^k6% *F5LwbaI.eOm@UW{ii)2PZxXU]<b`?ZT6ybBCWoOR$52!|.[LeYta' );
define( 'LOGGED_IN_KEY',    'x}KQ(}D/wn.y&qJS-J4>:5b3cEt@gBqxGU/!Jx{wbrAla`u7AuBh_!hz#1cr`)V~' );
define( 'NONCE_KEY',        'VTrt5@1&a/Q%)Q66!079DbL.gX%3O g8g_AG0[S3fPMd.9I{/R|${SB,6C|[@G[)' );
define( 'AUTH_SALT',        'Fy6Z*EK 5v)!)tDG9p5AqKa;JB4FID8A /7+C:YF$R-e<Bf*mO+U^^i`8wbZ$w-}' );
define( 'SECURE_AUTH_SALT', 'R(|ED<9W[<ZKKC@}!oU8%FgjP!fh2Nu;T NW7CIq-|yA.G`2nP.PG+w,mCUK)3~}' );
define( 'LOGGED_IN_SALT',   'h4trupAI H,p,&1wD%c%c0)GRzqEuc2O%CLIX%ld{;,X7FI]~>iQu_ASZ{lqv;g,' );
define( 'NONCE_SALT',       'c.(*iBF5U9?j]A0Jlw9p,Zi8Fc!w)pwYf%|&e^?Q*rVR1oyI3`HUa=lptHkDW4&a' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
define('FS_METHOD', 'direct');
