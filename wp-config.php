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
define('DB_NAME', 'wp_registralow');

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
define('AUTH_KEY',         'z_gB,yXXXc*YK5]TZS]mx]25UXHnJuwVxM[c9VyJ{yuU_y0jrs?_8rmT!w=|U>`w');
define('SECURE_AUTH_KEY',  'HBMED>&3aWfU+oEVKe=z-s<+v#[zOl9Fp1Q{h`Sa,RG2<Pdk$)d8*h-#*<;|&<QL');
define('LOGGED_IN_KEY',    '>@^l?B$A?Ho2e-TJ{rgj}~!,6j!B~-_+9B_-bJy/C+_J9+*n|Etg K)Y,wH3Sg>a');
define('NONCE_KEY',        'I^:7kL!?x{<tGh;Y24?iG$th+toO(}?O!du|xl>R,}LQ+8W)d*-B|L@+VW&/!8y>');
define('AUTH_SALT',        '~%fAeog9bn9|V7O/FtQ%|+96}u7]%=qB/VmFFG$dT`F1rq9[WppZMk8p{m{5TV0~');
define('SECURE_AUTH_SALT', 'o%kbKG|~~k&?=7l[v!wbLaS?%[xIR[SRYaRU6h5OeSf ^c441._?E~m*?n6+^LeK');
define('LOGGED_IN_SALT',   '+)=ST+bc|WYii%!Zm)g@Bi6x ELFZPZu%{fQ!f%j@sF>Rz?`J*y5^co=fq,@NOH*');
define('NONCE_SALT',       '5T`UYcpQ_IhNJ/=={AK#=Z&S,,i1p#Kf--cQ%b[)Ulp9mQef0-_~hQ8mP4;A2+/Y');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
