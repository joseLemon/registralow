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
define('DB_NAME', 'wp_registralow');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

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
define('AUTH_KEY', 'orB_VA2N;fdg03LQ|KSAH0}1t,nx[xx^eLQV4h$/?X|0J1Cl!-K0PazZiCY@lmUo');
define('SECURE_AUTH_KEY', '@#-MURX-+~dG>!=}xas6tVYesLCnLr5[`z,7.P3-B3-Wm~$$qV?/3ZVsBN$Em^~.');
define('LOGGED_IN_KEY', '+bO|3gl:+mV@fi`)a&=6,6MK@s+J(xozsvO`~1(Fg[MII6W4X~B2U%?LGy(6VrC(');
define('NONCE_KEY', 'UO4l jwi-E[2Vd!cret;/P_$:ve{{lO|RMhFLl_c5MT(#b:7raP#O$(!#!&BFOF ');
define('AUTH_SALT', 'LA{uT_z>r08&-+h)n4qj~oc1zRbBKWz/{v>E,,;f.d#-{K/ buW!ejW[D0k.#[Uc');
define('SECURE_AUTH_SALT', 'g8D&4jlt )&.Z$MwzzKokn!oq]h8:c4L@Z[{+JHxz,Yk)/GsywoV#rVF=&|&Y-o]');
define('LOGGED_IN_SALT', 'N2z:o4U:.u ~3JQ6^Ax,){SghE:TlGHYhw7fGD_jLk0=qm gjFD`, 3=>B+iLnhM');
define('NONCE_SALT', 'aqt^PqRNHpl|S40)J8@O#DMh^G?Pt&XlcK,kP./8.V8&FSe1;!tO-N q G$Pm1y<');

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

