$(document).ready(function () {
    $file_size = 0;

    // you want to enable the pointer events only on click;

    $('.map').addClass('scrolloff'); // set the pointer events to none on doc ready
    $('.canvas').on('click', function () {
        $('.map').removeClass('scrolloff'); // set the pointer events true on click
    });

    // you want to disable pointer events when the mouse leave the canvas area;

    $(".map").mouseleave(function () {
        $('.map').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
    });

    $('input[type=file]').change(function(e){
        $filename=$(this);
        $filename.next().html($filename.val().replace(/C:\\fakepath\\/i, '&nbsp&nbsp&nbsp&nbsp&nbsp'));
    });


    /*
    $('#login-form').on('submit', function (e) {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/wp-admin/admin-ajax.php',
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('#login-form #login-name').val(), 
                'password': $('#login-form #login-pass').val() },
            success: function(data){
                if (data.loggedin == true){
                    document.location.href = ajax_login_object.redirecturl;
                }
                alert('success');
            }
        });
        e.preventDefault();

    });*/

    $('#login-modal').click( function () {
        /*$('.#social_login_frame #branding').css({ display : 'none' });
        $('.#social_login_frame #providers, #providers #providers, #providers .providers_group, #providers .providers_block, #providers .providers_row').width('100%');*/
        $('.provider').css({ float : 'none', display : 'inline-block'})
    });

    $('#productos').click(function () {
        if( $(this).is(":checked") ) {
            $('#productSelect').removeClass('hidden');
            $('#business_course').text('Productos');
        }
    });

    $('#servicios').click(function () {
        if( $(this).is(":checked") ) {
            $('#productSelect').addClass('hidden');
            $('#business_course').text('Servicios');
        }
    });

    $('#fabrication').click(function () {
        if( $(this).is(":checked") ) {
            $('#business_course').text('Fabricación');
        }
    });

    $('#commercialization').click(function () {
        if( $(this).is(":checked") ) {
            $('#business_course').text('Comercialización');
        }
    });

    $('#used').click(function () {
        if( $(this).is(":checked") ) {
            $('#usedDate').removeClass('hidden');
            $('#used-establishment').removeClass('hidden');
        }
    });

    $('#notUsed').click(function () {
        if( $(this).is(":checked") ) {
            $('#usedDate').addClass('hidden');
            $('#used-establishment').addClass('hidden');
        }
    });

    brand_options();

    $('#options').change(function(e) {
        brand_options();
    });

    /* PLACEHOLDERS FOR LOGIN FORM */
    $("#user_login").attr("placeholder", "Usuario");
    $("#user_pass").attr("placeholder", "Contraseña");

    /*$margin = ($('.mi-cuenta').width()/2);
    $('.mi-cuenta').css({ marginRight: $margin });*/
});

$(document).ready(function(){
    $('#modal-seguimiento').modal('show');
    $('#modal-no-registrable').modal('show');
    $('#registration-errors').modal('show');
});

$(document).ready(function() {
    $iframe = $('.inicio iframe[allowfullscreen]');
    $iframe.addClass('transform-center-vertical');
    $iframe.addClass('hidden-sm');
    $iframe.addClass('hidden-xs');
});

$('input[type=file]').bind('change', function() {
    console.log('change');
    //this.files[0].size gets the size of your file.
    if ( this.files[0].size > 25000000 ) {
        alert('La imagen no puede pesar más de 25Mb. Intenta una imagen más ligera.');
    }

    $file_size = this.files[0].size;
});

$('#call-new-modal').click(function() {
    $('#info-revision').modal('hide');
});

var name,
    lastName,
    mLastName,
    email,
    street,
    exterior,
    interior,
    postal,
    colony,
    town,
    state,
    country;

