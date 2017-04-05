<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Define the theme-specific key to be sent to PressTrends.
define( 'WOO_PRESSTRENDS_THEMEKEY', 'zdmv5lp26tfbp7jcwiw51ix9sj389e712' );

// WooFramework init
require_once ( get_template_directory() . '/functions/admin-init.php' );

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
    'includes/theme-options.php', 			// Options panel settings and custom settings
    'includes/theme-functions.php', 		// Custom theme functions
    'includes/theme-actions.php', 			// Theme actions & user defined hooks
    'includes/theme-comments.php', 			// Custom comments/pingback loop
    'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
    'includes/sidebar-init.php', 			// Initialize widgetized areas
    'includes/theme-widgets.php',			// Theme widgets
    'includes/theme-install.php',			// Theme installation
    'includes/theme-woocommerce.php',		// WooCommerce options
    'includes/theme-plugin-integrations.php'	// Plugin integrations
);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );

foreach ( $includes as $i ) {
    locate_template( $i, true );
}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/
/*
 * goes in theme functions.php or a custom plugin
 **/
// add item to cart on visit
/*
add_action( 'template_redirect', 'add_product_to_cart' );
function add_product_to_cart() {
	if ( is_user_logged_in() ) {
		$product_id = 67;
		$found = false;
		//check if product already in cart
		if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
			foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->id == $product_id )
					$found = true;
			}
			// if product not found, add it
			if ( $found != 1 )
				WC()->cart->add_to_cart( $product_id );
		} else {
			// if no products in cart, add it
			WC()->cart->add_to_cart( $product_id );
		}
	}
}

add_filter ('woocommerce_add_to_cart_redirect', 'woo_redirect_to_checkout');
function woo_redirect_to_checkout() {
	$checkout_url = WC()->cart->get_checkout_url();
	return $checkout_url;
}*/

/*
add_filter( 'woocommerce_add_cart_item_data', 'woo_custom_add_to_cart' );

function woo_custom_add_to_cart( $cart_item_data ) {

    global $woocommerce;
    $woocommerce->cart->empty_cart();

    // Do nothing with the data and return
    return $cart_item_data;
}*/
add_action("woocommerce_checkout_order_processed", "my_awesome_publication_notification");

function my_awesome_publication_notification() {
    global $wpdb;
    $current_user = wp_get_current_user();
    $ID = $current_user->ID;
    $brand_id = $wpdb->get_results("SELECT brand_id FROM brands WHERE user_id =".$ID." AND created_at = (select MAX(created_at) FROM brands WHERE user_id =".$ID.")");
    $wp_posts_id = $wpdb->get_results("SELECT post_id FROM wp_postmeta WHERE meta_id = (select MAX(meta_id) FROM wp_postmeta WHERE meta_key ='_customer_user' AND meta_value =".$ID.");");
    $wpdb->query("UPDATE  brands SET wp_post_id = ".$wp_posts_id[0]->post_id." WHERE brand_id = ".$brand_id[0]->brand_id.";");

}

/*function login_redirect ($redirect_to, $url, $user) {

    if ( !isset($user->errors) ) {
        return $redirect_to;
    }

    wp_redirect( home_url() . '?action=login&failed=1');
    exit;

}
add_filter('login_redirect', 'login_redirect', 10, 3);*/

function my_account_login_redirect() {
    return home_url().'/mi-cuenta';
}

add_filter('login_redirect', 'my_account_login_redirect');

if($_COOKIE['firstVisit'] != false) {
    setcookie('firstVisit', false, time() + (10 * 365 * 24 * 60 * 60), "/"); // delete in ten years
}

