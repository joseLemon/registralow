<?php
if(isset($_POST['register'])) {
    $brand_id = $_GET['id'];
    $wpdb->query("UPDATE `brands` SET  `status_id` = '3', `created_at` = '".date('Y-m-d H:i:s')."' WHERE  `brands`.`brand_id` =".$brand_id.";");
    $woocommerce->cart->empty_cart();
    $woocommerce->cart->add_to_cart( 67, $quantity=1 );
    wp_redirect($woocommerce->cart->get_checkout_url());
}
if(isset($_POST['revision'])) {
    $brand_id = $_GET['id'];
    $woocommerce->cart->empty_cart();
    $wpdb->query("UPDATE `brands` SET `created_at` = '".date('Y-m-d H:i:s')."' WHERE  `brands`.`brand_id` =".$brand_id.";");
    $woocommerce->cart->add_to_cart( 79, $quantity=1 );
    wp_redirect($woocommerce->cart->get_checkout_url());
}
?>
<?php include('header.php'); ?>
<?php
$brand_id = $_GET['id'];
$current_user = wp_get_current_user();
$ID = $current_user->ID;
$brands = $wpdb->get_results("SELECT *, brand_types.name as brand_type_name FROM brands JOIN brand_types ON brand_types.brand_type_id = brands.brand_type_id WHERE brand_id =".$brand_id." LIMIT 1");
$brands = $brands[0];
if($brands->user_id != $ID){
    $brands = [];
}
$payment_status = $wpdb->get_results("SELECT post_status FROM wp_posts JOIN brands ON wp_posts.ID = brands.wp_post_id WHERE wp_posts.ID =  '".$brands->wp_post_id."'");
$payment_status = $payment_status[0];
$solicitud = get_bloginfo('template_url').'/img/seguimiento/';
$proceso = get_bloginfo('template_url').'/img/seguimiento/';
$registro = get_bloginfo('template_url').'/img/seguimiento/';

switch( $brands->status_id ) {
    case 0:
        $solicitud = $solicitud.'solicitud.png';
        $proceso = $proceso.'proceso.png';
        $registro = $registro.'registro.png';
        $name_id = 'revision';
        break;
    case 1:
        $solicitud = $solicitud.'solicitud.png';
        $proceso = $proceso.'proceso.png';
        $registro = $registro.'registro.png';
        $modal = '
        <!--<div class="modal fade" id="modal-seguimiento" role="dialog" data-backdrop="static" data-keyboard="false">-->
        <div class="modal fade" id="modal-seguimiento" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content transform-center-vertical">
                    <div class="form-container active light-spacing">
                        <h1 class="header header-blue-gray text-center">¡Buenas noticias!<br>tu marca es registrable.</h1>
                        <form action="'.get_permalink().'?id='.$brand_id.'" method="post">
                            <input type="submit" class="white small-btn green-btn center-block text-center" name="register" id="register" value="Registrar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        ';
        $name_id = 'revision';
        break;
    case 2:
        $solicitud = $solicitud.'solicitud.png';
        $proceso = $proceso.'proceso.png';
        $registro = $registro.'registro.png';
        $name_id = 'revision';
        $modal = '
        <div class="modal fade" id="modal-seguimiento" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content transform-center-vertical">
                    <div class="form-container active">
                        <h1 class="header header-blue-gray blue text-center">Nuestros abogados consideran que tu marca pudiera no ser registrable.</h1>
                        <h1 class="header header-gray-firstbig text-center">Te recomendamos modificar tu marca y realizar, de manera gratuita, una segunda búsqueda.</h1>            
                        <div class="row">
                            <div class="col-sm-6 margin-bottom">
                                <form action="'.get_permalink().'?id='.$brand_id.'" method="post">
                                    <input style="margin: 0 auto; width: auto!important;" type="submit" class="white blue-btn center-block text-center" name="register" id="register" value="Solicitar Registro">
                                </form>
                            </div>
                            <div class="col-sm-6 margin-bottom">
                                <a href="'.home_url().'/cambiar-marca/?id='.$brand_id.'" class="white btn green-btn center-block">Cambiar mi marca</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
        break;
    case 3:
        $solicitud = $solicitud.'solicitud-yellow.png';
        $proceso = $proceso.'proceso.png';
        $registro = $registro.'registro.png';
        $name_id = 'registro';
        break;
    case 4:
        $solicitud = $solicitud.'solicitud-green.png';
        $proceso = $proceso.'proceso-yellow.png';
        $registro = $registro.'registro.png';
        $name_id = 'registro';
        break;
    case 5:
        $solicitud = $solicitud.'solicitud-green.png';
        $proceso = $proceso.'proceso-red.png';
        $registro = $registro.'registro.png';
        $name_id = 'registro';
        break;
    case 6:
        $solicitud = $solicitud.'solicitud-green.png';
        $proceso = $proceso.'proceso-green.png';
        $registro = $registro.'registro-red.png';
        $name_id = 'registro';
        break;
    case 7:
        $solicitud = $solicitud.'solicitud-green.png';
        $proceso = $proceso.'proceso-green.png';
        $registro = $registro.'registro-green.png';
        $name_id = 'registro';
        $modal = '
        <div class="modal fade" id="modal-seguimiento" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content transform-center-vertical">
                    <div class="form-container active">
                        <h1 class="header header-blue-gray text-center">¡Felicidades tu marca ha sido registrada!<br></h1><h1 class="header small-header gray text-center">En breve recibirás en tu domicilio el título original y nuestro paquete <span class="green">REGISTRALOW</span>.</h1>
                    </div>
                </div>
            </div>
        </div>
        ';
        break;
}

