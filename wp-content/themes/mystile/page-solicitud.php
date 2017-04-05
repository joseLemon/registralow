<?php
if(is_user_logged_in()) {
    $current_user = wp_get_current_user();

    $current_user_firstname = $current_user->user_firstname;
    $current_user_email = $current_user->user_email;
} else {
    $current_user_firstname = '';
    $current_user_email = '';
}
?>
<?php include('header.php'); ?>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css">
    <div class="wrapper registro">
        <div class="container">
            <div class="form-container active spacing">
                <div class="row">
                    <div class="col-sm-12">
                        <div name="error" id="error" class="alert alert-danger hidden"></div>
                    </div>
                </div>
                <form action="<?php echo home_url(); ?>/submitsolicitor" id="requestForm" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="solicitor_name">Nombre(s)</label><input type="text" id="solicitor_name" name="solicitor_name" value="<?php echo $current_user_firstname; ?>" autocomplete="off">
                        </div>
                        <div class="col-sm-3">
                            <label for="last_name">Apellido Paterno</label><input type="text" id="last_name" name="last_name" autocomplete="off">
                        </div>
                        <div class="col-sm-3">
                            <label for="m_last_name">Apellido Materno</label><input type="text" id="m_last_name" name="m_last_name" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="business_course">Giro Comcercial</label>
                            <select name="business_course" id="business_course">
                                <option selected disabled>---PRODUCTOS---</option>
                                <?php $results = $wpdb->get_results( "SELECT * FROM `business_course`" );
                                foreach ($results as $result){
                                    $needDescription = "";
                                    if($result->need_description == 1){
                                        $needDescription = 'class = "description"';
                                    }
                                    if($result->is_product == 1){
                                        echo "<option $needDescription value='$result->business_course_id'>$result->business_course_name</option>";
                                    }
                                }
                                echo '<option disabled>---SERVICIOS---</option>';
                                foreach ($results as $result){
                                    $needDescription = "";
                                    if($result->need_description == 1){
                                        $needDescription = 'class = "description"';
                                    }
                                    if($result->is_product == 0){
                                        echo "<option $needDescription value='$result->business_course_id'>$result->business_course_name</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input type="text" id="others" name="others" class="hidden" placeholder="Especifique" disabled>
                            <label for="email">Email</label><input type="text" id="email" name="email" value="<?php echo $current_user_email; ?>" autocomplete="off">
                            <label for="email_confirm">Confirmación de Email</label><input type="text" id="email_confirm" name="email_confirm" value="<?php echo $current_user_email; ?>">
                            <!-- RECAPTCHA -->
                            <label class="submit__control">
                                <h4>¿Eres humano?</h4>
                                <div class="submit__generated"></div>
                                <i class="fa fa-refresh"></i>
                                <span class="submit__error hide">Valor incorrecto</span>
                                <span class="submit__error--empty hide">Es requerido que se ingrese un valor</span>
                                <div class="terms-container">
                                    <input type="checkbox" name="termsConditions" id="termsConditions">
                                    <label for="termsConditions"></label>
                                    <a href="legal" class="terms-link" target="_blank">Acepto términos y condiciones</a>
                                </div>
                            </label>
                        </div>
                        <div class="col-sm-6">
                            <label for="preview">Tu Marca: Vista Previa</label>
                            <div class="clearfix"></div>
                            <div class="img-container preview">
                                <img src="" alt="" id="preview" class="center-block img-responsive">
                            </div>
                            <div class="clearfix"></div>
                            <label for="brand_file" class="file-input">ADJUNTAR</label>
                            <input id="brand_file" name="brand_file" type="file" accept="image/x-png,image/jpeg">
                        </div>
                    </div>
                    <div class="row btns-container">
                        <div class="col-sm-6 text-right">
                            <a href="#" class="btn blue-btn disabled" id="buscarSubmit">BUSCAR</a>
                        </div>
                        <div class="col-sm-6 text-left">
                            <a href="#" class="btn blue-btn disabled" id="registrarSubmit">REGISTRAR</a>
                        </div>
                    </div>
                    <input type="hidden" id="requestType" name="requestType">
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // refresh captcha
            $('img#captcha-refresh').click(function() {
                change_captcha();
            });

            function change_captcha() {
                document.getElementById('captcha').src="get_captcha.php?rnd=" + Math.random();
            }
        });

        function readFile() {
            if (this.files && this.files[0]) {
                var FR= new FileReader();
                FR.addEventListener("load", function(e) {
                    document.getElementById("preview").src = e.target.result;
                });
                FR.readAsDataURL( this.files[0] );
                $('.preview').addClass('active');
            }
        }

        document.getElementById("brand_file").addEventListener("change", readFile);
    </script>
    <script>
        var a, b, c,
            submitContent,
            captcha,
            locked,
            validSubmit = false,
            timeoutHandle;

        // Generating a simple sum (a + b) to make with a result (c)
        function generateCaptcha(){
            a = Math.ceil(Math.random() * 10);
            b = Math.ceil(Math.random() * 10);
            c = a + b;
            submitContent = '<span>' + a + '</span> + <span>' + b + '</span>' +
                ' = <input class="submit__input" type="text" maxlength="2" size="2" required />';
            $('.submit__generated').html(submitContent);

            init();
        }


        // Check the value 'c' and the input value.
        function checkCaptcha(){
            if(captcha === c){
                // Pop the green valid icon
                $('.submit__generated')
                    .removeClass('unvalid')
                    .addClass('valid');
                $('.submit').removeClass('overlay');
                $('.submit__overlay').fadeOut('fast');

                // Buttons to continue process
                $('a.btn').removeClass('disabled');

                $('.submit__error').addClass('hide');
                $('.submit__error--empty').addClass('hide');
                validSubmit = true;
            }
            else {
                // Buttons to continue process
                $('a.btn').addClass('disabled');

                if(captcha === ''){
                    $('.submit__error').addClass('hide');
                    $('.submit__error--empty').removeClass('hide');
                }
                else {
                    $('.submit__error').removeClass('hide');
                    $('.submit__error--empty').addClass('hide');
                }
                // Pop the red unvalid icon
                $('.submit__generated')
                    .removeClass('valid')
                    .addClass('unvalid');
                $('.submit').addClass('overlay');
                $('.submit__overlay').fadeIn('fast');
                validSubmit = false;
            }
            return validSubmit;
        }

        function unlock(){ locked = false; }


        // Refresh button click - Reset the captcha
        $('.submit__control i.fa-refresh').on('click', function(){
            if (!locked) {
                locked = true;
                setTimeout(unlock, 500);
                generateCaptcha();
                setTimeout(checkCaptcha, 0);
            }
        });

        // init the action handlers - mostly useful when 'c' is refreshed
        function init(){
            /*$('form').on('submit', function(e){
                e.preventDefault();
                if($('.submit__generated').hasClass('valid')){
                    // var formValues = [];
                    captcha = $('.submit__input').val();
                    if(captcha !== ''){
                        captcha = Number(captcha);
                    }

                    checkCaptcha();

                    if(validSubmit === true){
                        validSubmit = false;
                        // Temporary direct 'success' simulation
                        submitted();
                    }
                }
                else {
                    return false;
                }
            });*/

            // Captcha input result handler
            $('.submit__input').on('propertychange change keyup input paste', function(){
                // Prevent the execution on the first number of the string if it's a 'multiple number string'
                // (i.e: execution on the '1' of '12')
                window.clearTimeout(timeoutHandle);
                timeoutHandle = window.setTimeout(function(){
                    captcha = $('.submit__input').val();
                    if(captcha !== ''){
                        captcha = Number(captcha);
                    }
                    checkCaptcha();
                },150);
            });

            // Add the ':active' state CSS when 'enter' is pressed
            $('body')
                .on('keydown', function(e) {
                    if (e.which === 13) {
                        if($('.submit-form').hasClass('overlay')){
                            checkCaptcha();
                        } else {
                            $('.submit-form').addClass('enter-press');
                        }
                    }
                })
                .on('keyup', function(e){
                    if (e.which === 13) {
                        $('.submit-form').removeClass('enter-press');
                    }
                });

            // Refresh button click - Reset the captcha
            $('.submit-control i.fa-refresh').on('click', function(){
                if (!locked) {
                    locked = true;
                    setTimeout(unlock, 500);
                    generateCaptcha();
                    setTimeout(checkCaptcha, 0);
                }
            });

            // Submit white overlay click
            $('.submit-form-overlay').on('click', function(){
                checkCaptcha();
            });
        }

        generateCaptcha();
    </script>
    <script>
        // Form Validation
        var errors = '';
        $('#buscarSubmit, #registrarSubmit').click(function (e) {
            e.preventDefault();

            errors = '';

            var id = $(this).attr('id');

            var email = $('#email').val(),
                name = $('#solicitor_name').val(),
                lastName = $('#last_name').val(),
                mLastName = $('#m_last_name').val();

            if( name == null || name.length == 0 || /^\s+$/.test(name) ) {
                errors += "El nombre es obligatorio.<br>";
            } else {
                if(name.length > 35){
                    errors += "El numero de letras máximo para el nombre es de 35.<br>";
                }
            }

            if( lastName == null || lastName.length == 0 || /^\s+$/.test(lastName) ) {
                errors += "El apellido paterno es obligatorio.<br>";
            } else {
                if(lastName.length > 35){
                    errors += "El numero de letras máximo para el Apellido es de 35.<br>";
                }
            }

            if( mLastName.length > 35 ){
                errors += "El numero de letras máximo para el Apellido materno es de 35.<br>";
            }

            if( email == null || email.length == 0 || /^\s+$/.test(email) ) {
                errors += "El correo electrónico es obligatorio.<br>";
            } else {
                var emailPattern=/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                if (!(email.match(emailPattern))) {
                    errors +=  "El correo electrónico debe tener un formato válido.<br>";
                }
            }

            if( email != $('#email_confirm').val() ) {
                errors += 'Los correos electrónicos no coinciden.<br>';
            }

            if( !$('#termsConditions').is(':checked') ) {
                errors += 'Debes aceptar nuestros términos y condiciones para continuar.<br>'
            }

            if( $('#business_course').val() == null ) {
                errors += 'Debes elegir un tipo de giro comercial.<br>'
            }

            if( !$('#others').hasClass('hidden') && $('#others').val() == '' ) {
                errors += 'Debes especificar tu giro comercial.<br>';
            }

            if( $('#brand_file').get(0).files.length == 0 ) {
                errors += 'Asegurate de agregar la imagen de tu marca.<br>';
            }

            /*if( $('#brand_file') == '' ) {
                errors += 'De'
            }*/

            if( errors != '' ){
                $("#error").removeClass('hidden').addClass('active').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Lo sentimos :( <br>' + errors);
                e.preventDefault();
                setTimeout(function () {
                    $('html, body').stop().animate({
                        'scrollTop': $('.wrapper').offset().top
                    }, 500, 'swing' );
                }, 300 );
            } else {
                if(id == 'buscarSubmit') {
                    $('#requestType').val('revision');
                }
                if(id == 'registrarSubmit') {
                    $('#requestType').val('register');
                }

                $('#requestForm').submit();
            }
        });

        $('#business_course').change(function () {
            console.log();
            if($(this).val() == 5 || $(this).val() == 10) {
                $('#others').removeClass('hidden').prop('disabled',false);
            } else {
                $('#others').addClass('hidden').prop('disabled',true);
            }
        });

        $('#email').focusout(function () {
            errors = '';

            var dataString = {
                'user_email'  : $(this).val(),
                'validate_email' : true
            };

            <?php if(!is_user_logged_in()) { ?>
            $.ajax({
                type: "POST",
                url: "<?php echo home_url().'/submitsolicitor' ?>",
                data: dataString,
                dataType: 'JSON',
                success: function(data) {
                    if(!data) {
                        console.log(data);
                        errors = 'El correo electrónico no está disponible, asegurate de iniciar sesión antes de continuar.<br>';
                        $("#error").removeClass('hidden').addClass('active').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Lo sentimos :( <br>' + errors);
                        $('#email').addClass('invalid');
                    } else {
                        $("#error").addClass('hidden').removeClass('active').html('');
                        $('#email').removeClass('invalid');
                    }
                }
            });
            <?php } ?>
        });
    </script>
<?php include('footer.php'); ?>