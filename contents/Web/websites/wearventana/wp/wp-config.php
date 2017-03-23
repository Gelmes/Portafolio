<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'pdrmedia_wrdp2');

/** MySQL database username */
define('DB_USER', 'pdrmedia_wrdp2');

/** MySQL database password */
define('DB_PASSWORD', 'xXupr9aw6g4OQz86');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'jMrm8u_7zO)e<*mMMBQ#JoN?Ume*#R;mP(fNepkhaJZ1vn(O$297q@jp^zJ|E76hLOq2z/W88~UdW');
define('SECURE_AUTH_KEY',  '/Od~qi?@!uKAhc0Z8frjGj#*K@/gRR96hofUw>Rq?dFF8-h?ec=~@I83ehtSc)kHamY');
define('LOGGED_IN_KEY',    '$PsF5lDn8ml1>_q7DaR*P^v3Q_;:j^8H3R8<0Y#UPTA)Lmwu:oNrVPxbeLS:dSDefU;');
define('NONCE_KEY',        'PL~LmbQbd*CwlI;>?55m8aLITspCo$UDvG|L~Y!cPTxT|q!BNr0JWgz1C3m|3uXL');
define('AUTH_SALT',        'VB(7/m\`?A-iX^yK1b3h@tj5aw8MyPUz|~Uz8g:0q*_w<U*-6:I=7X$48:krZR|k0sD$Lpb|U(a');
define('SECURE_AUTH_SALT', '~V:RTQn-tAnhtnADqhcHfXPy@^<P;gitDBiS\`-^5dLcJW^o|7|p5/sgFS\`N1JF:G');
define('LOGGED_IN_SALT',   'LXnhB\`ZJYOwch4xN6Hp6E^*pKUATouwGzc^=iE_$8nfWBL:s^MZGZMBF/i*te1Dc93XlT^2KVdrnVi');
define('NONCE_SALT',       'E/~;8cQR?nCfh:nyvP1KEHVo_ali358pPHVQ_TBJ*63^Hl\`erN>@I#e>uz66_0MCeLJaDK(NzgSJJYis^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
