<?php

/*
  Plugin Name: Custom Registration
  Plugin URI: http://code.tutsplus.com
  Description: Forma de Registro.
  Version: 1.0
  Author: José Angel
  Author URI: http://tech4sky.com
 */

function custom_registration_function() {
    $username = '';
    $password = '';
    $email = '';

    if (isset($_POST['submit'])) {
        registration_validation(
            $_POST['username'],
            $_POST['password'],
            $_POST['email']
        );

        // sanitize user form input
        global $username, $password, $email;
        $username	= 	sanitize_user($_POST['username']);
        $password 	= 	esc_attr($_POST['password']);
        $email 		= 	sanitize_email($_POST['email']);

        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration(
            $username,
            $password,
            $email
        );
    }

    registration_form(
        $username,
        $password,
        $email
    );
}

function registration_form( $username, $password, $email ) {

    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
    <p>
         <input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '" placeholder="Nombre de Usuario">
    </p>
    <p>
        <input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '" placeholder="Contraseña">
    </p>
    <p>
        <input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '" placeholder="Correo">
    </p>
    
    <div class="row no-margin">
    
        <div class="col-sm-6 text-center">
            <div class="terms">
                <input type="checkbox" id="indexTerms" name="indexTerms"><span class="blue">Acepto términos y condiciones</span>
            </div>

            <input class="small-btn blue-btn submit-btn" type="submit" name="submit" value="Registrar"/>
        </div>
    
        <div class="col-sm-6">
        '.do_shortcode( '[oa_social_login]' ).'
        </div>
        
    </div>
    
	</form>
	';
}

function registration_validation( $username, $password, $email )  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Un campo requerido no fue llenado.');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', 'Nombre de usuario muy corto, debe ser de al menos 4 caracteres.');
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name', 'El nombre de usuario ya esta siendo utilizado.');

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', 'El usuario ingresado no es válido.');
    }

    if ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', 'La longitud de la contraseña debe ser mayor a 5 caracteres.');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'El correo no es válido.');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Este correo ya está siendo utilizado.');
    }
    
    if ( !isset($_POST['indexTerms']) ) {
        $reg_errors->add('terms', 'Debes de aceptar nuestros términos y condiciones para proceder.');
    }

    if ( is_wp_error( $reg_errors ) ) {

        if( count( $reg_errors != 0) ) {
            echo '<div class="alert alert-danger index-errors" style="margin-top: -35px" data-dismiss="alert" aria-label="Close"><span class="close-alert" aria-hidden="true">&times;</span>';
            foreach ( $reg_errors->get_error_messages() as $error ) {
                echo $error . '<br/>';
            }
            echo '</div>';
        }
    }
}

function complete_registration($username, $password, $email) {
    global $reg_errors, $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
            'user_login'	=> 	$username,
            'user_email' 	=> 	$email,
            'user_pass' 	=> 	$password
        );
        $user = wp_insert_user( $userdata );
        echo '<div class="alert alert-success">Usuario registrado existosamente<div>';   
    }
}

// Register a new shortcode: [custom_registration]
add_shortcode('custom_registration', 'custom_registration_shortcode');

// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}
