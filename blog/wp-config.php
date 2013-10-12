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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '891026');

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
define('AUTH_KEY',         '3woCHPLiD$el~YyQ(2Qt:oBB-tw8#OIwz]qfB06M-wR*sh~9]d#0 z kFF:uR3r%');
define('SECURE_AUTH_KEY',  'J59M^us!~Ac$#p%^;,4}Orn`;5a{hdGQ#|k6M7{!G/J~/L1M65jlk`#XyA4g3nzN');
define('LOGGED_IN_KEY',    '~AV0v*8Z?}Ik[|O-RFm,TkrY8Q}?j{CI9?r?|d@KbsOu_V0zL>Pb7qAT{ tExNb/');
define('NONCE_KEY',        'HA0)<z&xu6UC(<^Ppr6.Hx::5GEHCKih=##0$_rs1,=`w{h9z|dLt,H!uQuK*%,)');
define('AUTH_SALT',        '(j1B-`a9{$xj%2pM&E(J~dfOOJW/}vFU[:}3LX,slu{9j@Z-)bUIaJ`n{3]6`lFp');
define('SECURE_AUTH_SALT', '/b<abQcE]pUEO:x.{`PgL:&t3m:bK2qbrw?;SJM]D}hYe++c.[0MD[^8[+IOAjku');
define('LOGGED_IN_SALT',   '*0)IQQ.dO2UkowoRoidPcI2k_ 3n1xv<h7rW?;h]xnU4ze0pyzIH>Q1r 2BIfWbt');
define('NONCE_SALT',       '-N,KtVt6ey53DcVh6EF~A#e:,JSL>vMKwG8CEw9=(`^WmmY?8n2&KB^Ssx dc}%^');

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
