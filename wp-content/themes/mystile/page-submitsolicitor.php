<?php
if (!function_exists('http_response_code')) {
    function http_response_code($code = NULL) {

        if ($code !== NULL) {

            switch ($code) {
                case 100: $text = 'Continue'; break;
                case 101: $text = 'Switching Protocols'; break;
                case 200: $text = 'OK'; break;
                case 201: $text = 'Created'; break;
                case 202: $text = 'Accepted'; break;
                case 203: $text = 'Non-Authoritative Information'; break;
                case 204: $text = 'No Content'; break;
                case 205: $text = 'Reset Content'; break;
                case 206: $text = 'Partial Content'; break;
                case 300: $text = 'Multiple Choices'; break;
                case 301: $text = 'Moved Permanently'; break;
                case 302: $text = 'Moved Temporarily'; break;
                case 303: $text = 'See Other'; break;
                case 304: $text = 'Not Modified'; break;
                case 305: $text = 'Use Proxy'; break;
                case 400: $text = 'Bad Request'; break;
                case 401: $text = 'Unauthorized'; break;
                case 402: $text = 'Payment Required'; break;
                case 403: $text = 'Forbidden'; break;
                case 404: $text = 'Not Found'; break;
                case 405: $text = 'Method Not Allowed'; break;
                case 406: $text = 'Not Acceptable'; break;
                case 407: $text = 'Proxy Authentication Required'; break;
                case 408: $text = 'Request Time-out'; break;
                case 409: $text = 'Conflict'; break;
                case 410: $text = 'Gone'; break;
                case 411: $text = 'Length Required'; break;
                case 412: $text = 'Precondition Failed'; break;
                case 413: $text = 'Request Entity Too Large'; break;
                case 414: $text = 'Request-URI Too Large'; break;
                case 415: $text = 'Unsupported Media Type'; break;
                case 500: $text = 'Internal Server Error'; break;
                case 501: $text = 'Not Implemented'; break;
                case 502: $text = 'Bad Gateway'; break;
                case 503: $text = 'Service Unavailable'; break;
                case 504: $text = 'Gateway Time-out'; break;
                case 505: $text = 'HTTP Version not supported'; break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
            }

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

            header($protocol . ' ' . $code . ' ' . $text);

            $GLOBALS['http_response_code'] = $code;

        } else {

            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);

        }

        return $code;

    }
}

$date = date('Y-m-d',strtotime($_POST['date']));
$b_date = date('Y-m-d',strtotime($_POST['b_date']));
$current_user = wp_get_current_user();
$ID = $current_user->ID;
$brand_id = $_GET['id'];
$array = [];
foreach( $_POST as $key => $P) {
    if( empty($P) ) {
        if( $key == 'b_postal' ) {
            $array[$key] = 'NULL';
        } else {
            $array[$key] = NULL;
        }
    } else {
        $array[$key] = $_POST[$key];
    }
}

//return print_r($array);

/*echo "UPDATE `brands` SET `name` = '".$array['solicitor_name']."',`last_name` = '".$array['last_name']."',`m_last_name` = '".$array['m_last_name']."',`email` = '".$array['email']."',`street` = '".$array['street']."',`ext_num` = '".$array['exterior']."',`int_num` = '".$array['interior']."',`colony` = '".$array['colony']."',`postal_code` = '".$array['postal']."',`town` = '".$array['town']."',`state` = '".$array['state']."',`country` = '".$array['country']."',`is_registered` = 1 WHERE `brands`.`brand_id` = ".$array['brand_id'].";";

return;*/

