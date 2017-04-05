<?php
/*
Plugin Name: Login Form
Plugin URI: http://lemonthree.mx
Description: Login form to grant access to registralow's full site and functions.
Version: 1.1
Author: José Angel Lujan
Author URI: http://lemonthree.mx
*/

function registralow_form() {

?>
<div class="login-form">
    <div class="row no-margin">
        <div class="">
            <h1 class="blue text-center">Login</h1>
            <?php if( $_GET['failed'] == 1 ) { ?>
            <div class="alert alert-danger">El usuario o contraseña no son correctos.</div>
            <?php } ?>
            <?php wp_login_form(); ?>
            <div class="clearfix"></div>
            <?php echo do_shortcode( '[oa_social_login]' ) ?>
        </div>
    </div>
    <div class="center-block">
        <a href="<?php echo home_url().'/wp-login.php?action=lostpassword'; ?> ">¿Olvidaste tu contraseña?</a>
    </div>
</div>
<?php   }

function registralow_auth( $username, $password ) {
    global $user;
    $creds = array();
    $creds['user_login'] = $username;
    $creds['user_password'] =  $password;
    $creds['remember'] = true;
    $user = wp_signon( $creds, false );
    if ( is_wp_error($user) ) {
        echo $user->get_error_message();
    }
    if ( !is_wp_error($user) ) {
        wp_redirect(home_url('wp-admin'));
    }
}

function registralow_process() {
    if (isset($_POST['registralow_submit'])) {
        registralow_auth($_POST['login_name'], $_POST['login_password']);
    }

    registralow_form();
}

function add_style() {
    wp_enqueue_style('bootstrap-min-css', get_template_directory_uri().'/css/bootstrap.min.css' );
    wp_enqueue_style('style', get_template_directory_uri().'style.css' );
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js' );
}

function registralow_shortcode() {
    ob_start();
    registralow_process();
    return ob_get_clean();
}

add_shortcode('registralow_login_form', 'registralow_shortcode');