function GenerateThumbnail($im_filename,$th_filename,$max_width,$max_height,$quality = 0.75) {
// The original image must exist
    if(is_file($im_filename))
    {
        // Let's create the directory if needed
        $th_path = dirname($th_filename);
        if(!is_dir($th_path))
            mkdir($th_path, 0777, true);
        // If the thumb does not aleady exists
        if(!is_file($th_filename))
        {
            // Get Image size info
            list($width_orig, $height_orig, $image_type) = @getimagesize($im_filename);
            if(!$width_orig)
                return 2;
            switch($image_type)
            {
                case 1: $src_im = @imagecreatefromgif($im_filename);    break;
                case 2: $src_im = @imagecreatefromjpeg($im_filename);   break;
                case 3: $src_im = @imagecreatefrompng($im_filename);    break;
            }
            if(!$src_im)
                return 3;


            $aspect_ratio = (float) $height_orig / $width_orig;

            $thumb_height = $max_height;
            $thumb_width = round($thumb_height / $aspect_ratio);
            if($thumb_width > $max_width)
            {
                $thumb_width    = $max_width;
                $thumb_height   = round($thumb_width * $aspect_ratio);
            }

            $width = $thumb_width;
            $height = $thumb_height;

            $dst_img = @imagecreatetruecolor($width, $height);
            if(!$dst_img)
                return 4;
            $success = @imagecopyresampled($dst_img,$src_im,0,0,0,0,$width,$height,$width_orig,$height_orig);
            if(!$success)
                return 4;
            switch ($image_type)
            {
                case 1: $success = @imagegif($dst_img,$th_filename); break;
                case 2: $success = @imagejpeg($dst_img,$th_filename,intval($quality*100));  break;
                case 3: $success = @imagepng($dst_img,$th_filename,intval($quality*9)); break;
            }
            if(!$success)
                return 4;
        }
        return 0;
    }
    return 1;
}


