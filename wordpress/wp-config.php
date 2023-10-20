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
define( 'DB_NAME', 'wp_wordpress' );

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
define( 'AUTH_KEY',         'P`belXr!VDfLB4qcey>uc++ZkZr6PhL6hN;7DNX x7&s2oiC^HL7RBUUfPY:<oWK' );
define( 'SECURE_AUTH_KEY',  '8,$>;# +xF*V{qa4vO6`or$e0{6|] .bA%;8b+GH!989Hz!~tTSu(!oh9K;__c/ ' );
define( 'LOGGED_IN_KEY',    '+1$8dw6(8b(e ,6w9>HrDFxK9@lm~rO$P0`EIT#!MKm*,|Bl1N@g9H^Q<38,GS$^' );
define( 'NONCE_KEY',        'E#w?-lj`$l}w+KU~Y`$AE@v1HEd5>*o|auak-=XjoW%Nr~v^[_ h( Qp,$]!$Bv/' );
define( 'AUTH_SALT',        'BQ{q()QMg`Hocqcdjc2gpoxJ$zuNJ~DsT~Bd>[>tUp2lV=-(>mz,E%QpCj74;)@S' );
define( 'SECURE_AUTH_SALT', 'gz;n<`G^+KW_!WB{4%;{L1,S(@<iSY543a@:F?[1cm:pf,~vL8D<l[@.ZS[/}@ch' );
define( 'LOGGED_IN_SALT',   '.7Ji=?2g}4UrN%b0[n*sg,h*&87U<bqd3.43+~6Z*e7daXUyCEESS!PP6:S9m(l:' );
define( 'NONCE_SALT',       ':+Y1Fe^Cyjh$uRAAN4Ae-J=o)ewX@K?,)9,#+K7;WI^6M1)1{=tYL8!,YE%j*]o[' );

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
