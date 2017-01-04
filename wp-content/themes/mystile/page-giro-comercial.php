<?php include('header.php'); ?>
<div class="wrapper registro giro">
    <div class="container">
        <div class="form-container spacing text-center">
           <div class="info">
                 <a href=""><img src="<?php bloginfo('template_directory'); ?>/img/icons/info.png" alt=""></a>
            </div>
            <ul>
                <li class="active"></li>
                <li></li>
                <li></li>
            </ul>
            <h1 class="header blue">Giro Comercial</h1>
            <div class="row margin-bottom">
                <div class="col-xs-6">
                    <input type="checkbox"><span class="blue">Productos</span>
                </div>
                <div class="col-xs-6">
                    <input type="checkbox"><span class="blue">Servicios</span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <label for="fabrication">Fabricación</label><input type="text" id="fabrication" name="fabrication">
                </div>
                <div class="col-sm-6">
                    <label for="commercialization">Comercialización</label><input type="text" id="commercialization" name="commercialization">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label for="description">Descripción detallada del giro comercial</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                </div>
            </div>
            <hr>
            <siv class="row margin-bottom">
                <p class="blue">Declaro, bajo protesta de decir verdad, que la marca se ha utilizado desde la fecha:</p>
                <div class="row margin-bottom">
                    <div class="col-sm-6 term">
                        <input type="checkbox"><span class="text">No se ha utilizado en el mercado aún.</span>
                    </div>
                    <div class="col-sm-6 term">
                        <input type="checkbox"><span class="text">Si se ha utilizado.</span>
                    </div>
                </div>
            </siv>
            <hr>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <p class="blue">¿A partir de que fecha se ha usado?</p>
                    <input type="text" name="date" id="date">
                </div>
                <div class="col-sm-4"></div>
            </div>
            <hr>
            <div class="row">
                <p class="blue">¿En qué establecimiento se ha usado?</p>
                <div class="row text-left">
                    <div class="col-sm-3 ">
                        <label for="street">Calle</label><input type="text" id="street" name="street">
                    </div>
                    <div class="col-sm-3 ">
                        <label for="exterior">Número Exterior</label><input type="text" id="exterior" name="exterior">
                    </div>
                    <div class="col-sm-3 ">
                        <label for="interior">Número Interior</label><input type="text" id="interior" name="interior">
                    </div>
                    <div class="col-sm-3 ">
                        <label for="postal">Código Postal</label><input type="text" id="postal" name="postal">
                    </div>
                </div>
                <div class="row text-left">
                    <div class="col-sm-3 ">
                        <label for="colony">Colonia</label><input type="text" id="colony" name="colony">
                    </div>
                    <div class="col-sm-3 ">
                        <label for="municipality">Municipio</label><input type="text" id="municipality" name="municipality">
                    </div>
                    <div class="col-sm-2 ">
                        <label for="locality">Localidad</label><input type="text" id="locality" name="locality">
                    </div>
                    <div class="col-sm-2 ">
                        <label for="state">Estado</label><select name="state" id="state"></select>
                    </div>
                    <div class="col-sm-2 ">
                        <label for="country">País</label><select id="country" name="country"></select>
                    </div>
                </div>
            </div>
            <input type="submit" class="white green-btn center-block" value="Siguiente">
        </div>
    </div>
</div>
<?php include('footer.php'); ?>2