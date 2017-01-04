<?php get_header(); ?>
<?php 
$ID = $_GET['id'];
$brands = $wpdb->get_results("SELECT * FROM brands WHERE brand_id =".$ID." LIMIT 1");
$update = $brands[0];
?>
<div class="wrapper registro forma-registro">
    <div class="container tab-content">
        <div name="error" id="error" class="alert alert-danger hidden"></div>
        <form action="<?php echo home_url().'/submitsolicitor/?id='.$ID;?>" id="updateForm" method="post" enctype="multipart/form-data">
            <div role="tabpanel" class="form-container spacing tab-pane fade in active" id="marca">
                <div class="info">
                    <a href="#info-second" data-toggle="modal" data-target="#info-second"><img src="<?php bloginfo('template_directory'); ?>/img/icons/info.png" alt=""></a>
                </div>
                <div class="info-modal modal fade" id="info-second" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content transform-center-vertical">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p class="text">
                                    Derivado de su apariencia, tu marca de acuerdo a tus necesidades de protección y uso puede ser objeto de protección 
                                    en distintas modalidades:<br><br>

                                    1. Solo texto – proteges la expresión de la marca independientemente del diseño, tipografía o colores utilizados en ella. 
                                    (Elígela si la vas a estar cambiando de diseño cada año).<br>

                                    2. Texto y Diseño –  Además de proteger la expresión de tu marca, protegemos los colores que uses, la tipografía y 
                                    gráficos en ella contenidos (Elígela si así como usas tu marca, la usarás por el plazo de los 10 años de su vigencia).<br>

                                    3. Tridimensional – Proteges el empaque de un producto si es distintivo y original a otros del mercado. (Por ejemplo la 
                                    botella de un reconocido refresco).<br>

                                    4. Solo diseño – proteges solo el icono o logotipo de una marca sin ningún texto.<br>

                                    5. Texto y Tridimensional – Protege la combinación del punto 1 y 3.<br>

                                    6. Tridimensional y Diseño – Protege la combinación del punto 3 y 4.<br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="header blue text-center">¿Qué tipo de marca quieres registrar?</h1>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="options">Opciones</label>
                        <select name="options" id="options">
                            <?php $brands = $wpdb->get_results("SELECT brand_type_id, name FROM brand_types");
                            foreach($brands as $brand){ ?>
                            <option value="<?php echo $brand->brand_type_id ?>"><?php echo $brand->name ?></option>
                            <?php } ?>
                        </select>
                        <label for="option"></label>
                        <label class="marca-margin" for="attach">Adjunta tu logotipo</label>
                        <input type="file" name="design" id="design_upload" class="inputfile">
                        <label for="design_upload" id="design"></label>
                        <input type="file" name="three_dimensional" id="three_dimensional_upload" class="inputfile">
                        <label for="three_dimensional_upload" id="three_dimensional"></label>
                    </div>
                    <div class="col-sm-6">
                        <label for="text">Denominación o texto de tu marca</label>
                        <input class="hidden" type="text" name="text" id="text" value="<?php echo $update->text; ?>">
                    </div>
                </div>
                <div class="row nav text-center" role="tablist">
                    <input class="white small-btn blue-btn" style="margin-top: 0!important;" type="submit" name="submit_cambiar" id="submit_cambiar" value="Pagar">
                </div>
            </div>
            <div id="info" class="dialog">
                <div class="dialog__overlay"></div>
                <div class="dialog__content">
                    <h1 class="header blue text-center">Información</h1>
                    <div><button class="action hidden" data-dialog-close>Close</button></div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php get_footer(); ?>