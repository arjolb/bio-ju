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
define( 'DB_NAME', 'bio-ju' );

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
define( 'AUTH_KEY',         'b&Wu-Spi>vl](,kF*I-q^|_R6MmESYW1aaP6W[U(4Z#`Wp5qlI>}KIKZdbifG}S+' );
define( 'SECURE_AUTH_KEY',  '@^bECJ[q!3cIf@ W1V#Zb![}eI[rB7a;y-)H(3%7Q:(~yG+9@%Ku%i4J$bmX3pWk' );
define( 'LOGGED_IN_KEY',    'R#2K&PUXhug52|*;ldOpGE6bK&=W?X@|CD(TyU$*YMYX^figI,n^gUo$4wpH*hqu' );
define( 'NONCE_KEY',        'LWWDqG@4UBUkA!V_M9;;$7G?|F175 qAJlbaT2f!-hwOrW5;Oo`0gk8tz3!( ih ' );
define( 'AUTH_SALT',        '7tJnc]n2s2<ZF$:(5IC&D;H^Ha+CR1|a:OVo Y=1nU4J;k[t d%b[ %<Q!8Fol_Y' );
define( 'SECURE_AUTH_SALT', '<EP#AEw^JUv1_sZv?,,].5e3^HPnFSm~w=|xwJhWF4Q/<F]3I$/<cX+B]N*?1z%c' );
define( 'LOGGED_IN_SALT',   '1EXhpW[1.SP28&CtMvAJY EmVBb 6dgO]LlXz#y_$0~XSh(`4-S.<;l01TE9zg.f' );
define( 'NONCE_SALT',       'a!U^<DM/I;Tp4b7oK,B`!2AJfp)y.5CrIYKf94N8W*5Ly+s!8(Ij(lXGiH}9<c{d' );

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
