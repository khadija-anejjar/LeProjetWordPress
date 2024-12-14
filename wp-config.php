<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'project' );

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
define( 'AUTH_KEY',         'cqSNzfh;ePp1(2pkZU$s?C4uFiv5(}Uj#gCi-2.c9iLnMPqBT}+#]8a#z8MT}pks' );
define( 'SECURE_AUTH_KEY',  ']_Y`+rfPcrWS[dr75hxTK5B*YBck20wL)7R=j4EyrPf}[*oUjIj&0ee,< ZIXJFZ' );
define( 'LOGGED_IN_KEY',    'wQb?Yl$bY2K7L_>F~}w#e^@nuoO0(uZ21KHaIoXsHCw]=-pmFn5uBb8&sLz|gh X' );
define( 'NONCE_KEY',        '5&RWhFA*{zDNYn$FkZ35zj]y!.u{cI+u]yFNx^#u[{#(L?oNhzvWEBwjH:q[]j:[' );
define( 'AUTH_SALT',        '2]=AC8iG7z{g6`edxthDBqZ,IKYa_Z%dWtiPg8l]eRR5#k~4J>`xE3qzJ>+&|Zil' );
define( 'SECURE_AUTH_SALT', 'WQB5}rODQ8*1&GBkZBXyjD3h[}n&{N1g|,Y L1mH;$[X+!jk}rCCBi]r@>W5&X+V' );
define( 'LOGGED_IN_SALT',   'x]?~m;1]>%}JFp~D%(x@,p,tM1g>$gXQ]MLa N/n&~G7M~ial?crdle;GOLwY6:O' );
define( 'NONCE_SALT',       'Bdj`aQc<>CIQa_i2c)M;kv1+4Zlm0Q^`8VPNG@ug.Lx4D3drVa>Hn.Fzv{|gg!S/' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
