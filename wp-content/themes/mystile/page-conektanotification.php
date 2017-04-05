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

$body = @file_get_contents("php://input");
$data = json_decode($body);
http_response_code(200); // Return 200 OK

/*$body_test = '{"data":{"object":{"livemode":false,"amount":19900,"currency":"MXN","payment_status":"paid","amount_refunded":0,"customer_info":{"email":"pepe.lujan2@gmail.com","phone":"6141292579","name":"José Angel Lujan Villaseñor","object":"customer_info"},"shipping_contact":{"receiver":"Luis Gerardo Holguín Lerma","phone":"015514540773","address":{"street1":"Lázaro de Baigorri 1400 San Felipe","city":"Chihuahua","state":"Chihuahua","country":"mx","residential":false,"object":"shipping_address","postal_code":"31203"},"id":"ship_cont_2gBnPBWq9TN1otW5P","object":"shipping_contact","created_at":0},"object":"order","id":"ord_2gBnPBWq9TN1otW5Q","metadata":{},"created_at":1489715928,"updated_at":1489715967,"line_items":{"object":"list","has_more":false,"total":1,"data":[{"name":"Pago Registralow","unit_price":19900,"quantity":1,"object":"line_item","id":"line_item_2gBnPBWq9TN1otW5L","parent_id":"ord_2gBnPBWq9TN1otW5Q","metadata":{},"antifraud_info":{}}]},"shipping_lines":{"object":"list","has_more":false,"total":1,"data":[{"amount":0,"carrier":"Registralow","object":"shipping_line","id":"ship_lin_2gBnPBWq9TN1otW5M","parent_id":"ord_2gBnPBWq9TN1otW5Q"}]},"charges":{"object":"list","has_more":false,"total":1,"data":[{"id":"58cb42d8dba34d28ad896d31","livemode":false,"created_at":1489715928,"currency":"MXN","payment_method":{"clabe":"646180111812345678","bank":"STP","receiving_account_number":"646180111812345678","receiving_account_bank":"STP","object":"bank_transfer_payment","type":"spei","expires_at":1497491928},"object":"charge","status":"paid","amount":19900,"paid_at":1489715967,"fee":928,"customer_id":"","order_id":"ord_2gBnPBWq9TN1otW5Q"}]}},"previous_attributes":{}},"livemode":false,"webhook_status":"pending","webhook_logs":[{"id":"webhl_2gBnPg5k7oL5x2Nvj","url":"http://registralow.com/site/conektanotification/","failed_attempts":0,"last_http_response_status":-1,"object":"webhook_log","last_attempted_at":1489715975}],"id":"58cb42ff8dacdf4ce2f504f7","object":"event","type":"order.paid","created_at":1489715967}';
$data_test = json_decode($body_test);

/*print "<pre>";
print_r(json_decode($body_test,JSON_PRETTY_PRINT));
print "</pre>";*/


/*print "<pre>";
print_r($data_test->id);
print "</pre>";

echo '<br><br>';

print "<pre>";
print_r($data_test->type);
print "</pre>";*/

if($data->type == 'order.paid') {
    $order_id = $data->id;

    $brand = $wpdb->get_results("SELECT status_id, user_id FROM brands WHERE order_id =".$order_id." LIMIT 1");

    if ($brand[0]->status_id < 3) {
        $payment_update = 'is_paid_revision';
    } else {
        $payment_update = 'is_paid_register';
    }

    $wpdb->query("UPDATE `brands` SET ".$payment_update." = ".$order_id." WHERE `brands`.`order_id` = ".$order_id.";");

}


/*if ($data->type == 'charge.paid'){
    $msg = "Tu pago ha sido comprobado.";
}*/

//echo file_put_contents('notifications.txt',$body);
?>