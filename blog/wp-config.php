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
define('DB_NAME', 'campusguru');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'LF+#zU!3b]]<}8IxW=]QT#>UQNsXZ4#A|}`kC/7wvw|<<j8Y%LwXloDRaN)Vvc{5');
define('SECURE_AUTH_KEY',  '{dm4k}_$X@LO _1`.-LA;F#Fi[0!U+I3!m;>aH<Fi>8>W}R8|Gv &]p)V-M8o]Vu');
define('LOGGED_IN_KEY',    'lB.T4<ESS_]N~F1|UhvTq39,.[HhU@a}`~5;d5;sju_vXWO-5$>;h603)(.!d!o:');
define('NONCE_KEY',        'G0HO?&_(BO|nej6@b{c@}bkt-F24~v1BCRd|n7F^[z?(Lr>nic)g|tav#huW#F;s');
define('AUTH_SALT',        '5.b/h40P>}D;2m!<Y0o]W(DrN<A1th|&PI7fb4`m-&fHlN?rp-DAlZL|F}ZPHPm|');
define('SECURE_AUTH_SALT', ';:rH-2u(,*$zP-A=TI4fRi8TR;g{VH%czcov#e[KKe-r=XI) Ou4>K_-$ntze|=h');
define('LOGGED_IN_SALT',   '~CNi% =9J#dGZO[9yh;opXs[Rppm-Q>|D$TvtV.q6$^C|<O%|-Mn1Rv!$b>yH>^m');
define('NONCE_SALT',       'SnnCUzD d.x_zJ[JNfO1PPx|ek)#Fck:a(c~M/azsy.rIrdu4D_z3&,dWXisZ-&?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cg_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
