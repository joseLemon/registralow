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
                <h1 class="white">BIENVENIDO, <?php if( $first_name != "" ) { echo $first_name; } else { echo $username; } ?></h1>
                <div class="yellow-divider"></div>
                <a href="mi-cuenta" class="btn yellow-btn white">MIS SOLICITUDES</a>
            <?php } ?>
            <?php if( !is_user_logged_in() ) { ?>
                <img src="<?php echo bloginfo('template_directory').'/'; ?>img/index/icons/r-green.png" alt="Logo Registralow" class="box-logo">
                <h1 class="white bold">QUE NADIE SE TE ADELANTE</h1>
                <div class="yellow-divider"></div>
                <a href="registro" class="btn yellow-btn white">REGISTRAR</a>
            <?php } ?>
            <div class="green-block right"></div>
        </div>
        <a href="#nosotros" id="scrollDown"><img src="<?php echo bloginfo('template_url').'/'; ?>img/index/icons/down.png" alt="Scroll"></a>
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
    <div class="container text-center light-spacing main-title">
        <h1 class="blue header">¿Cómo funciona <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/icons/registralow.png" alt="Registralow."> ?</h1>
    </div>
    <div class="nosotros" id="nosotros">
        <div class="container">
            <div class="col-sm-4">
                <h2 class="number light-green bold">1.</h2>
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/nosotros/1.png" alt="Paso 1" class="center-block img-responsive">
                <h2 class="blue step bold text-center">Revisamos la disponibilidad de tu marca</h2>
                <div class="hover">
                    <p class="text white">
                        Revisamos la disponibilidad de tu marca.
                        <br><br>
                        Nuestro experimentado equipo de abogados
                        especialistas hace una revisión completa de la
                        disponibilidad de tu idea para garantizar que
                        inviertas correctamente tu dinero.
                    </p>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/nosotros/h1.png" alt="Búsqueda" class="img-responsive">
                </div>
            </div>

            <div class="col-sm-4">
                <h2 class="number dark-gray bold">2.</h2>
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/nosotros/2.png" alt="Paso 2" class="center-block img-responsive">
                <h2 class="white step bold text-center">Registramos tu marca</h2>
                <div class="hover">
                    <p class="text white">
                        Preparamos formalmente la solicitud de tu marca
                        para registrarla dentro de una clase y la presentamos
                        correctamente vía online llevando el proceso hasta el final.
                    </p>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/nosotros/h2.png" alt="Búsqueda" class="img-responsive">
                </div>
            </div>

            <div class="col-sm-4">
                <h2 class="number white bold">3.</h2>
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/nosotros/3.png" alt="Paso 2" class="center-block img-responsive">
                <h2 class="blue step bold text-center">Tu marca crece</h2>
                <div class="hover">
                    <p class="text dark-gray">
                        Al tener una marca registrada cuentas con la exclusividad
                        para utilizarla sólo tu, prohibiendo que otros usen algo
                        igual o similar para el mismo giro, logrando ser el único
                        reconocido bajo tu imagen, entre otros beneficios.
                    </p>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/nosotros/h3.png" alt="Búsqueda" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  CONOCIMIENTO  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="knowledge light-spacing">
        <div class="container">
            <div class="row no-margin">
                <div class="col-sm-7">
                    <iframe src="https://www.youtube.com/embed/0ibZGJjIurA" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="col-sm-5">
                    <h2 class="blue">¡ Sabemos lo que hacemos y lo hacemos bien !</h2>
                    <div class="divider decoration"></div>
                    <p class="text dark-gray">
                        Somos una red de abogados profesionales con la misión
                        de ayudar a proteger la propiedad inteluctual de cualquier
                        tipo de negocio o proyecto de una manera segura, confiable
                        y cómoda, con precios justos que comprenden las necesidades
                        de nuestros usuarios.
                        <br><br>
                        Tenemos el compromiso de ofrecerte la mejor claidad,
                        tratando a tu proyecto como si fuera nuestro, buscando
                        siempre darte un servicio profesional y además
                        ahorrandote costos.
                    </p>
                    <h2 class="blue">Síguenos en:</h2>
                    <a href="https://www.facebook.com/registralow/" target="_blank"><img src="<?php echo bloginfo('template_url').'/'; ?>img/index/icons/fb.png" alt="Facebook"></a>
                    <a href="https://www.instagram.com/registralow/" target="_blank"><img src="<?php echo bloginfo('template_url').'/'; ?>img/index/icons/inst.png" alt="Instagram"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  PRECIOSLOW  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="precioslow" id="precioslow">
        <div class="container">
            <div class="row no-margin">
                <div class="col-sm-4">
                    <div class="vertical-align">
                        <h3 class="white">¡Comienza con tu sueño hoy!</h3>
                        <div class="yellow-divider"></div>
                        <h5 class="white italic">¡Nuestros <span class="bold">Precioslow</span> son los mejores del mercado!</h5>
                    </div>
                </div>
                <div class="col-sm-4 precios text-center">
                    <h3 class="white">Búsqueda de Marca</h3>
                    <div class="yellow-divider sm-divider"></div>
                    <p class="white">
                        Revisamos si tu marca se puede registrar en México.
                    </p>
                    <h2 class="whole-price"><span class="dollar-sign white">$ </span><span class="price yellow">199</span><span class="cents yellow">.00</span></h2>
                    <div class="clearfix"></div>
                    <a href="<?php echo home_url();?>/solicitud" class="btn sm-btn yellow-btn">REVISAR</a>
                    <div class="clearfix"></div>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/precioslow/busqueda.png" alt="Búsqueda" class="img-responsive">
                </div>
                <div class="col-sm-4 precios text-center">
                    <h3 class="white">Registro de Marca</h3>
                    <div class="yellow-divider sm-divider"></div>
                    <p class="white">
                        (Precio por clase)<br>
                        Protegemos todo tu esfuerzo, originalidad y prestigio..
                    </p>
                    <h2 class="whole-price"><span class="dollar-sign white">$ </span><span class="price yellow">4,999</span><span class="cents yellow">.00</span></h2>
                    <div class="clearfix"></div>
                    <a href="<?php echo home_url();?>/solicitud" class="btn sm-btn yellow-btn">REGISTRAR</a>
                    <div class="clearfix"></div>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/precioslow/registro.png" alt="Búsqueda" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  CARACTERÍSTICAS  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="caracteristicas" id="caracteristicas">
        <div class="container">
            <div class="row no-margin">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 light-spacing">
                    <h3 class="white">Nuestra experiencia<br> nos permite dar un servicio...</h3>
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
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/decorations/experiencia.png" alt="Registralow in Hand" class="decoration">
            </div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  ALIANZAS  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="alianzas spacing" id="alianzas">
        <div class="row no-margin">
            <div class="col-sm-6 text-right title">
                <h2 class="white">ALIANZAS</h2><img src="<?php echo bloginfo('template_url').'/';?>img/index/icons/registralow-white.png" alt="Registralow">
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
<?php if($_COOKIE['firstVisit'] != false) { ?>
    <div class="video-modal modal fade" id="video-modal" role="dialog">
        <div class="modal-dialog video-modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-right">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <iframe src="https://www.youtube.com/embed/0ibZGJjIurA?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#video-modal').modal('show');

        $('#video-modal').on('hidden.bs.modal', function () {
            $(this).find('iframe').attr('src','');
        })
    </script>
<?php } ?>
<?php get_footer(); ?>