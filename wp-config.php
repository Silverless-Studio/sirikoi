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
define( 'AUTH_KEY',          'q,&D0?UPr5n+ y;q)LQcz^9LlxN4`rH^wi!!q/);w(Zoc0Om.pg%YCNd~;YvX#(w' );
define( 'SECURE_AUTH_KEY',   '6;Ks3YmzAc4hJtI*%l.X,At#w3Y#_y*` %x$DM%T]+!RkcpnCb0K8[r7&{7v}JFv' );
define( 'LOGGED_IN_KEY',     'V5CH8ZT9H5#DjQnT5``Rw aJB.D,0+ym:.>, JY/&4JTfjOxrJBAu~xr<=^%T9$X' );
define( 'NONCE_KEY',         'L:8p(!Rv|_bZwGTnvs,Y{|4QO|JKH:^2!Tu2KzyU^z=>/@q+;|R];Xg},):&$5bD' );
define( 'AUTH_SALT',         '=& GJ&ItFvOFLc3|}A[#uJ3piF30=DE}Vq&HN^]LH4a/neCu#Lo%iZ{jk)L]9Z]-' );
define( 'SECURE_AUTH_SALT',  'e!c?f^M{DZ{lpvEX}P<:}<3Ja{^<h#NYNgU>K}4}~S/b7GoV/.+`xXOG/MN9;gd_' );
define( 'LOGGED_IN_SALT',    ']IY@&<Q?<2q}OSXdO8+d=yP[s zL- ]^j1,veE[hP/BZ]-6<).lIbH=<^STM%R$]' );
define( 'NONCE_SALT',        '|5wO&)w>jrB;V<.*C)X{N8?8 I,lqmB hk,%DjD8{ER*F_NKxP^r}@uHk+jwfxzi' );
define( 'WP_CACHE_KEY_SALT', '6IAai)j_]@=+%`^%T-JZ[!fz_Jsdi2}@Uo8p^IjmL4 )h3uRl4D/;?<?,-`Dt_hl' );


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
