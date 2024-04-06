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
define( 'DB_NAME', 'pizzadb' );

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
define( 'AUTH_KEY',         '@i+>2*sJ~hAA6 dL?f1C.B2Ep;QXytV}eif90?cP]#wVIkHQ.^q@M%au >mc@`RC' );
define( 'SECURE_AUTH_KEY',  'D36|G mw_Z]23_KV;b=u=+--+_6IMQC4Bq`6S*g.`iUp]0>3cU81L;S/hx;iJUO#' );
define( 'LOGGED_IN_KEY',    'IonUD:C}XUvM`<w!fq~CH=}AiV9mWF3~vO0Bn`+NJd0|gQeL*/6KlZj!XZx!|_<j' );
define( 'NONCE_KEY',        '/]B/h0.hOcVLJ$%s~ %n01ekI-XU.d^C>XlG|(|iN3JMO[/nt~~a3/Qj->B<u<!)' );
define( 'AUTH_SALT',        ']7)8U6LbsJ bfddVJgb~50;nliar.-7aGk)h4G>W`0hiDP@^pMUmo,w]}A#t&6EX' );
define( 'SECURE_AUTH_SALT', 'ay`g$E!^#@C@[%ab<8jP:JqKF.1S-m%n%luMA(nic~[(oKG<X1<S,=Yf/%b2AtJs' );
define( 'LOGGED_IN_SALT',   'U>-Ea+i?(wg:U5EmUl:Zl#p{ZiQ.rxU!f.E)tr%,,@1QItsXq`9:rzj!%}&.z4A0' );
define( 'NONCE_SALT',       'L +u~14*X3+WONE]2`-+pw^X5!k^c&9YoDLi:o3PD^io9FI4eI2ln=DH4Y#XtW:V' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
