<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'wp_1');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'uralvasm');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '=;,+Vb?L>N|Y9+@@l _7x] ;LVF4Tqaf>DX`M@~JF,F]31N,BN=(kW@?V,3A<jQ4');
define('SECURE_AUTH_KEY', 'p3}.Nf &n}eiukQAU9u(JMs{bg4Kk,J,pe&zrIKJ{B& UmI1nVdrkmwV~UnqN48u');
define('LOGGED_IN_KEY', 'y)b5E$n[w`Z^}#q2;S`ro OWLIQBAqyK=f:US&hzk%N;/.u#Pytld }x4!R.gKG_');
define('NONCE_KEY', 'MXCIx *`>.A4OMgFUe2w4*fRs1BiZVZZ3~4Z_}2b;Dv;i&]O$eLhMcnQoD78;=c]');
define('AUTH_SALT', 'X(PBA4PQ)mA8^}o>sB}.7R2mq_pG:E/$<3x]2SYK33SMMI07o8dcQIBp QE7Z600');
define('SECURE_AUTH_SALT', '&&7fp]A l|^1ng%BoW$ %w4.u,ZzST6G4GT-t)%F9WB)ru6dY{ReD[3pj1yt0vwp');
define('LOGGED_IN_SALT', 'RJ&l&#$n,@sX5F1~;JW~Gd2|5b!{I%@)bW$-djK[q]DRK(voil|[S2H*]K**VO)x');
define('NONCE_SALT', '7d+Tr`]X3-YDDjnXVw@vD#&/yRvW{T2f}WEru27WuKipdaE9TTK0G&J}FMPk)lU,');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

