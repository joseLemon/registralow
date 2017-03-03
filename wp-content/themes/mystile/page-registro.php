<?php get_header(); ?>
    <div class="wrapper registro forma-registro">
        <div class="container tab-content spacing">
            <div class="indicators blue text-center row no-margin">
                <div class="col-sm-3">
                    <h4 class="blue">Pago</h4>
                    <div class="circle active"></div>
                </div>
                <div class="col-sm-3">
                    <h4 class="blue">Tus Datos</h4>
                    <div class="circle"></div>
                </div>
                <div class="col-sm-3">
                    <h4 class="blue">Tu Marca</h4>
                    <div class="circle"></div>
                </div>
                <div class="col-sm-3">
                    <h4 class="blue">Presentación</h4>
                    <div class="circle"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div name="error" id="error" class="alert alert-danger hidden"></div>
                </div>
            </div>
            <form action="<?php echo home_url().'/submitsolicitor';?>" id="solicitorForm" method="post" enctype="multipart/form-data">
                <div role="tabpanel" class="form-container tab-pane fade in active" id="registro">
                    <div class="row no-margin header-info-container">
                        <h1 class="header blue text-center normal-weight">TUS DATOS</h1>
                        <!-- INFO BUTTON -->
                        <!--<div class="info">
                            <button type="button" data-toggle="modal" data-target="#info-first">i</button>
                        </div>-->
                    </div>
                    <div class="info-modal modal fade" id="info-first" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content transform-center-vertical">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p class="text">
                                        Atención:<br>
                                        Tus datos deben ser correctos y completos, sobre todo por que el brindar
                                        datos falsos en una solicitud ante el IMPI puede ocasionar perder un
                                        registro legítimo en un futuro.<br><br>

                                        Si quieres saber como tratamos tus datos. Visita nuestra <a href="" target="_blank">política de privacidad</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $brand = $wpdb->get_results( "SELECT * FROM `brands` JOIN business_course ON brands.business_course_id = business_course.business_course_id WHERE brand_id =".$_GET['id']." limit 1" )[0]; ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="solicitor_name">Nombre(s)</label><input type="text" id="solicitor_name" name="solicitor_name" value="<?php echo $brand->name ?>">
                        </div>
                        <div class="col-sm-3">
                            <label for="last_name">Apellido Paterno</label><input type="text" id="last_name" name="last_name" value="<?php echo $brand->last_name ?>">
                        </div>
                        <div class="col-sm-3">
                            <label for="m_last_name">Apellido Materno</label><input type="text" id="m_last_name" name="m_last_name" value="<?php echo $brand->m_last_name ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="email">Email</label><input type="text" id="email" name="email" value="<?php echo $brand->email ?>">
                        </div>
                    </div>
                    <h1 class="header blue text-center normal-weight">DOMICILIO</h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="street">Calle</label><input type="text" id="street" name="street"  value="<?php echo $brand->street ?>">
                        </div>
                        <div class="col-sm-3 ">
                            <label for="exterior">Núm. Exterior</label><input type="text" id="exterior" name="exterior"  value="<?php echo $brand->ext_num ?>">
                        </div>
                        <div class="col-sm-3 ">
                            <label for="interior">Núm. Interior</label><input type="text" id="interior" name="interior"  value="<?php echo $brand->int_num ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="colony">Colonia</label><input type="text" id="colony" name="colony"  value="<?php echo $brand->colony ?>">
                        </div>
                        <div class="col-sm-3 ">
                            <label for="postal">Código Postal</label><input type="text" id="postal" name="postal"  value="<?php echo $brand->postal_code ?>">
                        </div>
                        <div class="col-sm-3 ">
                            <label for="town">Municipio</label><input type="text" id="town" name="town"  value="<?php echo $brand->town ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-3">
                            <label for="state">Estado</label>
                            <select name="state" id="state">
                                <option value="Aguascalientes">Aguascalientes</option>
                                <option value="Baja California">Baja California</option>
                                <option value="Baja California Sur">Baja California Sur</option>
                                <option value="Campeche">Campeche</option>
                                <option value="Chiapas">Chiapas</option>
                                <option value="Chihuahua">Chihuahua</option>
                                <option value="Coahuila">Coahuila</option>
                                <option value="Colima">Colima</option>
                                <option value="Distrito Federal">Distrito Federal</option>
                                <option value="Durango">Durango</option>
                                <option value="Estado de México">Estado de México</option>
                                <option value="Guanajuato">Guanajuato</option>
                                <option value="Guerrero">Guerrero</option>
                                <option value="Hidalgo">Hidalgo</option>
                                <option value="Jalisco">Jalisco</option>
                                <option value="Michoacán">Michoacán</option>
                                <option value="Morelos">Morelos</option>
                                <option value="Nayarit">Nayarit</option>
                                <option value="Nuevo León">Nuevo León</option>
                                <option value="Oaxaca">Oaxaca</option>
                                <option value="Puebla">Puebla</option>
                                <option value="Querétaro">Querétaro</option>
                                <option value="Quintana Roo">Quintana Roo</option>
                                <option value="San Luis Potosí">San Luis Potosí</option>
                                <option value="Sinaloa">Sinaloa</option>
                                <option value="Sonora">Sonora</option>
                                <option value="Tabasco">Tabasco</option>
                                <option value="Tamaulipas">Tamaulipas</option>
                                <option value="Tlaxcala">Tlaxcala</option>
                                <option value="Veracruz">Veracruz</option>
                                <option value="Yucatán">Yucatán</option>
                                <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="country">País</label>
                            <select id="country" name="country">
                                <option value="México">México</option>
                            </select>
                        </div>
                    </div>
                    <div class="nav" role="tablist">
                        <button id="validationOne" href="" onclick="validateOne()" class="white blue-btn btn center-block text-center smoothScroll" aria-controls="marca" role="tab" data-toggle="tab">SIGUIENTE</button>
                    </div>
                </div>
                <div role="tabpanel" class="form-container tab-pane fade" id="marca">
                    <div class="row no-margin header-info-container">
                        <h1 class="header blue text-left normal-weight register-header">¿QUÉ TIPO DE MARCA QUIERES REGISTRAR?</h1>
                        <div class="info">
                            <button type="button" href="#info-second" data-toggle="modal" data-target="#info-second">i</button>
                        </div>
                    </div>
                    <div class="info-modal modal fade" id="info-second" role="dialog" tabindex="-1">
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
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="options"><?php if($brand->is_product) { echo 'Producto'; } else { echo 'Servicio'; } ?></label>
                            <select name="options" id="options">
                                <option disabled>---PRODUCTOS---</option>
                                <?php $business_course = $wpdb->get_results("SELECT * FROM business_course");
                                foreach($business_course as $course){
                                    $needDescription = "";
                                    if($course->need_description == 1){
                                        $needDescription = 'class = "description"';
                                    }
                                    if( $course->is_product == 1 ) {
                                        ?>
                                        <option <?php echo $needDescription; ?> value="<?php echo $course->business_course_id; ?>" <?php if($brand->business_course_id == $course->business_course_id) { echo 'selected'; }; ?>><?php echo $course->business_course_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option disabled>---SERVICIOS---</option>
                                <?php
                                foreach($business_course as $course){
                                    $needDescription = "";
                                    if($course->need_description == 1){
                                        $needDescription = 'class = "description"';
                                    }
                                    if( $course->is_product == 0 ) {
                                        ?>
                                        <option <?php echo $needDescription; ?> value="<?php echo $course->business_course_id; ?>" <?php if($brand->business_course_id == $course->business_course_id) { echo 'selected'; }; ?>><?php echo $course->business_course_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="text">Denominación o texto de tu marca</label>
                            <textarea class="hidden" name="text" id="text" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row nav" role="tablist">
                        <div class="col-sm-6">
                            <a href="#registro" class="white blue-btn btn center-block text-center smoothScroll" aria-controls="registro" role="tab" data-toggle="tab">ANTERIOR</a>
                        </div>
                        <div class="col-sm-6">
                            <a id="validationTwo" onclick="validateTwo()" href="" class="white blue-btn btn center-block text-center smoothScroll" aria-controls="giro" role="tab" data-toggle="tab">SIGUIENTE</a>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="giro text-center form-container tab-pane fade" id="giro">
                    <div class="row no-margin header-info-container">
                        <h1 class="header blue text-left normal-weight register-header">¿QUÉ GIRO TIENE TU MARCA?</h1>
                        <div class="info">
                            <button type="button" href="#info-third" data-toggle="modal" data-target="#info-third">i</button>
                        </div>
                    </div>
                    <div class="info-modal modal fade" id="info-third" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content transform-center-vertical">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p class="text text-left">
                                        Debes detallar la lista de las cosas que quieras proteger, ya que las marcas se protegen de acuerdo a su giro comercial para evitar
                                        que otro competidor en México utilice alguna marca igual o similar.<br>
                                        Esto es para no generar monopolios injustos,  por ejemplo: que alguien que se dedique a vender playeras bajo el nombre de
                                        “cielo azul”, no se vea impedido a registrar su marca por que ya haya alguien que tenga registrada la misma expresión “cielo azul”
                                        para vender café.<br><br>

                                        Para esto a nivel internacional se han clasificado los giros en <a href="<?php echo bloginfo('template_url').'/pdf/clases.pdf';?>">45 diversas clases</a>, y para proteger cada una necesitamos un registro.<br><br>

                                        Cuando tu nos dices a lo que te dedicas de manera detallada nuestros especialistas la clasifican y la protegen en el giro legal que
                                        más te acomode.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-bottom">
                        <div class="col-xs-6">
                            <input type="radio" name="business_course" id="productos" value="Productos">
                            <label for="productos"></label>
                            <span class="blue">Productos</span>
                        </div>
                        <div class="col-xs-6">
                            <input type="radio" name="business_course" id="servicios" value="Servicios">
                            <label for="servicios"></label>
                            <span class="blue">Servicios</span>
                        </div>
                    </div>
                    <div class="row hidden" id="productSelect">
                        <div class="col-xs-6">
                            <input type="radio" id="fabrication" name="product_course" value="Fabricación">
                            <label for="fabrication"></label>
                            <span class="blue">Fabricación</span>
                        </div>
                        <div class="col-xs-6">
                            <input type="radio" id="commercialization" name="product_course" value="Comercialización">
                            <label for="commercialization"></label>
                            <span class="blue">Comercialización</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="description">Descripción detallada del giro comercial</label>
                            <textarea name="description" id="description" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row margin-bottom">
                        <p class="blue">Declaro, bajo protesta de decir verdad, que la marca se ha utilizado desde la fecha:</p>
                        <div class="row">
                            <div class="col-sm-6 term">
                                <input type="radio" name="used" id="notUsed" value="false">
                                <label for="notUsed"></label>
                                <span class="text">No se ha utilizado en el mercado aún.</span>
                            </div>
                            <div class="col-sm-6 term">
                                <input type="radio" name="used" id="used" value="true">
                                <label for="used"></label>
                                <span class="text">Si se ha utilizado.</span>
                            </div>
                        </div>
                    </div>
                    <div class="row hidden" id="usedDate">
                        <div class="info">
                            <button type="button" href="#info-usedate" data-toggle="modal" data-target="#info-usedate">i</button>
                        </div>
                        <div class="info-modal modal fade" id="info-usedate" role="dialog" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content transform-center-vertical">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text text-left">
                                            La Fecha de primer uso es el momento a partir del cual tu marca entró en
                                            el comercio de manera legal (generalmente la fecha de tu primer factura
                                            donde este impresa tu marca) o bíen si no aún no tienes fecha, se empieza
                                            a proteger con la fecha en que se presente el trámite.<br><br>

                                            ¿y por que bajo protesta de decir verdad?, recuerda que un dato falso ante
                                            la autoridad que revisa el trámite puede traer problemas futuros.<br><br>

                                            En caso de más dudas,  contáctanos.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <p class="blue">¿A partir de que fecha se ha usado?</p>
                            <input type="text" name="b_date" id="b_date">
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    <div class="row hidden" id="used-establishment">
                        <p class="blue">¿En qué establecimiento se ha usado?</p>
                        <div class="row text-left">
                            <div class="col-sm-6">
                                <label for="b_street">Calle</label><input type="text" id="b_street" name="b_street">
                            </div>
                            <div class="col-sm-3">
                                <label for="b_exterior">Número Exterior</label><input type="text" id="b_exterior" name="b_exterior">
                            </div>
                            <div class="col-sm-3">
                                <label for="b_interior">Número Interior</label><input type="text" id="b_interior" name="b_interior">
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-sm-6">
                                <label for="b_colony">Colonia</label><input type="text" id="b_colony" name="b_colony">
                            </div>
                            <div class="col-sm-3">
                                <label for="b_postal">Código Postal</label><input type="text" id="b_postal" name="b_postal">
                            </div>
                            <div class="col-sm-3">
                                <label for="b_town">Municipio</label><input type="text" id="b_town" name="b_town">
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-3">
                                <label for="b_state">Estado</label>
                                <select name="b_state" id="b_state">
                                    <option value="Aguascalientes">Aguascalientes</option>
                                    <option value="Baja California">Baja California</option>
                                    <option value="Baja California Sur">Baja California Sur</option>
                                    <option value="Campeche">Campeche</option>
                                    <option value="Chiapas">Chiapas</option>
                                    <option value="Chihuahua">Chihuahua</option>
                                    <option value="Coahuila">Coahuila</option>
                                    <option value="Colima">Colima</option>
                                    <option value="Distrito Federal">Distrito Federal</option>
                                    <option value="Durango">Durango</option>
                                    <option value="Estado de México">Estado de México</option>
                                    <option value="Guanajuato">Guanajuato</option>
                                    <option value="Guerrero">Guerrero</option>
                                    <option value="Hidalgo">Hidalgo</option>
                                    <option value="Jalisco">Jalisco</option>
                                    <option value="Michoacán">Michoacán</option>
                                    <option value="Morelos">Morelos</option>
                                    <option value="Nayarit">Nayarit</option>
                                    <option value="Nuevo León">Nuevo León</option>
                                    <option value="Oaxaca">Oaxaca</option>
                                    <option value="Puebla">Puebla</option>
                                    <option value="Querétaro">Querétaro</option>
                                    <option value="Quintana Roo">Quintana Roo</option>
                                    <option value="San Luis Potosí">San Luis Potosí</option>
                                    <option value="Sinaloa">Sinaloa</option>
                                    <option value="Sonora">Sonora</option>
                                    <option value="Tabasco">Tabasco</option>
                                    <option value="Tamaulipas">Tamaulipas</option>
                                    <option value="Tlaxcala">Tlaxcala</option>
                                    <option value="Veracruz">Veracruz</option>
                                    <option value="Yucatán">Yucatán</option>
                                    <option value="Zacatecas">Zacatecas</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="b_country">País</label>
                                <select id="b_country" name="b_country">
                                    <option value="México">México</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="brand_id" name="brand_id" value="<?php echo $_GET['id'] ?>">
                    </div>
                    <div class="nav" role="tablist">
                        <div class="col-sm-6">
                            <a href="#marca" class="white blue-btn btn center-block text-center smoothScroll" aria-controls="marca" role="tab" data-toggle="tab">ANTERIOR</a>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            $host = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                            if ( $host == home_url().'/registro/' ) {
                                ?>
                                <button class="white btn red-btn" type="submit" name="submit" id="submit">PAGAR</button>
                            <?php } else if ( $host == home_url().'/revision/' ) {  ?>
                                <button class="white btn red-btn" type="submit" name="submit_revision" id="submit_revision">PAGAR</button>
                            <?php } else if ( $host == home_url().'/cambiar-marca/' ) {  ?>
                                <button class="white btn red-btn" type="submit" name="submit_cambiar" id="submit_cambiar">PAGAR</button>
                            <?php } ?>
                        </div>
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
            <div class="text-center">
                <p class="text" style="margin-top: 30px">
                    ¿Cómo tratamos tus datos personales? Consulta:<br>
                    <a href="legal">Aviso de Privacidad</a>
                </p>
            </div>
        </div>
    </div>
    <script>
        $('a[data-toggle="tab"], button[data-toggle="tab"').on('shown.bs.tab', function (e) {
            $('.indicators .circle').removeClass('active');
            $('.indicators div[class*=col]:nth-of-type('+($('div[role=tabpanel].active').index()+1)+') .circle').addClass('active');
        });
    </script>
<?php get_footer(); ?>