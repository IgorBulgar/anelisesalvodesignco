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

define('DB_NAME', 'anelise1_gluten');



/** MySQL database username */

define('DB_USER', 'anelise1_gluten');



/** MySQL database password */

define('DB_PASSWORD', '{qQ3x)qwmwCB');



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

define('AUTH_KEY',         'j|& %@>[>){qfbZ3C1-=)o8cF{*Kud8(8~0v#5NfKn@zl]LM4&Y_,l!m#25o)~[s');

define('SECURE_AUTH_KEY',  '/21,&U*I&)^y+dcaH2cg.f-L5R&3z2Re`~xUwS(?HHIA;;AT[=P8yy-HUN|>=BZy');

define('LOGGED_IN_KEY',    'Ye]Vybe3*#V,n83]]26Lt#%w^ogHB.?[ETeVB<.&ktwz,eeWQ&}**Y/mOfRi<Fmm');

define('NONCE_KEY',        'uTa)M`$I=Lt7aGB&BY7^t7 pf)om^/wohw~Lpjf&u]nWwhx3$n F;_,j?5TCy;vR');

define('AUTH_SALT',        '>~1d!)*+J4+QSr!of>fY?j{;=*AvLYdwD=H*3SmbI6Y}-0O]~L~J&uNGh%66O#NN');

define('SECURE_AUTH_SALT', '>7w??>%9Rq#kN=K(~ wWUMHBkZa:*1&4f,$?~Tt924P:1#,j>*F<gaot j0V!RPv');

define('LOGGED_IN_SALT',   'FR<G)LS{*$W9Yk #& as#1^S9u~d@v1FCQZRgZ1pY4{1l~<05!$(ji`RX*}4Tw(q');

define('NONCE_SALT',       'r!S4uDU}C9EwsEa/a)!zj*Sx`4#5v$x*LKODPj15tN;E`ya(01uON7INXRGm{S4,');



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



define( 'AUTOSAVE_INTERVAL', 300 );
define( 'WP_POST_REVISIONS', 5 );
define( 'EMPTY_TRASH_DAYS', 7 );
define( 'WP_CRON_LOCK_TIMEOUT', 120 );
/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

