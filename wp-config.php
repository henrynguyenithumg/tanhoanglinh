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
// define('DB_NAME', 'tanhoanglinh');

// /** MySQL database username */
// define('DB_USER', 'root');

// /** MySQL database password */
// define('DB_PASSWORD', '1');

// /** MySQL hostname */
// define('DB_HOST', 'localhost');

// /** Database Charset to use in creating database tables. */
// define('DB_CHARSET', 'utf8mb4');

// /** The Database Collate type. Don't change this if in doubt. */
// define('DB_COLLATE', '');
define('DB_NAME', 'tanhoanglinh');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'pQNm201R');

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
define('AUTH_KEY',         ',95,OG]Rl3.@L?7&_BH0gk7SQa!yEkxgG!lT1u(W!T0yv9?|L]W:vX_Mb;#<3BwY');
define('SECURE_AUTH_KEY',  '=Ga0 jcQc;qR5Yy7 }5tZ&7jna[wz!`[YkVvko#&2r{jQ(KQJ_4trH!I@rPOqIGj');
define('LOGGED_IN_KEY',    'Hl{4beJMErRu|Urq-=zIS,;QJ-.T@_erV+^?Z^3KKLnnN8uF`VSD[>eT8e<v Zh<');
define('NONCE_KEY',        '0tJm%f.2`SQskV{cs> G 8t/<_dp$Js&/p?t[zzSF4cJRnGw;CEab(8H*[KYgh0~');
define('AUTH_SALT',        '(+ qJXJ+n0:*U70.kY!*,ZJ_7E~L413`95$( W+PLid.#iq!|P.]|yv@nKqQ=h:<');
define('SECURE_AUTH_SALT', 'PE?^H> 9A9+r!0]?Rz94qfX eBzb/VUIFmFs{La!kWSJ4],}fm]63Zzv@MB3ZrM[');
define('LOGGED_IN_SALT',   'tiN5J=5ATpg$1]K/G18c)(L@BnS_+*mr|Q6Oyt!IL4I;9P;1jZA/|rXkE[m<XN0 ');
define('NONCE_SALT',       '@%?,J%,>M?R~7;m/x/Lk^KZKP3T/T-:4J;x(3oEH8aY;l;d=Kzpl(_zOF,7-h:Ya');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

/* That's all, stop editing! Happy blogging. */
define('FS_METHOD', 'direct');

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
