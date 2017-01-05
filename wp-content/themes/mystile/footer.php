<footer class="text-center">
    <div class="footer-top">
        <div class="container">
            <div class="clearfix"></div>
            <img class="pull-left img-responsive" src="<?php bloginfo('template_directory'); ?>/img/index/logo-footer.png" alt="Logo Footer">
            <div class="pull-right menu">
                <a href="<?php echo home_url(); ?>">INICIO</a>
                <a href="nosotros">¿QUIÉNES SOMOS?</a>
                <a href="blog">BLOG</a>
                <a href="contacto">CONTACTO</a>
                <a href="<?php echo home_url(); ?>/faqs">FAQS</a>
                <!--<?php if( !is_user_logged_in() ) { ?>
                    <a href="#" data-dialog="modal-login" class="trigger" id="login-modal">LOGIN</a>
                <?php } ?>-->
                <!--<a href="contacto">BOLSA DE TRABAJO</a>-->
                <!--<a href="#">LEGAL</a>-->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="footer-rights">
        <div class="container">
            <p>
                Todos los derechos reservados Registralow® <?php echo date('Y'); ?> | <a href="http://lemonthree.mx" style="text-decoration: none!important;" target="_blank">Lemon Three <img src="http://lemonthree.mx/public/footer-logo.png" alt="Lemon Three" style="margin-top: -4px;"></a>
            </p>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/parallax.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/app.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/modernizr.custom.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/dialogFx.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/classie.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/smoothscroll.js"></script>
<script>
    (function() {
        var dlgtrigger = document.querySelector( '[data-dialog]' ),
            somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog' ) ),
            dlg = new DialogFx( somedialog );

        dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

    })();
</script>
<!--<script id='fresco_script' data-frescochat='eb184234-7845-4f87-9a95-f1b764f79954'>
    var frescochat_script = document.createElement("script");
    frescochat_script.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//frescochat.blob.core.windows.net/app/v3/js/frescochat.js';
    frescochat_script.async = true;
    document.getElementsByTagName("head")[0].appendChild(frescochat_script);
</script>-->
</body>
</html>