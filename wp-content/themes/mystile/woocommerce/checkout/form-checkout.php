<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

echo get_query_var('order-pay'); 

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wc_print_notices();

$current_user = wp_get_current_user();
$ID = $current_user->ID;

//if( isset($_POST) ) {
//echo $ID;
//$brand_id = $wpdb->query("SELECT `brand_id` FROM `registra_wp2016`.`brands`");
//echo $brand_id[0]->brand_id;
//$array = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_author = ".$ID." AND post_date = (select MAX(post_date) FROM wp_posts WHERE post_author = ".$ID.")");
//echo 'Hola';
//print_r($array);
//}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
    echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
    return;
}

?>
<div class="container">

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

        <div class="col2-set" id="customer_details">
            <div class="col-sm-5">
                <?php do_action( 'woocommerce_checkout_billing' ); ?>
            </div>

            <div class="col-sm-7">
                <?php do_action( 'woocommerce_checkout_shipping' ); ?>


                <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>

                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </div>
        </div>

        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

        <?php endif; ?>

    </form>

    <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

</div>
