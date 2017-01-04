<?php get_header(); ?>
    <!-- ================================== -->

    <!-- ///////////  BANNER  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="inicio">
        <?php
        if(CFS()->get('add_video') == true && !is_user_logged_in() ) {
            echo CFS()->get('yt_iframe');
        }
        ?>
        <div class="container banner-box text-center transform-center-vertical">
            <div class="green-block left"></div>
            <?php if( is_user_logged_in() ) {
                $current_user = wp_get_current_user();
                $first_name = $current_user->user_firstname;
                $username = $current_user->user_login;
                ?>
                <img src="<?php echo bloginfo('template_directory').'/'; ?>img/index/icons/r-green.png" alt="Logo Registralow" class="box-logo">
                <h1 class="white">BIENVENIDO <?php if( $first_name != "" ) { echo $first_name; } else { echo $username; } ?></h1>
                <div class="yellow-divider"></div>
                <h3 class="white">¿QUÉ PROYECTO HAREMOS HOY?</h3>
            <?php } ?>
            <?php if( !is_user_logged_in() ) { ?>
                <h1 class="white bold">QUE NADIE SE TE ADELANTE</h1>
                <img src="<?php echo bloginfo('template_directory').'/'; ?>img/index/icons/r-green.png" alt="Logo Registralow" class="box-logo">
                <p class="white text">
                    Somos una red de abogados profesionales con la misión de ayudar a
                    proteger la propiedad inteluctual de cualquier tipo de negocio o
                    proyecto de una manera segura, confiable y cómoda, con precios
                    justos que comprenden las necesidades de nuestros usuarios.
                </p>
            <?php } ?>
            <div class="green-block right"></div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  INFO MODAL  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="info-modal modal fade" id="info-registro" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content transform-center-vertical">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text">
                        ¿Para que quiero estar en la RED?<br>
                        Al crear un usuario tendrás:
                    </p>
                    <ul class="text">
                        <li>Una bienvenida personalizada como la que mereces</li>
                        <li>Un panel de administración para dar seguimiento a tus trámites</li>
                        <li>Recibir promociones con precios aún más low</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  NOSOTROS  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="nosotros light-spacing" id="nosotros">
        <div class="container">
            <div id="nosotrosCarousel" class="carousel slide" data-ride="carousel" data-interval="7000">
                <div class="row no-margin">
                    <?php if( !is_user_logged_in() ) { ?>
                        <div class="col-sm-5">
                            <h2 class="white text-center">¡Comienza ahora y registra las marcas que quieras!</h2>
                            <div class="registration-form center-block">
                                <?php echo do_shortcode('[custom_registration]'); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="<?php if( !is_user_logged_in() ) { ?>col-sm-7<?php } else { ?>col-sm-12 logged<?php } ?>">
                        <h2 class="white text-center">
                            ¿Cómo funciona <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/icons/registralow.png" alt="Registralow."> ?
                        </h2>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <?php if( is_user_logged_in() ) { ?>
                                <div class="col-sm-7 pull-right">
                                    <?php } ?>
                                    <div class="row no-margin">
                                        <div class="col-md-2 col-sm-3 col-xs-3">
                                            <h2 class="number light-green bold">1.</h2>
                                        </div>
                                        <div class="col-md-10 col-sm-9 col-xs-9">
                                            <h2 class="blue step bold">Revisamos la disponibilidad<?php if( !is_user_logged_in() ) { ?><br><?php } ?> de tu marca</h2>
                                        </div>
                                    </div>
                                    <p class="text white">
                                        Somos una red de abogados profesionales con la misión
                                        de ayudar a proteger la propiedad inteluctual de
                                        cualquier tipo de negocio o proyecto de una manera
                                        segura, confiable y cómoda, con precios justos que
                                        comprenden las necesidades de nuestros usuarios.
                                    </p>
                                    <?php if( is_user_logged_in() ) { ?>
                                </div>
                                <div class="col-sm-5 pull-left">
                                    <?php } ?>
                                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/nosotros/1.png" alt="Paso 1" class="center-block img-responsive">
                                    <?php if( is_user_logged_in() ) { ?>
                                </div>
                            <?php } ?>
                            </div>

                            <div class="item">
                                <?php if( is_user_logged_in() ) { ?>
                                <div class="col-sm-7 pull-right">
                                    <?php } ?>
                                    <div class="row no-margin">
                                        <div class="col-md-2 col-sm-3 col-xs-3">
                                            <h2 class="number dark-gray bold">2.</h2>
                                        </div>
                                        <div class="col-md-10 col-sm-9 col-xs-9">
                                            <h2 class="white step bold">Registramos<?php if( !is_user_logged_in() ) { ?><br><?php } ?> tu marca</h2>
                                        </div>
                                    </div>
                                    <p class="text white">
                                        Preparamos formalmente la solicitud de tu marca
                                        para registrarla dentro de una clase y la presentamos
                                        correctamente vía online llevando el proceso hasta el final.
                                    </p>
                                    <?php if( is_user_logged_in() ) { ?>
                                </div>
                                <div class="col-sm-5 pull-left">
                                    <?php } ?>
                                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/nosotros/2.png" alt="Paso 2" class="center-block img-responsive">
                                    <?php if( is_user_logged_in() ) { ?>
                                </div>
                            <?php } ?>
                            </div>

                            <div class="item">
                                <?php if( is_user_logged_in() ) { ?>
                                <div class="col-sm-7 pull-right">
                                    <?php } ?>
                                    <div class="row no-margin">
                                        <div class="col-md-2 col-sm-3 col-xs-3">
                                            <h2 class="number white bold">3.</h2>
                                        </div>
                                        <div class="col-md-10 col-sm-9 col-xs-9">
                                            <h2 class="blue step bold">Tu marca<?php if( !is_user_logged_in() ) { ?><br><?php } ?> crece</h2>
                                        </div>
                                    </div>
                                    <p class="text dark-gray">
                                        Al tener una marca registrada cuentas con la exclusividad
                                        para utilizarla sólo tu, prohibiendo que otros usen algo
                                        igual o similar para el mismo giro, logrando ser el único
                                        reconocido bajo tu imagen, entre otros beneficios.
                                    </p>
                                    <?php if( is_user_logged_in() ) { ?>
                                </div>
                                <div class="col-sm-5 pull-left">
                                    <?php } ?>
                                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/nosotros/3.png" alt="Paso 2" class="center-block img-responsive">
                                    <?php if( is_user_logged_in() ) { ?>
                                </div>
                            <?php } ?>
                            </div>

                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#nosotrosCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#nosotrosCarousel" data-slide-to="1"></li>
                                <li data-target="#nosotrosCarousel" data-slide-to="2"></li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php if( !is_user_logged_in() ) { ?>
    <!-- ================================== -->

    <!-- ///////////  PARALLAX  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="parallax-container knowledge">
        <div class="parallax">
            <img src="<?php bloginfo('template_directory'); ?>/img/index/parallax/1.jpg" alt="Parallax Background">
        </div>
        <div class="decoration"></div>
        <div class="container">
            <div class="transform-center-vertical">
                <div class="row no-margin">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <h1 class="white header">! Sabemos lo que hacemos y lo hacemos bien !</h1>
                        <p class="white text">
                            Tenemos el compromiso de ofrecerte la mejor claidad,
                            tratando a tu proyecto como si fuera nuestro, buscando
                            siempre darte un servicio profesional y además
                            ahorrandote costos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  CARACTERÍSTICAS  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="caracteristicas light-spacing" id="caracteristicas">
        <div class="container">
            <div class="row no-margin">
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/decorations/3.png" alt="Registralow in Hand" class="decoration">
                <div class="col-sm-6">
                    <h2 class="white">Nuestra experiencia nos permite dar un servicio...</h2>
                </div>
                <div class="col-sm-6">
                    <h3 class="yellow">Eficaz</h3>
                    <p class="white text">
                        Tenemos el propósito de que el registro de tu marca se
                        lleve acabo de manera correcta, con estrategias inteligentes
                        que le permitan llegar hasta el último paso sin contratiempos.
                    </p>
                    <h3 class="yellow">Rápido</h3>
                    <p class="white text">
                        a alta capacidad de nuestros sistemas nos permite atender una
                        gran cantidad de peticiones de manera eficiente, mientras que
                        nuestros abogados con posgrado en el tema revisan personalmente
                        cada petición de manera individual, generando un registro de
                        marca efectivo.
                    </p>
                    <h3 class="yellow">Accesible</h3>
                    <p class="white text">
                        Sabemos que es posible ofrecer el mejor servicio a un precio
                        accesible, centrándonos siempre en el desarrollo de empresas,
                        la legalidad y la protección del patrimonio.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- ================================== -->

    <!-- ///////////  PARALLAX  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="parallax-container precioslow" id="precioslow">
        <div class="parallax">
            <img src="<?php bloginfo('template_directory'); ?>/img/index/parallax/2.jpg" alt="Parallax Background">
        </div>
        <div class="decoration transform-center-vertical"></div>
        <div class="container">
            <div class="text-center">
                <h2 class="white">¡Comienza con tu sueño hoy!</h2>
                <div class="yellow-divider"></div>
                <h4 class="white italic">¡Nuestros <span class="bold">Precioslow son los mejores del mercado!</span></h4>
            </div>
            <div class="row no-margin">
                <div class="col-sm-6">
                    <h3 class="white">Búsqueda <br>de marca</h3>
                    <h2 class="whole-price"><span class="dollar-sign white">$</span><span class="price yellow">199</span><span class="cents yellow">.00</span></h2>
                    <p class="white">
                        Revisamos si tu marca se puede registrar en México.
                    </p>
                    <a href="<?php echo home_url();?>/revision" class="btn sm-btn yellow-btn">REVISAR</a>
                </div>
                <div class="col-sm-6 text-right">
                    <h2 class="whole-price"><span class="dollar-sign white">$</span><span class="price yellow">4,999</span><span class="cents yellow">.00</span></h2>
                    <h3 class="white">Registro <br>de Marca</h3>
                    <div class="clearfix"></div>
                    <p class="white pull-right">
                        (Precio por clase)<br>
                        Protegemos todo tu esfuerzo, originalidad y prestigio..
                    </p>
                    <div class="clearfix"></div>
                    <a href="<?php echo home_url();?>/registro" class="btn sm-btn yellow-btn">REGISTRAR</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  ALIANZAS  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="alianzas spacing" id="alianzas">
        <div class="row no-margin">
            <div class="col-sm-6 text-right title">
                <h2 class="white">ALIANZAS</h2><img src="<?php echo bloginfo('template_url').'/';?>img/index/icons/registralow.png" alt="Registralow">
            </div>
        </div>
        <div class="row no-margin">
            <div class="col-md-4 col-sm-3"></div>
            <div class="col-md-4 col-sm-6 text-right">
                <h3 class="white bold">Si eres diseñador o...</h3>
                <p class="white text">
                    Trabajas una agencia de diseño gráfico, y deseas
                    que tus propuestas de “namming” estén validadas
                    a la hora de presentarlas a tus clientes, no dudes
                    en contactarnos para mostrarte los  planes que
                    tenemos para ti.
                </p>
                <a href="<?php echo home_url();?>/contacto" class="btn bg-btn blue-btn">CONTÁCTANOS</a>
            </div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  MODALS  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="info-modal modal fade" id="info-revision" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content transform-center-vertical">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text">
                        Nuestros abogados especialistas enfocan sus conocimientos y
                        experiencia para garantizar que hagas inversiones y
                        <a href="#info-0" data-toggle="modal" data-target="#info-0" id="call-new-modal">no gastos</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="info-modal modal fade" id="info-clase" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content transform-center-vertical">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text">
                        ¿Cómo por Clase?<br><br>

                        Las marcas se protegen de acuerdo a su giro comercial para evitar que otro competidor en México utilice alguna marca igual o
                        similar.<br><br>

                        Esto es para no generar monopolios injustos,  por ejemplo: que alguien que se dedique a vender playeras bajo el nombre de
                        “cielo azul”, no se vea impedido a registrar su marca por que ya haya alguien que tenga registrada la misma expresión “cielo azul”
                        para vender café.<br><br>

                        Para esto a nivel internacional se han clasificado los giros en <a href="<?php echo bloginfo('template_url').'/pdf/clases.pdf';?>" target="_blank">45 diversas clases</a>, y para proteger cada una necesitamos un registro.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--
<a href="<?php echo $woocommerce->cart->get_checkout_url() ?>">checkout</a>
<a href="<?php echo WC()->cart->get_cart_url();  ?>">cart</a>-->
<?php get_footer(); ?>