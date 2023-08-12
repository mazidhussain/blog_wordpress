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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'blog' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'tS3z774P|b6hsvn#s/#JRo,S<[G%ajo&&0R`4g*+2W#&^TKQT9$vh-rAYR:Yd;X]' );
define( 'SECURE_AUTH_KEY',  'SM~Z6M~83sEkH<xO=yim8N*-QXm:P:KFedUOKkm]o}wr5JjgND_(hj2]Rn{w^`@W' );
define( 'LOGGED_IN_KEY',    'VeU^y~u3-g~N5ls`Gj7P@Y`-EzR1xx7nM~sXlbM{fqE>*JgO}1yh8PH_HF|jM&[g' );
define( 'NONCE_KEY',        'aJ)kl -Q-DH1e*xjMRu,$8BlMlH+LU8`rCy}s[G#=%#lbtS6V*3kvy6I/j7&&Ce0' );
define( 'AUTH_SALT',        'Ec5@<Fmx(wDlXDg;ep G-Pq5iQ+5smV:^c8GA>rxrQ>BJf,WgjzrVpmx>_|cc2*j' );
define( 'SECURE_AUTH_SALT', 'z9.H2x}3-I(c~xr8Z4)u@qfME+oLWCRHeVAQtFc68ZWfT7{$L =?B!94.r1ssOFt' );
define( 'LOGGED_IN_SALT',   '|xRFp^*TUjDG8 = 7rdjgoe{+a>&N`V1mH?}R3FI>U/HymK!n.lX#-`tR]QvHD#[' );
define( 'NONCE_SALT',       'wsOtHx}C%f6x<Q@.(gR3aWnlz_{vR@n>7[UkxVNHac[{ksP1X=2webPtVU@i8g&7' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