function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background: url(<?php echo get_bloginfo('template_url'); ?>/img/index/icons/registralow.png) no-repeat center center;
            height: 50px;
            width: 320px;
            background-size: contain;
            cursor: pointer;
            pointer-events: none;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function sendStatusUpdate ($email,$type,$is_update) {
    if($type == 'revision') {
        if($is_update) {
            $message_content =
                'Hay noticias acerca de tu trámite:';

            $message = '
               <style>
               @import url("https://fonts.googleapis.com/css?family=Open+Sans");
               table {
                   font-family: "Open Sans","sans-serif";
               }
               </style>
               <table style="border-collapse: collapse;margin: 0 auto;background: #fff;border-radius: 5px;width: 800px;border: 1px solid #e3e3e3;border-spacing: 0;">
                   <tbody>
                   <tr style="background-color: #1da6df;margin-bottom: 5px;">
                       <td colspan="2" style="margin: 0 auto;height: auto;padding: 10px 15px;text-align: right;">
                           <img src="'.get_bloginfo('template_url').'/img/index/icons/r-white.png" alt="Registralow" style="display: inline-block;width: 30px;margin-right: 15px;">
                           <a href="https://registralow.com" style="color: #fff;display: inline-block;line-height:30px;margin:0;text-decoration:none!important;float:right;font-size:16px;">www.registralow.com</a>
                       </td>
                   </tr>
                   <tr style="height: 5px;"></tr>
                   <tr style="background-color: #456170;">
                       <td>
                           <img src="'.get_bloginfo('template_url').'/img/index/nosotros/h1.png" style="max-width: 420px;position:relative;bottom:-1px;">
                       </td>
                       <td style="margin: 0 auto;height: auto;padding: 15px;color: #353535;color:#fff;">
                          <h2 style="font-weight:400;font-size:22px;">¡Tenemos noticias para tí!</h2>
                          <p style="font-size:16px;">
                               '.$message_content.'
                          </p>
                          <p style="font-size:16px;">
                               Conoce el estatus de tu trámite en<br>
                               <a style="font-size:16px;color:#fff!important;" href="href="'.home_url().'/mi-cuenta">www.registralow.com/mi-cuenta</a>
                          </p>
                       </td>
                   </tr>
                   <tr style="background-color: #fff;">
                       <td colspan="2" style="margin: 0 auto;height: auto;padding: 10px 15px;">
                           <p style="color: #5a5a5a; text-align: center; font-size: 18px;">
                                Accediendo con tu cuenta de correo y constraseña este 
                               <a style="font-weight:700;font-size:18px;color:#5a5a5a!important;" href="href="'.home_url().'/mi-cuenta">link</a>
                           </p>
                       </td>
                   </tr>
                   </tbody>
               </table>
           ';
        } else {
            $message_content =
                'Nuestro equipo en estos momentos
            se encuentra haciendo la búsqueda de tu marca
            para darte una opinión legal.';

            $message = '
               <style>
               @import url("https://fonts.googleapis.com/css?family=Open+Sans");
               table {
                   font-family: "Open Sans","sans-serif";
               }
               </style>
               <table style="border-collapse: collapse;margin: 0 auto;background: #fff;border-radius: 5px;width: 800px;border: 1px solid #e3e3e3;border-spacing: 0;">
                   <tbody>
                   <tr style="background-color: #1da6df;margin-bottom: 5px;">
                       <td colspan="2" style="margin: 0 auto;height: auto;padding: 10px 15px;text-align: right;">
                           <img src="'.get_bloginfo('template_url').'/img/index/icons/r-white.png" alt="Registralow" style="display: inline-block;width: 30px;margin-right: 15px;">
                           <a href="https://registralow.com" style="color: #fff;display: inline-block;line-height:30px;margin:0;text-decoration:none!important;float:right;font-size:16px;">www.registralow.com</a>
                       </td>
                   </tr>
                   <tr style="height: 5px;"></tr>
                   <tr style="background-color: #456170;">
                       <td>
                           <img src="'.get_bloginfo('template_url').'/img/index/nosotros/h1.png" style="max-width: 420px;position:relative;bottom:-1px;">
                       </td>
                       <td style="margin: 0 auto;height: auto;padding: 15px;color: #353535;color:#fff;">
                          <h2 style="font-weight:400;font-size:22px;">¡ Gracias por confiar en <img src="'.get_bloginfo('template_url').'/img/logo.png" alt="Registralow" style="max-width: 125px;display:inline-block;position:relative;bottom:-4px;"> !</h2>
                          <p style="font-size:16px;">
                               '.$message_content.'
                          </p>
                          <p style="font-size:16px;">
                               Conoce el estatus de tu trámite en<br>
                               <a style="font-size:16px;color:#fff!important;" href="href="'.home_url().'/mi-cuenta">www.registralow.com/mi-cuenta</a>
                          </p>
                       </td>
                   </tr>
                   <tr style="background-color: #fff;">
                       <td colspan="2" style="margin: 0 auto;height: auto;padding: 10px 15px;">
                           <p style="color: #5a5a5a; text-align: center; font-size: 18px;">
                                Accediendo con tu cuenta de correo y constraseña este 
                               <a style="font-weight:700;font-size:18px;color:#5a5a5a!important;" href="href="'.home_url().'/mi-cuenta">link</a>
                           </p>
                       </td>
                   </tr>
                   </tbody>
               </table>
           ';
        }

    } else if ($type == 'register') {
        if($is_update) {
            $message_content =
                'Hay noticias acerca de tu trámite:';
            $message = '
               <style>
               @import url("https://fonts.googleapis.com/css?family=Open+Sans");
               table {
                   font-family: "Open Sans","sans-serif";
               }
               </style>
               <table style="border-collapse: collapse;margin: 0 auto;background: #fff;border-radius: 5px;width: 800px;border: 1px solid #e3e3e3;border-spacing: 0;">
                   <tbody>
                   <tr style="background-color: #dede38;margin-bottom: 5px;">
                       <td colspan="2" style="margin: 0 auto;height: auto;padding: 10px 15px;">
                           <img src="'.get_bloginfo('template_url').'/img/index/icons/r-blue.png" alt="Registralow" style="display: inline-block;width: 30px;margin-right: 15px;float: left;">
                           <a href="https://registralow.com" style="color: #1da6df;display: inline-block;line-height:30px;margin:0;text-decoration:none!important;font-size:16px;">www.registralow.com</a>
                       </td>
                   </tr>
                   <tr style="height: 5px;"></tr>
                   <tr style="background-color: #1da6df;">
                       <td style="margin: 0 auto;height: auto;padding: 15px;color: #353535;color:#fff;">
                          <h2 style="font-weight:400;font-size:22px;">¡ Gracias por confiar en <img src="'.get_bloginfo('template_url').'/img/logo.png" alt="Registralow" style="max-width: 125px;display:inline-block;position:relative;bottom:-4px;"> !</h2>
                          <p style="font-size:16px;">
                               '.$message_content.'
                          </p>
                          <p style="font-size:16px;">
                               Conoce el estatus de tu trámite en<br>
                               <a style="font-size:16px;color:#fff!important;" href="href="'.home_url().'/mi-cuenta">www.registralow.com/mi-cuenta</a>
                          </p>
                       </td>
                       <td>
                           <img src="'.get_bloginfo('template_url').'/img/index/nosotros/h3.png" style="max-width: 420px;position:relative;bottom:-1px;">
                       </td>
                   </tr>
                   <tr style="background-color: #fff;">
                       <td colspan="2" style="margin: 0 auto;height: auto;padding: 10px 15px;">
                           <p style="color: #5a5a5a; text-align: center; font-size: 18px;">
                                Accediendo con tu cuenta de correo y constraseña este 
                               <a style="font-weight:700;font-size:18px;color:#5a5a5a!important;" href="href="'.home_url().'/mi-cuenta">link</a>
                           </p>
                       </td>
                   </tr>
                   </tbody>
               </table>
           ';
        } else {
            $message_content =
                'Nuestro equipo en estos momentos está preparando
            tu solicitud.';
            $message = '
               <style>
               @import url("https://fonts.googleapis.com/css?family=Open+Sans");
               table {
                   font-family: "Open Sans","sans-serif";
               }
               </style>
               <table style="border-collapse: collapse;margin: 0 auto;background: #fff;border-radius: 5px;width: 800px;border: 1px solid #e3e3e3;border-spacing: 0;">
                   <tbody>
                   <tr style="background-color: #dede38;margin-bottom: 5px;">
                       <td colspan="2" style="margin: 0 auto;height: auto;padding: 10px 15px;">
                           <img src="'.get_bloginfo('template_url').'/img/index/icons/r-blue.png" alt="Registralow" style="display: inline-block;width: 30px;margin-right: 15px;float: left;">
                           <a href="https://registralow.com" style="color: #1da6df;display: inline-block;line-height:30px;margin:0;text-decoration:none!important;font-size:16px;">www.registralow.com</a>
                       </td>
                   </tr>
                   <tr style="height: 5px;"></tr>
                   <tr style="background-color: #1da6df;">
                       <td style="margin: 0 auto;height: auto;padding: 15px;color: #353535;color:#fff;">
                          <h2 style="font-weight:400;font-size:22px;">¡ Gracias por confiar en <img src="'.get_bloginfo('template_url').'/img/logo.png" alt="Registralow" style="max-width: 125px;display:inline-block;position:relative;bottom:-4px;"> !</h2>
                          <p style="font-size:16px;">
                               '.$message_content.'
                          </p>
                          <p style="font-size:16px;">
                               Conoce el estatus de tu trámite en<br>
                               <a style="font-size:16px;color:#fff!important;" href="href="'.home_url().'/mi-cuenta">www.registralow.com/mi-cuenta</a>
                          </p>
                       </td>
                       <td>
                           <img src="'.get_bloginfo('template_url').'/img/index/nosotros/h3.png" style="max-width: 420px;position:relative;bottom:-1px;">
                       </td>
                   </tr>
                   <tr style="background-color: #fff;">
                       <td colspan="2" style="margin: 0 auto;height: auto;padding: 10px 15px;">
                           <p style="color: #5a5a5a; text-align: center; font-size: 18px;">
                                Accediendo con tu cuenta de correo y constraseña este 
                               <a style="font-weight:700;font-size:18px;color:#5a5a5a!important;" href="href="'.home_url().'/mi-cuenta">link</a>
                           </p>
                       </td>
                   </tr>
                   </tbody>
               </table>
           ';
        }
    }

    $to = $email;

    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

    // Additional headers
    $headers .= 'To: <' . $to . '>' . "\r\n";
    $headers .= 'From: Registralow <contacto@registralow.com>' . "\r\n";

    // message
    $subject = 'Estatus de tu solicitud';

    //  Message preview
    //return $message;

    if (wp_mail($to, $subject, $message, $headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "¡Gracias! Su mensaje ha sido envíado.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Hubo un error no pudimos mandar su mensaje.";
    }
}

add_theme_support( 'post-thumbnails' );
/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>