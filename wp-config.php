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
define( 'DB_NAME', "fluix" );

/** MySQL database username */
define( 'DB_USER', "wpuser" );

/** MySQL database password */
define( 'DB_PASSWORD', "password" );

/** MySQL hostname */
define( 'DB_HOST', "localhost" );

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
define( 'AUTH_KEY',         'WJv_5GLN,zD9 k7d QX$vm5yrG7xMNRq@D7:=+,Ae6x$q^>bRHjHK#%q3A%0 -$=' );
define( 'SECURE_AUTH_KEY',  't;mlQMA=r-s!@lC~V#;2tI),5L/_e&7s_3o2YGCe`O{rcz{u59rI[tKN*aC[QB:6' );
define( 'LOGGED_IN_KEY',    '#abl!Rv0$iGKC5mm^>jdAn!|0C(7/6!g{2-hMhVCYjI(NPn@xvSr[?IZ#IVa#:lJ' );
define( 'NONCE_KEY',        ')zAmmrUWDn`D+}(6+]HI%F_ ![!dCsQVN-~t*Bb_@bdZqp$j=JpH3rAL6#mr2hXt' );
define( 'AUTH_SALT',        'H$;B{w32f-~4dc(S?b`2R^!9%0px6~p:.P;)7t%H|S#ksHz4,QH&q^Pxcn3FZ|}A' );
define( 'SECURE_AUTH_SALT', ']FEcM~8$iTPo?V-e*YPK[a6Frp,M^V?y^dH#&)pgZe ~Rm+T[/ydS3:r]%#7YJnA' );
define( 'LOGGED_IN_SALT',   'atDV?Osxd9d?AxP6BF@>]EP`2.qP]j#XsZ.s!6(zOTr8 :HV&4)GTi~{*PP9gj2N' );
define( 'NONCE_SALT',       '5KwapO./OkZ7SvRXQR>*!-bjA%,@Hv.EDqEBk]7$xOpor~`)~;_}(5~,M;0e0np5' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );

define( 'WP_SITEURL', 'http://localhost/fluix/' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
