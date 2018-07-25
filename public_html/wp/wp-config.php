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


if( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ) {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_dct');

define('WFWAF_ENABLED', false);

/** MySQL database username */
define('DB_USER', 'wpdct');

/** MySQL database password */
define('DB_PASSWORD', 'Re%$4$%#%$#5ignsTw#$%$@@$');

/** MySQL hostname */
define('DB_HOST', '10.136.6.205:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FORCE_SSL_ADMIN', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'z.kr$x&4aU0_Oa!]tZ6 AtVLzigK!Rk3zyI6G!a*I65lHv9ur?8T3oAhdQ}Jen/(');
define('SECURE_AUTH_KEY',  '/mG`6UL1N[.9>oACgyg0vB%`OBgW0FO.(Uq+~`XDWTvIe.Ha]~ckMYX]x#uWEOE-');
define('LOGGED_IN_KEY',    'p78o7Fl.M(5<ox;2b&%+Zqu}_eI.<6}5M>`H1Et<Zv3SvTUP.{:gmwk,OLF/r= S');
define('NONCE_KEY',        'kkr* t{pj}tI4!vE Tp?h@$O|EZ!qU{H,lz& GwTW3rSjLIMN<B)!mbLO<1F#Hcs');
define('AUTH_SALT',        '^esS:4x](IH-BZuvi|~qLO|M0|%%mv-n9mQl7VO-`+,tu]?P./*jFRUOx_4yk/?$');
define('SECURE_AUTH_SALT', 'R(I{+x%a]n5m]pvA9as,=|%K|6Nv/46K@d&nS$&,D&r1=83xWP}sB:S3cy]^W9_~');
define('LOGGED_IN_SALT',   'b~9h})]ABhN=+0Grox(N3`hSRW<e}A{5X;0dDP>I94W-CY(V$~3z/ QA4jgNtZp1');
define('NONCE_SALT',       'fy_<lKQwpzO+XW(3j-7T9*M-F:$z`Ed]LA(UUuevnsz}pozHIp8r%|wdh]-)O5G-');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_m_';

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
define('WP_DEBUG', true);


/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'directcartrim.com');
define('PATH_CURRENT_SITE', '/wp/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