function validateOne(){
    var errors ="";
    name = document.getElementById("solicitor_name").value;
    lastName = document.getElementById("last_name").value;
    mLastName = document.getElementById("m_last_name").value;
    email = document.getElementById("email").value;
    street = document.getElementById("street").value;
    exterior = document.getElementById("exterior").value;
    interior = document.getElementById("interior").value;
    postal = document.getElementById("postal").value;
    colony = document.getElementById("colony").value;
    town = document.getElementById("town").value;
    state = document.getElementById("state").value;
    country = document.getElementById("country").value;
    if( name == null || name.length == 0 || /^\s+$/.test(name) ) {
        errors += "El nombre es obligatorio<br>";
    }else {
        if(name.length > 35){
            errors += "El numero de letras máximo para el nombre es de 35<br>";
        }
    }
    if( lastName == null || lastName.length == 0 || /^\s+$/.test(lastName) ) {
        errors += "El apellido paterno es obligatorio<br>";
    }else {
        if(lastName.length > 35){
            errors += "El numero de letras máximo para el Apellido es de 35<br>";
        }
    }
    if(mLastName.length > 35){
        errors += "El numero de letras máximo para el Apellido materno es de 35<br>";
    }
    if( email == null || email.length == 0 || /^\s+$/.test(email) ) {
        errors += "El correo electrónico es obligatorio<br>";
    }else{
        var emailPattern=/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        if (!(email.match(emailPattern))) {
            errors +=  "El correo electrónico debe tener un formato válido<br>";
        }
    }
    if( street == null || street.length == 0 || /^\s+$/.test(street) ) {
        errors += "La calle es obligatoria<br>";
    }else {
        if(street.length > 95){
            errors += "El numero de letras máximo para la calle es de 95<br>";
        }
    }
    if( exterior == null || exterior.length == 0 || /^\s+$/.test(exterior) ) {
        errors += "El numero exterior es obligatorio<br>";
    }else {
        if(exterior.length > 10){
            errors += "El numero de caracteres máximo para el numero exterior es de 10<br>";
        }
    }
    if( postal == null || postal.length == 0 || /^\s+$/.test(postal) ) {
        errors += "El codigo postal es obligatorio<br>";
    }else {
        if(postal.length > 10){
            errors += "El numero de caracteres máximo para el codigo postal es de 10<br>";
        }
    }
    if( colony == null || colony.length == 0 || /^\s+$/.test(colony) ) {
        errors += "La colonia es obligatoria<br>";
    }else {
        if(colony.length > 95){
            errors += "El numero de caracteres máximo para la colonia es de 95<br>";
        }
    }
    if( town == null || town.length == 0 || /^\s+$/.test(town) ) {
        errors += "El municipio es obligatorio<br>";
    }else {
        if(town.length > 95){
            errors += "El numero de caracteres máximo para la colonia es de 95<br>";
        }
    }
    if( state == null || state.length == 0 || /^\s+$/.test(state) ) {
        errors += "Elige un estado<br>";
    }
    if( country == null || country.length == 0 || /^\s+$/.test(country) ) {
        errors += "Elige un Pais<br>";
    }
    //redireccion
    if(errors==""){
        //Cambiar al segundo tab
        $('#validationOne').attr('href', '#marca');
        $('#error').removeClass('active').addClass('hidden');

    } else {
        //colorear los campos mal ingresados
        $("#error").removeClass('hidden').addClass('active').html("Lo sentimos :( <br>"+errors);
    }
}

$('#updateForm').submit(function (e) {
    validateTwo(e);
});

function validateTwo(e){
    var errors ="";
    options = document.getElementById("options").value;
    if( options == null || options.length == 0 || /^\s+$/.test(options) ) {
        errors += "Elige una opción de tu tipo de marca<br>";
    }
    if( $file_size > 25000000 ) {
        errors += "La imagen no puede pesar más de 25Mb. Intenta una imagen más ligera<br>";
    }
    //redireccion
    if(errors==""){
        //Cambiar al segundo tab
        $('#validationTwo').attr('href', '#giro');
        $('#error').removeClass('active').addClass('hidden');
    }else{
        //colorear los campos mal ingresados
        $("#error").html(errors);
        $("#error").removeClass('hidden').addClass('active').html("Lo sentimos :( <br>"+errors);
        e.preventDefault();
    }
}

$('#solicitorForm').submit(function (e) {
    validateTree(e);
});

