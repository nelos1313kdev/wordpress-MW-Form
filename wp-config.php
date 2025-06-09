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
define( 'DB_NAME', 'work' );

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
define( 'AUTH_KEY',         'w:q(To^fQ:/IIg1,#u6:m&L@G pN{827HlNN<Li/a8u2PtRz-bq+WRfE8)*:~D?4' );
define( 'SECURE_AUTH_KEY',  'O;GV1W6f1O0#P9Yac%`FArk<qgbNPp@$!!sneUN*9EG?7RL~Y1b)1h#h;PPDY,xZ' );
define( 'LOGGED_IN_KEY',    'm4B3}?7yKetdJng6Xy,M<],3h6q57> 5=w/FpfIc8M<8T(3F+ogs09=~vMt& 86A' );
define( 'NONCE_KEY',        'i?2Yp:iL`ND+g 5(Y9El5e4sfU9FX1?w#X,ClAiR(Z<x`#,m<kUua<vYgZg~!sJ{' );
define( 'AUTH_SALT',        'f.Qj3nd/8|9(y0kOC6}GJc{D3VRR<yc}2qB:GyZ:JHRe8J/W>j>J;t,Z9Nw{G{Nu' );
define( 'SECURE_AUTH_SALT', 'bypuNv$NAVIV)]N4/yw.`P78c#VO1qQp)ho9/,8u~3Af?tL#-1Z9^JFz}{>4r$b:' );
define( 'LOGGED_IN_SALT',   'c4WF+7,AX|^q>Xv{P]d.o?XNV?z?j{`,xcLyu|[C}F8+a[-ZDR Fqi9z+G83[:nk' );
define( 'NONCE_SALT',       '.bm;v+~JU$b@#mYBcp[)r[Ow5^(OZ)W&A]*PMk$[8@`3w>8L2m_|*.@Htt;KClqo' );

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
