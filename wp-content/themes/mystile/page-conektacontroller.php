<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
 */
require_once(dirname(__FILE__)."/conekta/lib/Conekta.php");

class PayConekta {

    public static $api_key = 'key_GW7ynuARokrsyxzVTkEBQg';
    public static $description = 'Pago Registralow';
    public static $currency = 'MXN';

    public static function order_gen($amount, $name, $email, $phone, $type, $token) {
        \Conekta\Conekta::setApiKey(self::$api_key);
        \Conekta\Conekta::setApiVersion("2.0.0");

        $charges = '';

        if($type == 'bank') {
            $charges =
                array(
                    array(
                        'payment_method' => array(
                            'type'     => 'spei'
                        )
                    )
                );
        } else if ($type == 'card') {
            $charges =
                array(
                    array(
                        'payment_method' => array(
                            'type'     => 'card',
                            'token_id' => $token
                        )
                    )
                );
        }

        $process_order =
            array(
                'line_items'    => array(
                    array(
                        'name'=> 'Pago Registralow',
                        'unit_price'=> $amount,
                        'quantity'=> 1,
                    )
                ),
                'shipping_lines' => array(
                    array(
                        'amount' => 0,
                        'carrier' => 'Registralow'
                    )
                ),
                'currency'    => self::$currency,
                'customer_info' => array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone
                ),
                'shipping_contact' => array(
                    'phone' => '015514540773',
                    'receiver' => 'Luis Gerardo Holguín Lerma',
                    'address' => array(
                        'street1' => 'Lázaro de Baigorri 1400 San Felipe',
                        'city' => 'Chihuahua',
                        'state' => 'Chihuahua',
                        'country' => 'MX',
                        'postal_code' => '31203',
                        'residential' => false
                    )
                ),
                'charges' => $charges
            );

        try {
            $order = \Conekta\Order::create($process_order);

            if($type == 'bank') {

                //$order = '{"order":{"livemode":false,"amount":19900,"currency":"MXN","payment_status":"pending_payment","amount_refunded":0,"customer_info":{"email":"pepe.lujan2@gmail.com","phone":"6141292579","name":"Jos\u00e9 Angel Lujan Villase\u00f1or","object":"customer_info"},"shipping_contact":{"receiver":"Luis Gerardo Holgu\u00edn Lerma","phone":"015514540773","address":{"street1":"L\u00e1zaro de Baigorri 1400 San Felipe","city":"Chihuahua","state":"Chihuahua","country":"mx","residential":false,"object":"shipping_address","postal_code":"31203"},"id":"ship_cont_2gBnPBWq9TN1otW5P","object":"shipping_contact","created_at":0},"object":"order","id":"ord_2gBnPBWq9TN1otW5Q","metadata":{},"created_at":1489715928,"updated_at":1489715928,"line_items":{"object":"list","has_more":false,"total":1,"data":{"0":{"name":"Pago Registralow","unit_price":19900,"quantity":1,"object":"line_item","id":"line_item_2gBnPBWq9TN1otW5L","parent_id":"ord_2gBnPBWq9TN1otW5Q","metadata":{},"antifraud_info":{}}}},"shipping_lines":{"object":"list","has_more":false,"total":1,"data":{"0":{"amount":0,"carrier":"Registralow","object":"shipping_line","id":"ship_lin_2gBnPBWq9TN1otW5M","parent_id":"ord_2gBnPBWq9TN1otW5Q"}}},"charges":{"object":"list","has_more":false,"total":1,"data":{"0":{"id":"58cb42d8dba34d28ad896d31","livemode":false,"created_at":1489715928,"currency":"MXN","payment_method":{"clabe":"646180111812345678","bank":"STP","receiving_account_number":"646180111812345678","receiving_account_bank":"STP","object":"bank_transfer_payment","type":"spei","expires_at":1497491928},"object":"charge","status":"pending_payment","amount":19900,"fee":928,"customer_id":"","order_id":"ord_2gBnPBWq9TN1otW5Q"}}}},"bank":"STP","clabe":"646180111812345678","monto":"$199.00"}';

                $bank_tranfer_info = [
                    'order'     => $order->charges[0]->id,
                    'bank'      => $order->charges[0]->payment_method->receiving_account_bank,
                    'clabe'     => $order->charges[0]->payment_method->receiving_account_number,
                    'amount'    => '$'.$amount / 100 . '.00'
                ];

                //  TEST DATA
                /*$bank_tranfer_info = [
                    'bank'      => 'STP',
                    'clabe'     => '646180111812345678',
                    'amount'    => '$'.$amount / 100 . '.00'
                ];*/

                //echo json_decode($order);

                return json_encode($bank_tranfer_info);
            } else {
                return true;
            }
        }
        catch (Exception $e) {
            // Catch all exceptions including validation errors.
            echo $e->getMessage();
            return false;
        }
    }
    //END OF CLASS
}

if(isset($_POST['payment_type'])) {
    $brand_id = $_POST['brand_id'];
    $brand = $wpdb->get_results("SELECT status_id, user_id FROM brands WHERE brand_id =".$brand_id." LIMIT 1");
    $user_data = get_user_by('id',$brand[0]->user_id);

    if ($brand[0]->status_id < 3) {
        $amount = 199;
        $payment_update = 'is_paid_revision';
        $type = 'revision';
    } else {
        $amount = 4999;
        $payment_update = 'is_paid_register';
        $type = 'register';
    }

    if($_POST['payment_type'] == 'card') {
        $number = $_POST['number_card'];
        $token 	= $_POST['token_id'];
        $name 	= $_POST['name_card'];
        $phone 	= $_POST['phone_card'];
        $email  = $user_data->user_email;
        $amount = (strstr($amount = $amount, '.')) ? str_replace('.', '', $amount) : $amount . '00';

        if(PayConekta::order_gen($amount, $name, $email, $phone, $type = 'card', $token) == true) {
            $wpdb->query("UPDATE `brands` SET ".$payment_update." = 1 WHERE `brands`.`brand_id` = ".$brand_id.";");

            sendStatusUpdate($user_data->user_email,$type,false);

            wp_redirect(home_url().'/pago/?id='.$brand_id);
            exit();
        }
    }

    if($_POST['payment_type'] == 'bank') {
        $name = $_POST['name_bank'];
        $phone = $_POST['phone_bank'];
        $email = $user_data->user_email;
        $amount = (strstr($amount = $amount, '.')) ? str_replace('.', '', $amount) : $amount . '00';

        $order = PayConekta::order_gen($amount, $name, $email, $phone, $type = 'bank', $token = null);

        $order_id = json_decode($order)->id;
        $wpdb->query("UPDATE `brands` SET order_id = ".$order_id." WHERE `brands`.`brand_id` = ".$brand_id.";");
        echo $order;
        return;
    }
}

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
    echo 'ajax';
}
// TESTING EMAIL
/*$brand_id = 2;
$brand = $wpdb->get_results("SELECT status_id, user_id FROM brands WHERE brand_id =".$brand_id." LIMIT 1");
$user_data = get_user_by('id',$brand[0]->user_id);

print_r($brand[0]);

if ($brand[0]->status_id < 3) {
    $amount = 199;
    $payment_update = 'is_paid_revision';
    $type = 'revision';
} else {
    $amount = 4999;
    $payment_update = 'is_paid_register';
    $type = 'register';
}

echo sendStatusUpdate($user_data->user_email,$type);
return;*/