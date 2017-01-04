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




/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>