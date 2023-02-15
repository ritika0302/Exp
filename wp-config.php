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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define( 'DB_NAME', 'wp_example' );


/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'FS_METHOD', 'direct' );


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
define( 'AUTH_KEY',         'sXeDVB(l?;O{;yR^H;B,k1@-Cp&13U1a.+S^2R~jOX+S`gY_whO!oDSO0yePjf:9' );
define( 'SECURE_AUTH_KEY',  's+x0Iy&|l6Y5KL_?b{?(xEe:L;nS6Y^-dHiG3A%*m{mLq9J#l+&YKq}nnug]ym&z' );
define( 'LOGGED_IN_KEY',    ';)OIsf#:UE=s5uW4Joycy!qE6/~TG7ca*.TxH4U2 s1Z#1+/A4T^2LN7!HYgq0%n' );
define( 'NONCE_KEY',        't+]VJ60`P/QO#iiK!iz1K7HZjp2}/=Y~}>G_[!J8QD$vb[r=nsh=)s#Cz+m:*j>9' );
define( 'AUTH_SALT',        '=!zR@UHm$-6lnuK4X7bsU8BL%Ex5dFQ5mT506[g`Zip/0n-=;,];HsqfdtF{0B3[' );
define( 'SECURE_AUTH_SALT', '+.&hoswR1i0)vXpvQN>:GME2|=mp*;rr`Q/{#g(eZ4*-Rs5*T)*O0?K{/e 66{j{' );
define( 'LOGGED_IN_SALT',   '!@.{!`VdtVryquV{Eu[X9 xR#xzW4zq|i2+)~clsM`,z}]%::}]~]>beO,lK6Aoi' );
define( 'NONCE_SALT',       '_2S8I~ir3u!Fjf_;I1`Xc^MmCp~_=?.xZL1E2#n}$kkcn6yh?#/,P-Z]$S=IH_T5' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
