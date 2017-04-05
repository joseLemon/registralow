<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php include('header.php'); ?>
<div class="container not-found">
    <div class="row no-margin">
        <div class="col-md-8 col-sm-12 spacing">
            <h1 class="header blue">¡Ups! Ha ocurrido un error</h1>
            <h3 class="blue">Error 404: Página no encontrada</h3>
            <p class="text">
                Parece que ha habido un error con la página que estabas buscando.<br>
                Es posible que la entrada haya sido eliminada o que la dirección que buscas no existe.
            </p>
            <p class="text">
                Te invitamos a que visites nuestra página principal:
            </p>
            <a href="<?php echo home_url();?>" class="btn blue-btn auto-width">PÁGINA PRINCIPAL</a>
        </div>
        <div class="col-sm-4 hidden-sm hidden-xs text-left">
            <img class="flip-horizontal img-responsive" src="<?php echo bloginfo('template_url').'/' ?>img/faqs/abogado.png" alt="404">
        </div>
    </div>
</div>
<div class="footer-contacto">
    <div class="container">
        <div class="col-md-6 spacing pull-right">
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
