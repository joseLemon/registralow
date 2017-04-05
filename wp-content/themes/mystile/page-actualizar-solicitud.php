<?php include('header.php'); ?>
<?php
/*if (!function_exists('http_response_code')) {
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
if( isset($_POST['status']) ) {
    $wpdb->query("UPDATE `brands` SET  `status_id` =  '".$_POST['status']."', `comments` = '".$_POST['comments']."'  WHERE  `brands`.`brand_id` =".$_POST['brand_id'].";");

    $ID = $_GET['id'];
    $brand = $wpdb->get_results("SELECT * FROM brands WHERE brand_id =".$ID." LIMIT 1");
    $brand = $brand[0];

    // multiple recipients
    $to  = $brand[0]->email;

    $solicitud = 'http://registralow.com/site/seguimiento/?id='.$ID;

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

    // Additional headers
    $headers .= 'To: <'.$to.'>' . "\r\n";
    $headers .= 'From: Registralow <hola@registralow.com>' . "\r\n";

    // message
    switch( $_POST['status'] ) {
        case 0:
            break;
        case 1:
            $subject = '¡Tu marca es registrable!';
            $message = '
                <table style="padding-top: 100px;padding-bottom: 100px;margin: 0 auto;background: #fff;border-radius: 5px;width: 600px; border: 1px solid #e3e3e3;">
                    <tbody>
                        <td style="margin: 0 auto;text-align: center;height: auto;display: block;padding: 5px;">
                            <h1 style="color: #00a8e7;font-family: sans-serif;position: relative;bottom: 0%;margin: 0;">¡Buenas noticias!</h1>
                        </td>
                        <td style="margin: 0 auto;text-align: center;height: auto;display: block;padding: 5px;">
                            <h2 style="color: #979797;font-family: sans-serif;margin: 0;padding-bottom: 20px;">tu marca es registrable.</h2>
                        </td>
                        <td style="margin: 0 auto;text-align: center;height: auto;display: block;padding: 5px;">
                            <a href="'.$solicitud.'" style="display: block;margin: 0 auto;height: 62px;width: 128px;border-radius: 10px;font-size: 21px;line-height: 62px;background-color: #10cc45;font-family: sans-serif;color: #fff;text-decoration: none;font-size: 18px;">Ver Solicitud</a>
                        </td>
                    </tbody>
                </table>
            ';
            break;
        case 2:
            $subject = 'Tu marca pudiera no ser registrable';
            $message = '
                <table style="padding-top: 100px;padding-bottom: 100px;padding-left:15px;padding-right:15px;margin: 0 auto;background: #fff;border-radius: 5px;width: 600px; border: 1px solid #e3e3e3;">
                    <tbody>
                        <td style="width:100%;margin: 0 auto;text-align: center;height: auto;display: block;padding: 5px;">
                            <h1 style="color:#00a8e7; font-family: sans-serif;margin-bottom:0;">Nuestros abogados consideran que<br></h1>
                            <h2 style="color:#00a8e7; font-family: sans-serif;margin-top:0;">tu marca pudiera no ser registrable.</h2>  
                        </td>
                        <td style="width:100%;margin: 0 auto;text-align: center;height: auto;display: block;padding: 5px;">
                            <h1 style="color: #979797; font-family: sans-serif;margin-bottom:0;">Te recomendamos modificar tu<br></h1>
                            <h2 style="color: #979797; font-family: sans-serif;margin-top:0;">marca y realizar, de manera gratuita, una segunda búsqueda.</h2>            
                        </td>
                        <td style="width:100%;margin: 0 auto;text-align: center;height: auto;display: block;padding: 5px;">
                            <a href="'.$solicitud.'" style="display: block;margin: 0 auto;height: 62px;width: 128px;border-radius: 10px;font-size: 21px;line-height: 62px;background-color: #10cc45;font-family: sans-serif;color: #fff;text-decoration: none;font-size: 18px;">Ver Solicitud</a>
                        </td>            
                    </tbody>
                </table>
            ';
            break;
        case 3:
	        $subject = 'Solicitud en proceso';
	        $message = '
            ';
            break;
        case 4:
	        $subject = 'En examen de la autoridad';
	        $message = '
            ';
            break;
        case 5:
	        $subject = 'En obstáculo de la autoridad';
	        $message = '
            ';
            break;
        case 6:
	        $subject = 'Denegado';
	        $message = '
            ';
            break;
        case 7:
            $subject = '¡Tu marca ha sido registrada!';
            $message = '
                <table style="padding-top: 100px;padding-bottom: 100px;padding-left:15px;padding-right:15px;margin: 0 auto;background: #fff;border-radius: 5px;width: 600px; border: 1px solid #e3e3e3;">
                    <tbody>
                        <td style="margin: 0 auto;text-align: center;height: auto;display: block;padding: 5px;">
                            <h1 style="color:#00a8e7; font-family: sans-serif;">¡Felicidades tu marca ha sido registrada!<br></h1>                
                        </td>
                        <td style="margin: 0 auto;text-align: center;height: auto;display: block;padding: 5px;">
                            <h2 style="color: #979797;font-family: sans-serif;margin: 0;padding-bottom: 20px;">En breve recibirás en tu domicilio el título original y nuestro paquete <span style="color: #10cc45;">REGISTRALOW</span>.</h2>
                        </td>
                    </tbody>
                </table>
            ';
            break;
    }


    if (wp_mail( $to, $subject, $message, $headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        //echo "¡Gracias! Su mensaje ha sido envíado.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        //echo "Oops! Hubo un error no pudimos mandar su mensaje.";
    }
}
*/
$brand_id = $_GET['id'];
$brand = $wpdb->get_results("SELECT *, brands.name as solicitor_name, statuses.name as status_name FROM brands JOIN business_course ON brands.business_course_id = business_course.business_course_id JOIN statuses ON brands.status_id = statuses.status_id WHERE brand_id =".$brand_id." LIMIT 1");

