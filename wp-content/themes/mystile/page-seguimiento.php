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
?><?php
$brand_id = $_GET['id'];
$current_user = wp_get_current_user();
$ID = $current_user->ID;
$brand = $wpdb->get_results("SELECT *, statuses.name as status_name FROM brands JOIN business_course ON brands.business_course_id = business_course.business_course_id JOIN statuses ON brands.status_id = statuses.status_id WHERE brand_id =".$brand_id." LIMIT 1");
$brand = $brand[0];
if($brand->user_id != $ID){
    $brand = [];
}

// REDIRECTS CONTROLLER
// 1) IS PAID?
if($brand->is_paid == 0) {
    wp_redirect(home_url().'/pago/?id='.$brand_id);
    exit();
}
// 2) HAS THE REGISTRATION PROCESS BEEN FINISHED?
if($brand->is_registered == 0) {
    wp_redirect(home_url().'/registro/?id='.$brand_id);
    exit();
}

if (intval($brand->status_id) < 3) {
    $type_flag = 0;
    $type = 'BÚSQUEDA';
    $brand_img_src = get_bloginfo('template_url').'/uploads/busqueda/'.$_GET['id'].'/brand.png';
} else {
    $type = 'REGISTRO';
    $type_flag = 1;
    $brand_img_src = get_bloginfo('template_url').'/uploads/registro/'.$_GET['id'].'/brand.png';
}

$business_course = $wpdb->get_results("SELECT * FROM business_course WHERE business_course_id = ".$brand->business_course_id)[0];

$payment_status = $wpdb->get_results("SELECT post_status FROM wp_posts JOIN brands ON wp_posts.ID = brands.wp_post_id WHERE wp_posts.ID =  '".$brand->wp_post_id."'");
$payment_status = $payment_status[0];
$solicitud = get_bloginfo('template_url').'/img/seguimiento/';
$proceso = get_bloginfo('template_url').'/img/seguimiento/';
$registro = get_bloginfo('template_url').'/img/seguimiento/';

switch( $brand->status_id ) {
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
        <div class="modal fade" id="modal-seguimiento" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal fade" id="modal-seguimiento" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
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
                <div class="modal-content">
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
                <div class="modal-content">
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
            <div class="modal-content">
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
<?php include('header.php'); ?>
    <div class="wrapper registro seguimiento">
        <div class="container">
            <div class="form-container active spacing">
                <!--<div class="info">
                    <a href=""><img src="<?php echo bloginfo('template_url'); ?>/img/icons/info.png" alt=""></a>
                </div>-->

                <div class="row no-margin">
                    <div class="col-sm-7">
                        <h1 class="header blue normal-weight">ESTATUS DE SOLICITUD</h1>
                        <p class="text">Consulta el estado de tus solicitudes</p>
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="mi-cuenta" class="btn blue-btn auto-width">MIS SOLICITUDES</a>
                    </div>
                </div>

                <?php if($type_flag == 0) { ?>
                    <div class="indicators blue text-center row no-margin">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <h4 class="blue"><?php if($brand->status_id == 0) { echo 'En Proceso'; } else if($brand->status_id == 1) { echo 'Marca Registrable'; } else { echo 'Marca No Registrable'; } ?></h4>
                            <div class="circle single active <?php if($brand->status_id == 2) { echo 'failed'; } ?>"></div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="indicators blue text-center row no-margin">
                        <div class="col-sm-4">
                            <h4 class="blue">En Proceso</h4>
                            <div class="circle <?php if($brand->status_id >= 3) { echo 'active'; } ?>"></div>
                        </div>
                        <div class="col-sm-4">
                            <h4 class="blue">Presentada</h4>
                            <div class="circle <?php if($brand->status_id >= 4) { echo 'active'; } ?>"></div>
                        </div>
                        <div class="col-sm-4">
                            <h4 class="blue">Concluida</h4>
                            <div class="circle <?php if($brand->status_id >= 5) { echo 'active'; } ?>"></div>
                        </div>
                    </div>
                <?php } ?>

                <!--<div class="row text-center margin-bottom">
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
                </div>-->
                <div class="row light-spacing">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <img src="<?php echo $brand_img_src; ?>" alt="Marca" class="img-responsive center-block">
                    </div>
                    <div class="clearfix"></div>
                    <div class="slim-yellow-divider"></div>
                    <div class="col-sm-12">
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
                                <th><span><?php if($brand->is_product) { echo 'PRODUCTO'; } else { echo 'SERVICIO'; } ?></span></th>
                                <th><span class="red">ETAPA</span></th>
                            </tr>
                            </thead>
                            <tbody class="text">
                            <tr>
                                <td><?php echo $brand->brand_id; ?></td>
                                <td><?php echo $type; ?></td>
                                <td><?php echo $business_course->business_course_name; ?></td>
                                <td><?php echo $brand->status_name; ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="margin: 15px 0;"></div>
                    </div>
                    <div class="col-sm-12">
                        <span class="blue-table-header white">COMENTARIOS DE NUESTRO EQUIPO</span>
                        <textarea class="admin-comment" name="" id="" cols="30" rows="10" readonly><?php echo $brands->comments; ?></textarea>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-6 text-right">
                            <a href="solicitud" class="btn blue-btn auto-width">BUSCAR OTRA MARCA</a>
                        </div>
                        <div class="col-sm-6 text-left">
                            <a href="solictud" class="btn green-btn auto-width">REGISTRAR</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <?php if(isset($modal)){ echo $modal; } ?> -->
    </div>
    <div class="footer-contacto">
        <div class="container">
            <div class="col-sm-6 spacing pull-right">
                <h2 class="white">¿Necesitas ayuda?</h2>
                <p class="text white">
                    Consulta nuestro <span class="chat">Chat en línea</span> para
                    más información.
                </p>
            </div>
            <div class="col-sm-6 pull-left">
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/decorations/contacto.png" alt="Abogádo">
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>