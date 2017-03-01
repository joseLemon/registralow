<?php

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

if ( isset($_POST['submit']) ) {
    $wpdb->query("UPDATE `brands` SET `name` = '".$array['solicitor_name']."',`last_name` = '".$array['last_name']."',`m_last_name` = '".$array['m_last_name']."',`email` = '".$array['email']."',`street` = '".$array['street']."',`ext_num` = '".$array['exterior']."',`int_num` = '".$array['interior']."',`colony` = '".$array['colony']."',`postal_code` = '".$array['postal']."',`town` = '".$array['town']."',`postal_code` = '".$array['town']."',`state` = '".$array['state']."',`country` = '".$array['country']."',`business_course_id` = '".$array['bussiness_course']."',`business_course_id` = '".$array['bussiness_course']."' WHERE `brands`.`brand_id` = ".$array['brand_id'].";");
} else if( isset($_POST['submit_revision']) ) {
    $wpdb->query("INSERT INTO `brands` (`brand_id`, `brand_type_id`, `text`, `design`, `three_dimensional`, `business_course`, `product_type`, `bussiness_course_description`, `brand_first_use_date`, `status_id`, `first_time`, `user_id`, `street`, `ext_num`, `int_num`, `postal_code`, `colony`, `town`, `state`, `country`, `b_street`, `b_ext_num`, `b_int_num`, `b_postal_code`, `b_colony`, `b_town`, `b_state`, `b_country`, `name`, `last_name`, `m_last_name`, `birthday`, `phone`, `email`, `created_at`, `rfc`  ) VALUES (NULL, ".$array['options'].", '".$array['text']."', '".$array['design']."', '".$array['three_dimensional']."', '".$array['business_course']."', '".$array['product_course']."', '".$array['description']."', '$b_date', '0', 1, '".$ID."', '".$array['street']."', '".$array['exterior']."', '".$array['interior']."', ".$array['postal'].", '".$array['colony']."', '".$array['town']."', '".$array['state']."', '".$array['country']."', '".$array['b_street']."', '".$array['b_exterior']."', '".$array['b_interior']."', ".$array['b_postal'].", '".$array['b_colony']."', '".$array['b_town']."', '".$array['b_state']."', '".$array['b_country']."', '".$array['solicitor_name']."', '".$array['last_name']."', '".$array['m_last_name']."', '$date', '".$array['phone']."', '".$array['email']."', '".date('Y-m-d H:i:s')."', '".$array['rfc']."')");
} else if( isset($_POST['submit_cambiar']) ) {
    $wpdb->query("UPDATE `brands` SET  `text` =  '".$array['text']."', `status_id` = '0', `first_time` =  '2', `created_at` = '".date('Y-m-d H:i:s')."' WHERE  `brands`.`brand_id` =".$brand_id.";");
}

if( isset($_POST['requestType']) ) {

    if( $_POST['requestType'] == 'revision' ) {//user_id harcodeado
        $query_report = "INSERT INTO `brands` (`business_course_id`, `status_id`, `user_id`, `name`, `last_name`, `m_last_name`, `email`, `paid`, `created_at`) VALUES ('".$_POST['bussiness_course']."', '0', '1', '".$_POST['solicitor_name']."', '".$_POST['last_name']."', '".$_POST['m_last_name']."', '".$_POST['email']."', '0', CURRENT_TIMESTAMP);";
        $wpdb->query( $query_report );
        echo 'revision';
        return true;
    }

    if( $_POST['requestType'] == 'register' ) {
        $query_report = "INSERT INTO `brands` (`business_course_id`, `status_id`, `user_id`, `name`, `last_name`, `m_last_name`, `email`, `paid`, `created_at`) VALUES ('".$_POST['bussiness_course']."', '3', '1', '".$_POST['solicitor_name']."', '".$_POST['last_name']."', '".$_POST['m_last_name']."', '".$_POST['email']."', '0', CURRENT_TIMESTAMP);";
        $wpdb->query( $query_report );
        echo 'registro';
    }

    print_r($_POST);
    return;
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

$woocommerce->cart->empty_cart();

if ( isset($_POST['submit']) ) {
    $woocommerce->cart->add_to_cart( 67, $quantity=1 );
} else if( isset($_POST['submit_revision']) ) {
    $woocommerce->cart->add_to_cart( 79, $quantity=1 );
} else if( isset($_POST['submit_cambiar']) ) {
    wp_redirect(home_url().'/mi-cuenta');
    exit();
}

wp_redirect($woocommerce->cart->get_checkout_url());
?>