if (intval($brand[0]->status_id) < 3) {
    $type_flag = 0;
    $type = 'BÚSQUEDA';
} else {
    $type = 'REGISTRO';
    $type_flag = 1;
}

if ($brand[0]->from_revision == 1) {
    if($brand[0]->is_paid_revision == 1) {
        $paid_status = 'Pagado';
    } else {
        $paid_status = '<span class="red">No Pagado</span>';
    }
} else {
    if($brand[0]->is_paid_register == 1) {
        $paid_status = 'Pagado';
    } else {
        $paid_status = '<span class="red">No Pagado</span>';
    }
}

$brand_img_src = get_bloginfo('template_url').'/uploads/'.$_GET['id'].'/brand.png';
$file_m_time = filemtime(dirname(__FILE__).'/uploads/'.$_GET['id'].'/brand.png');
$brand_img_src = $brand_img_src.'?'.$file_m_time;

$business_course = $wpdb->get_results("SELECT business_course_name FROM business_course WHERE business_course_id = ".$brand[0]->business_course_id);

/*$solicitud = get_bloginfo('template_url').'/img/seguimiento/';
$proceso = get_bloginfo('template_url').'/img/seguimiento/';
$registro = get_bloginfo('template_url').'/img/seguimiento/';

switch( $brand[0]->status_id ) {
    case 0:
        $solicitud = $solicitud.'solicitud.png';
        $proceso = $proceso.'proceso.png';
        $registro = $registro.'registro.png';
        break;
    case 1:
        $solicitud = $solicitud.'solicitud.png';
        $proceso = $proceso.'proceso.png';
        $registro = $registro.'registro.png';
        break;
    case 2:
        $solicitud = $solicitud.'solicitud.png';
        $proceso = $proceso.'proceso.png';
        $registro = $registro.'registro.png';
        break;
    case 3:
        $solicitud = $solicitud.'solicitud-yellow.png';
        $proceso = $proceso.'proceso.png';
        $registro = $registro.'registro.png';
        break;
    case 4:
        $solicitud = $solicitud.'solicitud-green.png';
        $proceso = $proceso.'proceso-yellow.png';
        $registro = $registro.'registro.png';
        break;
    case 5:
        $solicitud = $solicitud.'solicitud-green.png';
        $proceso = $proceso.'proceso-red.png';
        $registro = $registro.'registro.png';
        break;
    case 6:
        $solicitud = $solicitud.'solicitud-green.png';
        $proceso = $proceso.'proceso-green.png';
        $registro = $registro.'registro-red.png';
        break;
    case 7:
        $solicitud = $solicitud.'solicitud-green.png';
        $proceso = $proceso.'proceso-green.png';
        $registro = $registro.'registro-green.png';
        break;
}*/
?>
    <form action="<?php echo home_url().'/submitsolicitor'; ?>" method="post">
        <input type="hidden" value="<?php echo $brand_id; ?>" name="brand_id" id="brand_id">
        <div class="wrapper registro seguimiento">
            <div class="container">
                <div class="form-container active spacing actualizar">
                    <h1 class="header blue normal-weight">SEGUIMIENTO</h1>

                    <div class="indicators blue text-center row no-margin">
                        <div class="col-sm-4">
                            <h4 class="blue">SOLICITUD</h4>
                            <div class="circle <?php if(($brand[0]->status_id < 3 && $brand[0]->status_id > 0) ||  $brand[0]->status_id >= 3) { echo 'active'; } if($brand[0]->status_id == 2) { echo ' failed'; }  ?>"></div>
                        </div>
                        <div class="col-sm-4">
                            <h4 class="blue">PROCESO</h4>
                            <div class="circle <?php if($brand[0]->status_id >= 4) { echo 'active'; } ?>"></div>
                        </div>
                        <div class="col-sm-4">
                            <h4 class="blue">REGISTRO</h4>
                            <div class="circle <?php if($brand[0]->status_id >= 5) { echo 'active'; } ?>"></div>
                        </div>
                    </div>

                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <img src="<?php echo $brand_img_src; ?>" alt="Marca" class="img-responsive center-block">
                    </div>
                    <div class="col-sm-12">
                        <div class="slim-yellow-divider"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <h3 class="blue">INFORMACIÓN DE LA SOLICITUD</h3>
                        <p>Estatus del pago: <?php echo $paid_status; ?></p>
                        <?php
                        if($brand[0]->is_changed == 1 && $brand[0]->from_revision == 1) {
                            echo '<p><span class="red">*</span> El cliente ha aceptado cambiar su marca.</p>';
                        }
                        ?>
                        <table>
                            <colgroup>
                                <col style="width: 20%">
                                <col style="width: 26.6666667%">
                                <col style="width: 26.6666667%">
                                <col style="width: 26.6666667%">
                            </colgroup>
                            <thead class="white">
                            <tr>
                                <th><span>FOLIO</span></th>
                                <th><span>SOLICITUD</span></th>
                                <th><span><?php if($brand[0]->is_product) { echo 'PRODUCTO'; } else { echo 'SERVICIO'; } ?></span></th>
                                <th><span class="red">ETAPA</span></th>
                            </tr>
                            </thead>
                            <tbody class="text">
                            <tr>
                                <td><p><?php echo $brand[0]->brand_id; ?></p></td>
                                <td><p><?php echo $type; ?></p></td>
                                <td><p>
                                        <?php
                                        if($brand[0]->others_name) {
                                            echo $brand[0]->others_name;
                                        } else {
                                            echo $business_course[0]->business_course_name;
                                        }
                                        ?>
                                    </p></td>
                                <td class="to-uppercase"><p><?php echo $brand[0]->status_name; ?></p></td>
                            </tr>
                            </tbody>
                        </table>
                        <h3 class="blue">INFORMACIÓN DEL SOLICITANTE</h3>
                        <table>
                            <thead class="white">
                            <tr>
                                <th><span>NOMBRE</span></th>
                                <th><span>EMAIL</span></th>
                            </tr>
                            </thead>
                            <tbody class="text">
                            <tr>
                                <td><p><?php echo $brand[0]->solicitor_name." ".$brand[0]->last_name." ".$brand[0]->m_last_name; ?></p></td>
                                <td><p><?php echo $brand[0]->email; ?></p></td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="margin: 10px 0;" class="center-block"></div>
                        <h3 class="blue">DOMICILIO DEL SOLICITANTE</h3>
                        <table>
                            <thead class="white">
                            <tr>
                                <th><span>CALLE</span></th>
                                <th><span>NÚM. EXTERIOR</span></th>
                                <th><span>NÚM. INTERIOR</span></th>
                                <th><span>CÓDIGO POSTAL</span></th>
                            </tr>
                            </thead>
                            <tbody class="text">
                            <tr>
                                <td><p><?php echo $brand[0]->street; ?></p></td>
                                <td><p><?php echo $brand[0]->ext_num; ?></p></td>
                                <td><p><?php echo $brand[0]->int_num; ?></p></td>
                                <td><p><?php echo $brand[0]->postal_code; ?></p></td>
                            </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead class="white">
                            <tr>
                                <th><span>COLONIA</span></th>
                                <th><span>MUNICIPIO</span></th>
                                <th><span>ESTADO</span></th>
                                <th><span>PAÍS</span></th>
                            </tr>
                            </thead>
                            <tbody class="text">
                            <tr>
                                <td><p><?php echo $brand[0]->colony; ?></p></td>
                                <td><p><?php echo $brand[0]->town; ?></p></td>
                                <td><p><?php echo $brand[0]->state; ?></p></td>
                                <td><p><?php echo $brand[0]->country; ?></p></td>
                            </tr>
                            </tbody>
                        </table>
                        <h3 class="blue">COMENTARIOS</h3>
                        <textarea style="color: #1a1a1a; font-size: 16px; font-weight: bold;" name="comments" id="comments_area" cols="30" rows="10" placeholder="Comentarios" maxlength="254"><?php echo $brand[0]->comments; ?></textarea>
                    </div>
                    <div class="row no-margin btns-container">
                        <div class="col-sm-6 text-right">
                            <select name="status" id="status" style="max-width: 300px;" class="center-block pull-right">
                                <?php $statuses = $wpdb->get_results("SELECT status_id, name FROM statuses");
                                foreach($statuses as $status){
                                    if($brand[0]->status_id<3){
                                        if($status->status_id<3){
                                            if($status->status_id==$brand[0]->status_id){?>
                                                <option value="<?php echo $status->status_id ?>" selected><?php echo $status->name ?></option>
                                            <?php   }else{ ?>
                                                <option value="<?php echo $status->status_id ?>"><?php echo $status->name ?></option>
                                            <?php   }
                                        }
                                    }else{
                                        if($status->status_id>2){
                                            if($status->status_id==$brand[0]->status_id){?>
                                                <option value="<?php echo $status->status_id ?>" selected><?php echo $status->name ?></option>
                                            <?php   }else{ ?>
                                                <option value="<?php echo $status->status_id ?>"><?php echo $status->name ?></option>
                                            <?php   }
                                        }
                                    }
                                }?>
                            </select>
                        </div>
                        <div class="clearfix hidden-lg hidden-md hidden-sm"></div>
                        <div class="col-sm-6 text-left">
                            <input style="margin: 0;" class="btn green-btn white" type="submit" name="update_brand" value="Actualizar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php include('footer.php'); ?>