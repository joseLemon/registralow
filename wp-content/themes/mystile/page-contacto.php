<?php include('header.php'); ?>
<div class="contacto">
    <div class="container spacing">
        <div class="col-sm-5">
        </div>
        <div class="col-sm-7 contact-form">
            <div class="vertical-yellow-divider"></div>
            <h2 class="blue">¡Hola!</h2>
            <p>
                ¡Nos encantaría saber de tí!
            </p>
            <p>
                Contáctanos
            </p>
            <div class="row no-margin">
                <h5 class="blue">Dirección:</h5>
                <div class="col-sm-6 no-padding-left right">
                    <p>
                        Lázaro de Baigorri 1400
                        San Felipe
                    </p>
                    <p>
                        Chihuahua, Chih., México.
                    </p>
                </div>
                <div class="col-sm-6 no-padding-right left">
                    <a href="mailto:hola@registralow.com">hola@registralow.com</a>
                </div>
            </div>
            <?php echo do_shortcode('[contact-form-7 id="33" title="Forma de Contacto"]'); ?>
        </div>
        <img src="<?php echo bloginfo('template_url').'/'; ?>img/index/decorations/contact.png" alt="" class="decoration">
    </div>
    <section class="canvas">
        <iframe class="map scrolloff" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d875.3868462303919!2d-106.09491826621888!3d28.64332444585363!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86ea433a2f1b29d9%3A0x67cac92b871db4b0!2sRegistralow!5e0!3m2!1ses-419!2smx!4v1451792731863" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>
</div>
<?php include('footer.php'); ?>