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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'aRNofp9P+OsiqrDltTVQaLip1LdhDdEJxPvcmrQNIuuT+Jy/Zp13xl+EBJpecxpPauWmIiRID/a/1vnyGI0nZw==');
define('SECURE_AUTH_KEY',  '9Yy9bUwI8/8USIN65ntfoJap7k/tgFXAQIzmxlUb7g6fTu7AdIqUsl7ORoxcUauz62ZFfUILsXvtWllBTxcNkw==');
define('LOGGED_IN_KEY',    'gjw0XEsxELWN2rqzBfTNyYsdH1mKtM5Glow+36olC7puPD1PM5UQrYX/T5jbUlpMnDvG8Af0LpsOFLaohJnrQg==');
define('NONCE_KEY',        'jEsnm8iaB1FPqbCIY/iJEXMHFzht3ZUw3kCtwcYzcAvt1/jFNITwfRPPUKz5g9o+w5VcFfr+ozoK0UeMDgjntw==');
define('AUTH_SALT',        'LhPiWzarx4DUNSlefxSzREEdayBi15XDiOT7g+xwDkyY9bPAYQ9+H95wu0oigBWXItArtnZIUCT7VW10/g1LDg==');
define('SECURE_AUTH_SALT', 'pM1qatfKBBklH+m01aWUVdH2ZYhfdEY7Xqhxpfq8pbXS03y+jA4iocoe3y8WsIe+ySU/4CSTRvtV1DLZJMZv3g==');
define('LOGGED_IN_SALT',   'mTeya+7+C4O/wXELOhO8QvIy9HDUmcdC1LVs6zV9gI5OHlxRa/3CaY6QXGP5xTVg9at81gZLSPzTPClpVnMnEQ==');
define('NONCE_SALT',       '2GKUnlHZG5CXZeP4Jz8noB0iAodThYglTjL6d+06Aie5XefqQ94fJC6TJTnFZ4C5hx5HnD+wOm/XAi1oAUm4Fw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