if ( isset($_POST['submit']) ) {
    if(isset($_POST['change_flag'])) {
        uploadFile($array['brand_id']);
        $wpdb->query("UPDATE `brands` SET `name` = '".$array['solicitor_name']."',`last_name` = '".$array['last_name']."',`m_last_name` = '".$array['m_last_name']."',`email` = '".$array['email']."',`street` = '".$array['street']."',`ext_num` = '".$array['exterior']."',`int_num` = '".$array['interior']."',`colony` = '".$array['colony']."',`postal_code` = '".$array['postal']."',`town` = '".$array['town']."',`state` = '".$array['state']."',`country` = '".$array['country']."',`is_registered` = 1,`business_course_id` = '".$array['business_course']."', `others_name` = '".$array['others']."' WHERE `brands`.`brand_id` = ".$array['brand_id'].";");
    } else {
        $wpdb->query("UPDATE `brands` SET `name` = '".$array['solicitor_name']."',`last_name` = '".$array['last_name']."',`m_last_name` = '".$array['m_last_name']."',`email` = '".$array['email']."',`street` = '".$array['street']."',`ext_num` = '".$array['exterior']."',`int_num` = '".$array['interior']."',`colony` = '".$array['colony']."',`postal_code` = '".$array['postal']."',`town` = '".$array['town']."',`state` = '".$array['state']."',`country` = '".$array['country']."',`is_registered` = 1 WHERE `brands`.`brand_id` = ".$array['brand_id'].";");
    }

    $brand = $wpdb->get_results("SELECT status_id, user_id FROM brands WHERE brand_id =".$array['brand_id']." LIMIT 1");
    $user_data = get_user_by('id',$brand[0]->user_id);

    if ($brand[0]->status_id < 3) {
        $type = 'revision';
    } else {
        $type = 'register';
    }

    sendStatusUpdate($array['email'],$type,true);
} /*else if( isset($_POST['submit_revision']) ) {
    $wpdb->query("INSERT INTO `brands` (`brand_id`, `brand_type_id`, `text`, `design`, `three_dimensional`, `business_course`, `product_type`, `business_course_description`, `brand_first_use_date`, `status_id`, `first_time`, `user_id`, `street`, `ext_num`, `int_num`, `postal_code`, `colony`, `town`, `state`, `country`, `b_street`, `b_ext_num`, `b_int_num`, `b_postal_code`, `b_colony`, `b_town`, `b_state`, `b_country`, `name`, `last_name`, `m_last_name`, `birthday`, `phone`, `email`, `created_at`, `rfc`  ) VALUES (NULL, ".$array['options'].", '".$array['text']."', '".$array['design']."', '".$array['three_dimensional']."', '".$array['business_course']."', '".$array['product_course']."', '".$array['description']."', '$b_date', '0', 1, '".$ID."', '".$array['street']."', '".$array['exterior']."', '".$array['interior']."', ".$array['postal'].", '".$array['colony']."', '".$array['town']."', '".$array['state']."', '".$array['country']."', '".$array['b_street']."', '".$array['b_exterior']."', '".$array['b_interior']."', ".$array['b_postal'].", '".$array['b_colony']."', '".$array['b_town']."', '".$array['b_state']."', '".$array['b_country']."', '".$array['solicitor_name']."', '".$array['last_name']."', '".$array['m_last_name']."', '$date', '".$array['phone']."', '".$array['email']."', '".date('Y-m-d H:i:s')."', '".$array['rfc']."')");
} else if( isset($_POST['submit_cambiar']) ) {
    $wpdb->query("UPDATE `brands` SET  `text` =  '".$array['text']."', `status_id` = '0', `first_time` =  '2', `created_at` = '".date('Y-m-d H:i:s')."' WHERE  `brands`.`brand_id` =".$brand_id.";");
}*/
if( isset($_POST['validate_email'])) {

    if (email_exists($_POST['user_email']))
        echo 'false';
    else
        echo 'true';

    return;
}

