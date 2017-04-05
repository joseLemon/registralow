<?php
$brand_id = $_GET['id'];
$current_user = wp_get_current_user();
$ID = $current_user->ID;
$brand = $wpdb->get_results("SELECT *, statuses.name as status_name FROM brands JOIN business_course ON brands.business_course_id = business_course.business_course_id JOIN statuses ON brands.status_id = statuses.status_id WHERE brand_id =".$brand_id." LIMIT 1");
$brand = $brand[0];

if($brand->user_id != $ID){
    wp_redirect(home_url());
}

// REDIRECTS CONTROLLER
// HAS THE REGISTRATION PROCESS BEEN FINISHED?
if($brand->is_registered == 0) {
    wp_redirect(home_url().'/registro/?id='.$brand_id);
    exit();
}

if (intval($brand->status_id) < 3) {
    // IS REVISION PAID?
    if($brand->is_paid_revision == 0) {
        wp_redirect(home_url().'/pago/?id='.$brand_id);
        exit();
    }

    $type_flag = 0;
    $type = 'BÚSQUEDA';
} else {
    // IS REGISTRATION PAID?
    if($brand->is_paid_register == 0) {
        wp_redirect(home_url().'/pago/?id='.$brand_id);
        exit();
    }

    $type = 'REGISTRO';
    $type_flag = 1;
}

$brand_img_src = get_bloginfo('template_url').'/uploads/'.$_GET['id'].'/brand.png';
$file_m_time = filemtime(dirname(__FILE__).'/uploads/'.$_GET['id'].'/brand.png');
$brand_img_src = $brand_img_src.'?'.$file_m_time;

$business_course = $wpdb->get_results("SELECT business_course_name FROM business_course WHERE business_course_id = ".$brand->business_course_id);
?>
<?php include('header.php'); ?>
    <div class="wrapper registro seguimiento">
        <div class="container">
            <div class="form-container active spacing">
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
                            <div class="circle single <?php if($brand->status_id == 1 || $brand->status_id == 2) { echo 'active'; } ?> <?php if($brand->status_id == 2) { echo 'failed'; } ?>"></div>
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
                                <td>
                                    <?php
                                    if($brand->others_name != null) {
                                        echo $brand->others_name;
                                    } else {
                                        echo $business_course[0]->business_course_name;
                                    }
                                    ?>
                                </td>
                                <td class="to-uppercase"><?php echo $brand->status_name; ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="margin: 15px 0;"></div>
                    </div>
                    <div class="col-sm-12">
                        <span class="blue-table-header white">COMENTARIOS DE NUESTRO EQUIPO</span>
                        <textarea class="admin-comment" name="" id="" cols="30" rows="10" readonly><?php echo $brands->comments; ?></textarea>
                    </div>
                    <?php if($brand->status_id == 1) { ?>
                        <div class="row no-margin">
                            <div class="col-sm-12 text-center">
                                <form action="<?php echo home_url().'/submitsolicitor';?>" method="post">
                                    <input type="hidden" value="<?php echo $brand_id; ?>" name="brand_id">
                                    <button type="submit" class="btn green-btn" name="revision_register">REGISTRAR MI MARCA</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
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