if($payment_status->post_status == 'wc-cancelled' || $payment_status->post_status == 'wc-pending') {
    $modal = '
    <div class="modal fade" id="modal-seguimiento" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content transform-center-vertical">
                <div class="form-container active light-spacing">
                    <h1 class="header header-blue-gray text-center">Aún no has finalizado tu pago.</h1>
                    <form action="'.get_permalink().'?id='.$brand_id.'" method="post">
                        <input type="submit" class="white small-btn green-btn center-block text-center" name="'.$name_id.'" id="'.$name_id.'" value="Pagar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    ';
}
?>
    <div class="wrapper registro seguimiento">
        <div class="container">
            <div class="form-container active spacing">
                <!--<div class="info">
                    <a href=""><img src="<?php echo bloginfo('template_url'); ?>/img/icons/info.png" alt=""></a>
                </div>-->
                <h1 class="header blue text-center normal-weight">SEGUIMIENTO</h1>
                <div class="row text-center margin-bottom">
                    <div class="col-sm-4 margin-top">
                        <p class="gray text-center">Solicitud</p>
                        <input type="text" class="hidden" value="">

                        <img src="<?php echo $solicitud; ?>" alt="Solicitud">
                        <hr class="right">
                    </div>
                    <div class="col-sm-4 margin-top">
                        <p class="gray text-center">Proceso</p>
                        <img src="<?php echo $proceso; ?>" alt="Proceso">
                    </div>
                    <div class="col-sm-4 margin-top">
                        <p class="gray text-center">Registro</p>
                        <img src="<?php echo $registro; ?>"  alt="Registro">
                        <hr class="left">
                    </div>
                </div>
                <div class="row light-spacing">
                    <div class="row no-margin brand-container">
                        <?php
                        echo '
                        <h3 class="blue text-center to-uppercase">
                            REGISTRO DE TIPO: '.$brands->brand_type_name.'
                        </h3>
                        ';
                        switch($brands->brand_type_id) {
                            //  SOLO TEXTO
                            case 1:
                                echo '
                                <h4 class="gray text-center">
                                '.$brands->text.'
                                </h4>
                                ';
                                break;
                            //  TEXTO Y DISEÑO
                            case 2:
                                echo '
                                <div class="col-sm-6">
                                    <h4 class="gray text-center">
                                        '.$brands->text.'
                                    </h4>
                                </div>
                                <div class="col-sm-6 img-container">
                                    <img class="center-block" src="'.get_bloginfo('template_directory') .'/uploads/' . $brands->brand_id . '_design.png'.'" alt="Diseño">
                                </div>
                                ';
                                break;
                            //  TRIDIMENSIONAL
                            case 3:
                                echo '
                                <div class="img-container">
                                    <img class="center-block" src="'.get_bloginfo('template_directory') .'/uploads/' . $brands->brand_id . '_three_dimensional.png'.'" alt="Tridimensional">
                                </div>
                                ';
                                break;
                            //  TEXTO Y TRIDIMENSIONAL
                            case 4:
                                echo '
                                <div class="col-sm-6">
                                    <h4 class="gray text-center">
                                        '.$brands->text.'
                                    </h4>
                                </div>
                                <div class="col-sm-6 img-container">
                                    <img class="center-block" src="'.get_bloginfo('template_directory') .'/uploads/' . $brands->brand_id . '_three_dimensional.png'.'" alt="Tridimensional">
                                </div>
                                ';
                                break;
                            //  TRIDIMENSIONAL Y DISEÑO
                            case 5:
                                echo '
                                <div class="col-sm-6 img-container">
                                    <img class="center-block" src="'.get_bloginfo('template_directory') .'/uploads/' . $brands->brand_id . '_three_dimensional.png'.'" alt="Tridimensional">
                                </div>
                                <div class="col-sm-6 img-container">
                                    <img class="center-block" src="'.get_bloginfo('template_directory') .'/uploads/' . $brands->brand_id . '_design.png'.'" alt="Diseño">
                                </div>
                                ';
                                break;
                        }
                        ?>
                    </div>
                    <h3 class="blue text-center">INFORMACIÓN DEL SOLICITANTE</h3>
                    <table>
                        <thead class="white">
                        <tr>
                            <th>Nombre</th>
                            <!--<th>Razón Social</th>-->
                            <th>Fecha de Nacimiento</th>
                            <th>Teléfono</th>
                            <th>Correo Electrónico</th>
                        </tr>
                        </thead>
                        <tbody class="text">
                        <tr>
                            <td><?php echo $brands->name." ".$brands->last_name." ".$brands->m_last_name; ?></td>
                            <!--<td><?php //echo $brands->social_reason; ?></td>-->
                            <td><?php echo $brands->birthday; ?></td>
                            <td><?php echo $brands->phone; ?></td>
                            <td><?php echo $brands->email; ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <div style="margin: 10px 0;" class="center-block"></div>
                    <h3 class="blue text-center">DOMICILIO DEL SOLICITANTE</h3>
                    <table>
                        <thead class="white">
                        <tr>
                            <th>Calle</th>
                            <th>Número Exterior</th>
                            <th>Número Interior</th>
                            <th>Código Postal</th>
                        </tr>
                        </thead>
                        <tbody class="text">
                        <tr>
                            <td><?php echo $brands->street; ?></td>
                            <td><?php echo $brands->ext_num; ?></td>
                            <td><?php echo $brands->int_num; ?></td>
                            <td><?php echo $brands->postal_code; ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <table>
                        <thead class="white">
                        <tr>
                            <th>Colonia</th>
                            <th>Municipio</th>
                            <!--<th>Localidad</th>-->
                            <th>Estado</th>
                            <th>País</th>
                        </tr>
                        </thead>
                        <tbody class="text">
                        <tr>
                            <td><?php echo $brands->colony; ?></td>
                            <td><?php echo $brands->town; ?></td>
                            <!--<td><?php //echo $brands->locality; ?></td>-->
                            <td><?php echo $brands->state; ?></td>
                            <td><?php echo $brands->country; ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <h3 class="blue text-center">GIRO COMERCIAL</h3>
                    <p class="text"><span class="blue">Tipo: </span><?php echo $brands->business_course; ?></p>
                    <?php if( $brands->bussiness_course == 'Productos' ) { ?>
                        <p class="text"><span class="blue">Tipo de Producto: </span><?php echo $brands->product_type; ?></p>
                    <?php } ?>
                    <?php if( !$brands->brand_first_use_date == NULL ) { ?>
                        <p class="text">
                            <span class="blue">Usado desde:</span>
                            <?php echo $brands->brand_first_use_date; ?>
                        </p>
                    <?php } ?>
                    <p class="text text-justify">
                        <?php echo $brands->bussiness_course_description; ?>
                    </p>
                    <?php if( !$brands->brand_first_use_date == NULL ) { ?>
                        <h3 class="blue text-center">ESTABLECIMIENTO</h3>
                        <table>
                            <thead class="white">
                            <tr>
                                <th>Colonia</th>
                                <th>Municipio</th>
                                <!--<th>Localidad</th>-->
                                <th>Estado</th>
                                <th>País</th>
                            </tr>
                            </thead>
                            <tbody class="text">
                            <tr>
                                <td><?php echo $brands->b_colony; ?></td>
                                <td><?php echo $brands->b_town; ?></td>
                                <!--<td><?php echo $brands->b_locality; ?></td>-->
                                <td><?php echo $brands->b_state; ?></td>
                                <td><?php echo $brands->b_country; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                    <h3 class="blue text-center">COMENTARIOS</h3>
                    <textarea name="" id="" cols="30" rows="10" readonly><?php echo $brands->comments; ?></textarea>
                </div>
            </div>
        </div>
        <?php if(isset($modal)){ echo $modal; } ?>
    </div>
<?php include('footer.php'); ?>