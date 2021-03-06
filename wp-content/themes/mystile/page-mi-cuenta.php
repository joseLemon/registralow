<?php
if(!isset($_GET['notification']) && !is_user_logged_in()) {
    wp_redirect(home_url() . '/wp-login.php');
}
?>
<?php include('header.php'); ?>
<?php
$current_user = wp_get_current_user();
$ID = $current_user->ID;
$brands = $wpdb->get_results("SELECT *, statuses.name as status_name FROM brands JOIN business_course ON brands.business_course_id = business_course.business_course_id JOIN statuses ON brands.status_id = statuses.status_id  WHERE user_id = ".$ID." ORDER BY created_at DESC");
?>
    <div class="registro wrapper mi-cuenta">
        <div class="container">
            <?php if ( isset($_GET['notification']) ) { ?>
                <div class="form-container active">
                    <div class="row no-margin spacing">
                        <div class="col-sm-2 col-lg-3"></div>
                        <div class="col-sm-8 col-lg-6">
                            <h1 class="blue text-center header normal-weight">¡ Bienvenido a <img style="position: relative; left: 0; bottom: 7px;" src="<?php echo get_bloginfo('template_url'); ?>/img/index/icons/registralow.png" alt="Registralow"> !</h1>
                            <p class="text text-justify">
                                Antes de comenzar, asegurate de iniciar sesión con la
                                información que se te ha enviado a tu correo electrónico
                                que nos has proporcionado.
                            </p>
                            <p class="text">
                                Si no recibiste un correo con tus datos, obten una nueva contraseña en este <a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword">link</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } else if( empty($brands) ) { ?>
                <div class="form-container active">
                    <div class="row no-margin spacing">
                        <h1 class="blue text-center header normal-weight">NO SE HA REALIZADO NINGUNA SOLICITUD</h1>
                    </div>
                </div>
            <?php } else {  ?>
                <div class="form-container active mi-cuenta">
                    <div class="row no-margin spacing">
                        <div class="row no-margin">
                            <div class="col-sm-5">
                                <h1 class="blue header normal-weight">MIS SOLICITUDES</h1>
                                <p class="text">
                                    Consulta el estado de tus solicitudes.<br><br><br>
                                </p>
                                <p class="text">
                                    ¿Tienes un nuevo proyecto?<br>
                                    Comienza ahora.
                                </p>
                                <div class="col-sm-6 text-left">
                                    <a href="<?php echo home_url(); ?>/solicitud" class="btn blue-btn">BÚSQUEDA</a>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="<?php echo home_url(); ?>/solicitud" class="btn blue-btn">REGISTRO</a>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <img src="<?php echo bloginfo('template_url').'/'; ?>/img/index/decorations/solicitudes.png" alt="Hombre con gorra">
                            </div>
                            <div class="clearfix"></div>
                            <div class="slim-yellow-divider"></div>
                        </div>
                        <table>
                            <colgroup>
                                <col style="width: 10%;">
                                <col style="width: 30%;">
                                <col style="width: 30%;">
                                <col style="width: 10%;">
                                <col style="width: 10%;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="white">
                                    <span>FOLIO</span>
                                </th>
                                <th class="white">
                                    <span>SOLICITUD</span>
                                </th>
                                <th class="white">
                                    <span>ETAPA</span>
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($brands as $brand ) { ?>
                                <?php
                                if (intval($brand->status_id) < 3) {
                                    $type = 'BÚSQUEDA';
                                } else {
                                    $type = 'REGISTRO';
                                }
                                ?>
                                <tr>
                                    <td>
                                        <p class="text no-margin"><?php echo $brand->brand_id ?></p>
                                    </td>
                                    <td>
                                        <p class="text no-margin"><?php echo $type ?></p>
                                    </td>
                                    <td>
                                        <p class="text no-margin"><?php echo $brand->status_name ?></p>
                                    </td>
                                    <td style="background-color: transparent;">
                                        <a class="btn red-btn white text-center" href="<?php echo home_url() . '/seguimiento/?id=' . $brand->brand_id; ?>">VER</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <!--<div class="col-sm-4 text-center">
                        <div class="brand-info row no-margin">
                            <div class="row no-margin">
                                <div class="col-sm-6 logo-container">
                                    <?php if( file_exists ( dirname(__FILE__).'/uploads/' . $brand->brand_id . '_design.png' ) ) { ?>
                                        <img class="img-responsive center-block" src="<?php echo get_bloginfo('template_directory') .'/uploads/' . $brand->brand_id . '_design.png'; ?>" alt="Diseño">
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6 logo-container">
                                    <?php if( file_exists ( dirname(__FILE__).'/uploads/' . $brand->brand_id . '_three_dimensional.png' ) ) { ?>
                                        <img class="img-responsive center-block" src="<?php echo get_bloginfo('template_directory') .'/uploads/' . $brand->brand_id . '_three_dimensional.png'; ?>" alt="Tridimensional">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="company-text">
                                <h2 class="blue"><?php echo $brand->text;?></h2>
                            </div>
                            <div class="seguimiento-link center-block text-center">
                                <a class="white center-block" href="<?php echo home_url() . '/seguimiento/?id=' . $brand->brand_id; ?>">Ver Seguimiento</a>
                            </div>
                        </div>
                    </div>-->
                    </div>
                </div>
            <?php } ?>
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