if( isset($_POST['requestType']) ) {
    $first_login_notification = '';
    if(!is_user_logged_in()) {

        if (email_exists($_POST['email'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';

        $password = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 10; $i++) {
            $password .= $characters[mt_rand(0, $max)];
        }

        $userdata = array(
            'user_login' => $_POST['email'],
            'user_email' => $_POST['email'],
            'user_pass' => $password,
            'first_name' => $_POST['solicitor_name'],
            'last_name' => $_POST['last_name'] . ' ' . $_POST['m_last_name'],
        );

        $user_id = wp_insert_user( $userdata );

        sendRegisterMail($_POST['email'],$password);

        $first_login_notification = '/?notification';
    } else {
        $user_id = get_current_user_id();
    }

    if(isset($_POST['others'])) {
        $others = $_POST['others'];
    } else {
        $others = NULL;
    }

    if( $_POST['requestType'] == 'revision' ) {
        $query_report = "INSERT INTO `brands` (`business_course_id`, `status_id`, `user_id`, `name`, `last_name`, `m_last_name`, `email`, `others_name`, `from_revision`, `created_at`) VALUES ('".$_POST['business_course']."', '0', ".$user_id.", '".$_POST['solicitor_name']."', '".$_POST['last_name']."', '".$_POST['m_last_name']."', '".$_POST['email']."', '".$others."', 1, CURRENT_TIMESTAMP);";
        $wpdb->query( $query_report );

        $brand_id = $wpdb->get_var("SELECT LAST_INSERT_ID();");

        uploadFile($brand_id);

        if($first_login_notification != '') {
            wp_redirect(home_url().'/mi-cuenta'.$first_login_notification);
        } else {
            wp_redirect(home_url().'/pago/?id='.$brand_id);
        }
        return;
    }

    if( $_POST['requestType'] == 'register' ) {
        $query_report = "INSERT INTO `brands` (`business_course_id`, `status_id`, `user_id`, `name`, `last_name`, `m_last_name`, `email`, `others_name`, `created_at`) VALUES ('".$_POST['business_course']."', '3', ".$user_id.", '".$_POST['solicitor_name']."', '".$_POST['last_name']."', '".$_POST['m_last_name']."', '".$_POST['email']."', '".$others."', CURRENT_TIMESTAMP);";
        $wpdb->query( $query_report );

        $brand_id = $wpdb->get_var("SELECT LAST_INSERT_ID();");

        uploadFile($brand_id);

        if($first_login_notification != '') {
            wp_redirect(home_url().'/mi-cuenta'.$first_login_notification);
        } else {
            wp_redirect(home_url().'/pago/?id='.$brand_id);
        }
        return;
    }
}

if( isset($_POST['revision_register']) ) {
    $wpdb->query("UPDATE `brands` SET `status_id` = 3 WHERE `brands`.`brand_id` = ".$array['brand_id'].";");
    wp_redirect(home_url().'/pago/?id='.$array['brand_id']);
    return;
}

if ( isset($_POST['change_brand']) ) {
    $wpdb->query("UPDATE `brands` SET `is_changed` = 1 WHERE `brands`.`brand_id` = ".$array['brand_id'].";");
    return;
}

function uploadFile($brand_id) {
    $target_dir = dirname(__FILE__).'/uploads/'.$brand_id.'/';

    //  Create temporary directory
    if(!is_dir($target_dir) && !file_exists($target_dir)) {
        mkdir($target_dir);
    }

    if ($_FILES["brand_file"]["size"] > 25000000) {
        wp_redirect(home_url().'/solicitud/?error=1');
        return;
    }

    //  Delete files if they exist
    $files = glob($target_dir.'/*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }

    if(move_uploaded_file($_FILES["brand_file"]["tmp_name"], $target_dir . 'temp.tmp')) {
        // Resize it
        GenerateThumbnail($target_dir . 'temp.tmp',$target_dir . 'brand.png',700,394,1);
        // Delete full size
        unlink($target_dir . 'temp.tmp');
        echo 'file uploaded succesfully';
    } else {
        wp_redirect(home_url().'/solicitud/?error=2');
    }
}

if( isset($_POST['submit_cambiar']) ) {
    $target_dir = dirname(__FILE__).'/uploads/';
    $target_file = $target_dir . basename($_FILES["design"]["name"]);
    $uploadOk = 1;
    if (move_uploaded_file($_FILES["design"]["tmp_name"], $target_dir . $brand_id . '_design' . '.png')) {
        //echo "The file ". basename( $_FILES["design"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file Design.";
        unlink($target_dir . $brand_id . '_design' . '.png');
    }

    if ($_FILES["upload-file"]["size"] > 25000000) {
        $uploadOk = 0;
        echo "Lo sentimos, esa imagen tiene un peso mayor a 25Mb.";
    }

    if (move_uploaded_file($_FILES["three_dimensional"]["tmp_name"], $target_dir . $brand_id . '_three_dimensional' . '.png')) {
        //echo "The file ". basename( $_FILES["three_dimensional"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file 3D.";
        unlink($target_dir . $brand_id . '_three_dimensional' . '.png');
    }
} else {
    $brand_id = $wpdb->get_results("SELECT brand_id FROM brands WHERE user_id =".$ID." AND created_at = (select MAX(created_at) FROM brands WHERE user_id =".$ID.")");

    $target_dir = dirname(__FILE__).'/uploads/';
    $target_file = $target_dir . basename($_FILES["design"]["name"]);
    $uploadOk = 1;
    if (move_uploaded_file($_FILES["design"]["tmp_name"], $target_dir . $brand_id[0]->brand_id . '_design' . '.png')) {
        //echo "The file ". basename( $_FILES["design"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file Design.";
    }

    if ($_FILES["upload-file"]["size"] > 25000000) {
        $uploadOk = 0;
        echo "Lo sentimos, esa imagen tiene un peso mayor a 25Mb.";
    }

    if (move_uploaded_file($_FILES["three_dimensional"]["tmp_name"], $target_dir . $brand_id[0]->brand_id . '_three_dimensional' . '.png')) {
        //echo "The file ". basename( $_FILES["three_dimensional"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file 3D.";
    }
}

if (isset($_POST['update_brand'])) {
    $brand_id = $_POST['brand_id'];
    $wpdb->query("UPDATE `brands` SET  `status_id` =  '".$_POST['status']."', `comments` = '".$_POST['comments']."'  WHERE  `brands`.`brand_id` =".$brand_id.";");

    $brand = $wpdb->get_results("SELECT status_id, user_id FROM brands WHERE brand_id =".$brand_id." LIMIT 1");
    $user_data = get_user_by('id',$brand[0]->user_id);

    if ($brand[0]->status_id < 3) {
        $type = 'revision';
    } else {
        $type = 'register';
    }

    sendStatusUpdate($user_data->user_email,$type,true);

    wp_redirect(home_url().'/actualizar-solicitud/?id='.$_POST['brand_id']);
}

if ( isset($_POST['submit']) ) {
    wp_redirect(home_url().'/registro/?id='.$array['brand_id']);
    exit();
}

if ( isset($_POST['re-sendEmail'])) {
    $brand_id = $_POST['brand_id'];

    $brand = $wpdb->get_results("SELECT status_id, user_id FROM brands WHERE brand_id =".$brand_id." LIMIT 1");
    $user_data = get_user_by('id',$brand[0]->user_id);

    if ($brand[0]->status_id < 3) {
        $type = 'revision';
    } else {
        $type = 'register';
    }

    sendStatusUpdate($user_data->user_email,$type,false);

    wp_redirect(home_url().'/actualizar-solicitud/?id='.$_POST['brand_id']);
}

if ( isset($_POST['print_ticket'])) {
    $brand_id = $_POST['brand_id'];

    wp_redirect(home_url().'/print/?id='.$_POST['brand_id']);
    exit();
}

function sendRegisterMail($email,$password) {
    $to = $email;

    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

    // Additional headers
    $headers .= 'To: <' . $to . '>' . "\r\n";
    $headers .= 'From: Registralow <contacto@registralow.com>' . "\r\n";

    // message
    $subject = 'Bienvenido a Registralow';
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
                   <td colspan="2" style="margin: 0 auto;height: auto;padding: 10px 15px">
                       <img src="'.get_bloginfo('template_url').'/img/index/icons/r-white.png" alt="Registralow" style="display: inline-block;width: 30px;float:left;margin-right: 15px;">
                       <a href="https://registralow.com" style="color: #fff;display: inline-block;line-height:30px;margin:0;text-decoration:none!important;font-size:16px;">www.registralow.com</a>
                   </td>
               </tr>
               <tr style="height: 5px;"></tr>
               <tr style="background-color: #dede38;">
                   <td style="margin: 0 auto;height: auto;padding: 30px 15px 0 15px;">
                       <h2 style="color: #00a8e7;position: relative;bottom: 0;margin: 5px 0;font-weight:500;font-size:22px;">Bienvenida/o a</h2>
                        <img src="'.get_bloginfo('template_url').'/img/logo.png" alt="Registralow" style="max-width: 320px;">
                       <h2 style="color: #00a8e7;position: relative;bottom: 0;margin: 5px 0;font-weight:500;font-size:22px;">¡Agradecemos tu preferencia!</h2>
                   </td>
                   <td>
                       <img src="'.get_bloginfo('template_url').'/img/index/nosotros/h3.png" style="max-width: 420px;position:relative;bottom:-1px;">
                   </td>
               </tr>
               <tr style="background-color: #456170;">
                   <td colspan="2" style="margin: 0 auto;height: auto;padding: 15px;color: #353535;color:#fff;">
                       <p style="font-size:16px;">Accede a <a href="'.home_url().'/mi-cuenta" style="color:#fff!important;font-size:16px;">www.registralow.com/mi-cuenta</a> con tu cuenta de correo y la siguiente contraseña: <strong>'.$password.'</strong></p>
                   </td>
               </tr>
               </tbody>
           </table>
       ';

    //  Message preview
    //return $message;

    if (wp_mail($to, $subject, $message, $headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        //echo "¡Gracias! Su mensaje ha sido envíado.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        //echo "Oops! Hubo un error no pudimos mandar su mensaje.";
    }
}

?>