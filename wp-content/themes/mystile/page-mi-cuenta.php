<?php include('header.php'); ?>
<?php
$current_user = wp_get_current_user();
$ID = $current_user->ID;
$brands = $wpdb->get_results("SELECT text, design, three_dimensional, brand_id, social_reason, brands.name, last_name, brand_types.name AS brand_type_name, post_status FROM brands JOIN brand_types ON brands.brand_type_id = brand_types.brand_type_id INNER JOIN wp_posts on ID = wp_post_id WHERE user_id = ".$ID." ORDER BY created_at DESC");

$order_statuses = array(
    'wc-pending'    => ( 'Pago pendiente'),
    'wc-processing' => ( 'Procesando'),
    'wc-on-hold'    => ( 'En espera'),
    'wc-completed'  => ( 'Completado'),
    'wc-cancelled'  => ( 'Cancelado'),
    'wc-refunded'   => ( 'Reembolsado'),
    'wc-failed'     => ( 'Fallido'),
);
?>
    <div class="registro wrapper">
        <div class="container">
            <?php if( empty($brands) ) { ?>
                <div class="form-container active">
                    <div class="row no-margin spacing">
                        <h1 class="blue text-center header normal-weight">NO SE HA REALIZADO NINGUNA SOLICITUD</h1>
                    </div>
                </div>
            <?php }  ?>
            <div class="form-container active mi-cuenta">
                <div class="row no-margin spacing">
                    <h2 class="blue text-center header normal-weight">SOLICITUDES DE REGISTRO</h2>
                    <table>
                        <colgroup>
                            <col style="width: 5%;">
                            <col style="width: 40%;">
                            <col style="width: 30%;">
                            <col style="width: 25%;">
                        </colgroup>
                        <thead>
                        <tr>
                            <th></th>
                            <th>
                                <h3 class="white">Tipo de Registro</h3>
                            </th>
                            <th>
                                <h3 class="white">Nombre</h3>
                            </th>
                            <th><h3 class="white">Estado de pago</h3></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $counter = 1;
                        foreach($brands as $brand ) {
                            ?>
                            <tr>
                                <td>
                                    <p class="text no-margin"><?php echo $counter; ?></p>
                                </td>
                                <td>
                                    <p class="text no-margin"><?php echo $brand->brand_type_name ?></p>
                                </td>
                                <td>
                                    <p class="text no-margin"><?php echo $brand->name.' '.$brand->last_name ?></p>
                                </td>
                                <td>
                                    <p class="text no-margin"><?php echo $order_statuses[$brand->post_status] ?></p>
                                </td>
                                <td>
                                    <a class="btn blue-btn white text-center" href="<?php echo home_url() . '/seguimiento/?id=' . $brand->brand_id; ?>">Ver Seguimiento</a>
                                </td>
                            </tr>
                            <?php
                            $counter++;
                        }
                        ?>
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
        </div>
    </div>
<?php include('footer.php'); ?>