function validateTree(e){
    var errors ="";
    description = document.getElementById("description").value;
    used = $('#b_used').is(":checked");
    street = document.getElementById("b_street").value;
    exterior = document.getElementById("b_exterior").value;
    postal = document.getElementById("b_postal").value;
    colony = document.getElementById("b_colony").value;
    town = document.getElementById("b_town").value;
    country = document.getElementById("b_country").value;
    if( description == null || description.length == 0 || /^\s+$/.test(description) ) {
        errors += "La descripción es obligatoria<br>";
    }else {
        if(description.length > 500){
            errors += "El numero de letras máximo para la descripcion es de 500<br>";
        }
    }
    if(used) {
        if( street == null || street.length == 0 || /^\s+$/.test(street) ) {
            errors += "La calle es obligatoria<br>";
        }else {
            if(street.length > 95){
                errors += "El numero de letras máximo para la calle es de 95<br>";
            }
        }
        if( exterior == null || exterior.length == 0 || /^\s+$/.test(exterior) ) {
            errors += "El numero exterior es obligatorio<br>";
        }else {
            if(exterior.length > 10){
                errors += "El numero de caracteres máximo para el numero exterior es de 10<br>";
            }
        }
        if( postal == null || postal.length == 0 || /^\s+$/.test(postal) ) {
            errors += "El codigo postal es obligatorio<br>";
        }else {
            if(postal.length > 10){
                errors += "El numero de caracteres máximo para el codigo postal es de 10<br>";
            }
        }
        if( colony == null || colony.length == 0 || /^\s+$/.test(colony) ) {
            errors += "La colonia es obligatoria<br>";
        }else {
            if(colony.length > 95){
                errors += "El numero de caracteres máximo para la colonia es de 95<br>";
            }
        }
        if( town == null || town.length == 0 || /^\s+$/.test(town) ) {
            errors += "El municipio es obligatorio<br>";
        }else {
            if(town.length > 95){
                errors += "El numero de caracteres máximo para la colonia es de 95<br>";
            }
        }
        if( state == null || state.length == 0 || /^\s+$/.test(state) ) {
            errors += "Elige un estado<br>";
        }
        if( country == null || country.length == 0 || /^\s+$/.test(country) ) {
            errors += "Elige un País<br>";
        }
    }
    if( !$('#productos').is(":checked") && !$('#servicios').is(":checked") ) {
        errors += "Se debe especificar el giro comercial<br>";
    }
    if( $('#productos').is(":checked") ) {
        if( !$('#fabrication').is(":checked") && !$('#commercialization').is(":checked") ) {
            errors += "Se debe especificar el tipo de producto<br>";
        }
    }
    if( !$('#used').is(":checked") && !$('#notUsed').is(":checked") ) {
        errors += "Se debe especificar si la marca ha sido utilizada<br>";
    }
    /*if( !$('#termsConditions').is(":checked") ) {
        errors += "Debes de aceptar nuestros términos y condiciones para proceder<br>";
    }*/

    //redireccion
    if(errors==""){
        //Cambiar al segundo tab
        $('#error').removeClass('active').addClass('hidden');

    }else{
        //colorear los campos mal ingresados
        $("#error").html(errors);
        $("#error").removeClass('hidden').addClass('active').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><br>Lo sentimos :( <br>' + errors);
        e.preventDefault();
        setTimeout(function () {
            $('html, body').stop().animate({
                'scrollTop': $('.wrapper').offset().top
            }, 500, 'swing' ); 
        }, 300 );
    }
}

function validateIndex() {
    /*
    var errors = "";

    if( !$('#indexTerms').is(":checked") ) {
        errors += "Debes de aceptar nuestros términos y condiciones para proceder<br>";
    }

    if(errors==""){
        //Cambiar al segundo tab
        $('#error').removeClass('active').addClass('hidden');

    } else {
        //colorear los campos mal ingresados
        $("#error").html(errors);
        $("#error").removeClass('hidden').addClass('active').html(errors);
        e.preventDefault();
    }*/
}

function brand_options() {
    switch( $('#options option:selected').val() ) {
        case '1':
            $('#adj-label').addClass('hidden');
            $('#design').addClass('hidden');
            $('#three_dimensional').addClass('hidden');
            $('#text').removeClass('hidden');
            break;
        case '2':
            $('#adj-label').removeClass('hidden');
            $('#design').removeClass('hidden');
            $('#three_dimensional').addClass('hidden');
            $('#text').removeClass('hidden');
            break;
        case '3':
            $('#adj-label').removeClass('hidden');
            $('#design').addClass('hidden');
            $('#three_dimensional').removeClass('hidden');
            $('#text').addClass('hidden');
            break;
        case '4':
            $('#adj-label').removeClass('hidden');
            $('#design').addClass('hidden');
            $('#three_dimensional').removeClass('hidden');
            $('#text').removeClass('hidden');
            break;
        case '5':
            $('#adj-label').removeClass('hidden');
            $('#design').removeClass('hidden');
            $('#three_dimensional').removeClass('hidden');
            $('#text').addClass('hidden');
            break;
    }
}

$(document).ready(function() {
    $('#date').datepicker({
        closeText: 'Cerrar',
        prevText: 'Ant',
        nextText: 'Sig',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    });
    $.datepicker.regional[ "es" ];
});