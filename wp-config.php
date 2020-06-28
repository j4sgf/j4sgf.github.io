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
define( 'DB_NAME', 'terexindonesiatest1_' );

/** MySQL database username */
define( 'DB_USER', 'terexindonesiatest1_' );

/** MySQL database password */
define( 'DB_PASSWORD', 'J@04bs05cb97' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/XK,8SS{*q0gQ,=ej$^Pk#{h^xhaJaBc6i.os^K~r@/[a9F57|R@,jy5^bs69Y%7');
define('SECURE_AUTH_KEY',  'G/dHZ)*CXb+2eFag@TR[|%}5+p^/&#Zc:2}f%XDJ8n6XVDosgcYJnRpr:s^d%R=}');
define('LOGGED_IN_KEY',    '%r5:yWBRi6NI$Ly[B?5]#{U+vYC[;:3QXB%Ns|u+vg0NyNV1M>$r!ju3%-j_*eP&');
define('NONCE_KEY',        'glsvos$A <VFG|H(=c^-)hUC=b;_d:97mS6N*{=1e=t|X/s[4FVS^N|Gy=mlQ.>$');
define('AUTH_SALT',        '/56kh_{D[-2!6((m|p_^4@V5;03tZzKHe,K(CPax;rI1n(z#gL;TqegHMwGkh/7`');
define('SECURE_AUTH_SALT', 'LJ?bDv5`zNV*;Q^|lgNa6gl3Jlu:B=FRYK~dedUuMUdS~<3*k0?J ,vUux2atis^');
define('LOGGED_IN_SALT',   'D!/<,ha6F[|s7~|mykzXc||+dy0Ur;iPCw9PKerCn~s$j{{8BHjjq&VA|LC,/h4L');
define('NONCE_SALT',       'M4]A+<::![v~,KRbq@Eu{lgsK:Mj@=AOFyW+<Y o+b ;~@Q1o9HhL!7p]D,Q%-BU');

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
