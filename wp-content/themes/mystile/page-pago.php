<?php get_header(); ?>
    <div class="wrapper registro pago forma-registro">
        <div class="container tab-content spacing">
            <div name="error" id="error" class="alert alert-danger hidden"></div>
            <div class="indicators blue text-center row no-margin">
                <div class="col-sm-3">
                    <h4 class="blue">Pago</h4>
                    <div class="circle <?php if(isset($_GET['success'])){ ?>active<?php } ?>"></div>
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
            <?php if(!isset($_GET['success'])) {?>
                <div class="text-center form-container">
                    <h1 class="header blue">ELIGE TU FORMA DE PAGO</h1>
                    <p class="text">
                        Por favor indícanos el medio de pago más cómodo para ti:
                    </p>
                    <h2 class="price">$4,999.00 pesos M.N.</h2>
                    <div class="row no-margin">
                        <div class="col-sm-6">
                            <p class="text">
                                Pago por transferencia bancaria
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text">
                                Pago con tarjeta de débito ó crédito
                            </p>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-6 text-right">
                            <button class="white btn blue-btn">ANTERIOR</button>
                        </div>
                        <div class="col-sm-6 text-left">
                            <button class="white btn red-btn">PAGAR</button>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="text-center form-container">
                    <h1 class="header blue">¡Gracias por confiar en Registralow!</h1>
                    <p class="text">
                        Te hemos enviado un correo para completar tu registro y validar el pago de:
                    </p>
                    <h2 class="price">$4,999.00 pesos M.N.</h2>
                    <div class="row no-margin">
                        <div class="col-sm-6 text-right">
                            <button class="white btn blue-btn auto-width">VOLVER A ENVIAR CORREO</button>
                        </div>
                        <div class="col-sm-6 text-left">
                            <button class="white btn blue-btn auto-width">IMPRIMIR COMPROBANTE</button>
                        </div>
                    </div>
                    <p class="text note">
                        SI REQUIERES FACTURA, SOLICÍTALA: <br>
                        <a href="mailto:facturacion@registralow.com">facturacion@registralow.com</a>
                    </p>
                </div>
            <?php } ?>
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
    </div>
<?php get_footer(); ?>