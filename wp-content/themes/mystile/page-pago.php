<?php
$current_user_id = get_current_user_id();

if(isset($_GET['id'])) {
    $brand_status = $wpdb->get_results('SELECT status_id FROM brands WHERE brand_id = '.$_GET['id']);
    $brand_user_id = $wpdb->get_results('SELECT user_id FROM brands WHERE brand_id = '.$_GET['id']);
    $brand_paid_status = $wpdb->get_results('SELECT is_paid_revision, is_paid_register FROM brands WHERE brand_id = '.$_GET['id']);

    if(intval($brand_status[0]->status_id) < 3) {

        $paid_status = $brand_paid_status[0]->is_paid_revision;

        $brand_cost = 199;
    } else {

        $paid_status = $brand_paid_status[0]->is_paid_register;

        $brand_cost = 4999;
    }

    if($brand_user_id[0]->user_id != $current_user_id) {
        wp_redirect(home_url());
    }
} else {
    wp_redirect(home_url());
}
?>
<?php get_header(); ?>
    <style>
        .ps h3 {
            margin-bottom: 10px;
            font-size: 15px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .ps {
            background-color: #fff;
            font-size: 14px;
            width: 496px;
            border-radius: 4px;
            box-sizing: border-box;
            padding: 0 45px;
            margin: 40px auto;
            overflow: hidden;
            border: 1px solid #b0afb5;
            font-family: 'Open Sans', sans-serif;
            color: #4f5365;
        }

        .ps-reminder {
            position: relative;
            top: -1px;
            padding: 9px 0 10px;
            font-size: 11px;
            text-transform: uppercase;
            text-align: center;
            color: #ffffff;
            background: #000000;
        }

        .ps-info {
            margin-top: 26px;
            position: relative;
        }

        .ps-info:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }

        .ps-brand {
            width: 45%;
            float: left;
        }

        .ps-brand img {
            max-width: 150px;
            margin-top: 2px;
        }

        .ps-amount {
            width: 55%;
            float: right;
        }

        .ps-amount h2 {
            font-size: 36px;
            color: #000000;
            line-height: 24px;
            margin-bottom: 15px;
        }

        .ps-amount h2 sup {
            font-size: 16px;
            position: relative;
            top: -2px
        }

        .ps-amount p {
            font-size: 10px;
            line-height: 14px;
        }

        .ps-reference {
            margin-top: 14px;
        }

        .ps h1 {
            font-size: 27px;
            color: #000000;
            text-align: center;
            margin-top: -1px;
            padding: 6px 0 7px;
            border: 1px solid #b0afb5;
            border-radius: 4px;
            background: #f8f9fa;
        }

        .ps-instructions {
            margin: 32px -45px 0;
            padding: 14px 45px 34px;
            border-top: 1px solid #b0afb5;
            background: #f8f9fa;
        }

        .ps ol {
            margin: 17px 0 0 16px;
        }

        .ps li + li {
            margin-top: 10px;
            color: #000000;
        }

        .ps a {
            color: #1475ce;
        }

        .ps-footnote {
            margin-top: 22px;
            padding: 12px 20px 10px;
            color: #108f30;
            text-align: center;
            border: 1px solid #108f30;
            border-radius: 4px;
            background: #ffffff;
        }

        .modal {
            padding: 0!important;
        }

        .modal-dialog {
            margin: 0 auto!important;
            width: 100%;
            height: 100%;
        }

        .modal-content {
            height: 100%;
            border-radius: 0;
            box-shadow: none;
            background-color: transparent;
        }

        .modal-body {
            padding: 0;
            width: auto;
        }

        .modal .close {
            position: absolute;
            right: 15px;
            top: 0;
            color: #fff;
            z-index: 99999;
            font-size: 60px;
            opacity: .5;
        }

        .modal .close:hover {
            opacity: .8;
        }

        iframe {
            display: none;
        }

    </style>
    <div class="wrapper registro pago forma-registro">
        <div class="container tab-content spacing">
            <div class="indicators blue text-center row no-margin">
                <div class="col-sm-3">
                    <h4 class="blue">Pago</h4>
                    <div class="circle <?php if($paid_status == 1){ ?>active<?php } ?>"></div>
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
            <?php if($paid_status == 0) { ?>
                <div class="form-container text-center">
                    <h1 class="header blue">ELIGE TU FORMA DE PAGO</h1>
                    <p class="text">
                        Por favor indícanos el medio de pago más cómodo para ti:
                    </p>
                    <h2 class="price">$<?php echo number_format($brand_cost, 2, '.', ','); ?> pesos M.N.</h2>
                    <div class="row no-margin" id="payment_methods">
                        <div class="col-sm-6">
                            <p class="text">
                                Pago por transferencia bancaria
                            </p>
                            <!--Banco-->
                            <div id="bank" style="text-align: left;">
                                <form action="<?php echo home_url(); ?>/conektacontroller" method="POST" id="bank-form">
                                    <div class="bank-errors alert alert-danger hidden"></div>
                                    <div>
                                        <label style="width: 100%;">
                                            <span>Nombre Completo</span>
                                            <input type="text" name="name_bank" size="20">
                                        </label>
                                    </div>
                                    <div>
                                        <label style="width: 100%;">
                                            <span>Teléfono</span>
                                            <input type="text" name="phone_bank" size="20" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </label>
                                    </div>
                                    <input type="hidden" name="payment_type" value="bank">
                                    <input type="hidden" name="brand_id" value="<?php echo $_GET['id']; ?>">
                                    <button class="white btn red-btn" style="margin: 0;" type="submit">OBTENER FICHA</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <p class="text">
                                Pago con tarjeta de débito ó crédito
                            </p>
                            <!--Tarjeta -->
                            <div id="card" style="text-align: left;">
                                <form action="<?php echo home_url(); ?>/conektacontroller" method="POST" id="card-form">
                                    <div class="card-errors alert alert-danger hidden"></div>
                                    <div>
                                        <label style="width: 100%;">
                                            <span>Nombre del tarjetahabiente</span>
                                            <input type="text" name="name_card" size="20" data-conekta="card[name]">
                                        </label>
                                    </div>
                                    <div>
                                        <label style="width: 100%;">
                                            <span>Teléfono</span>
                                            <input type="text" name="phone_card" size="20" data-conekta="card[phone]" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </label>
                                    </div>
                                    <div>
                                        <label style="width: 100%;">
                                            <span>Número de tarjeta de crédito</span>
                                            <input type="text" name="number_card" size="20" data-conekta="card[number]" maxlength="16" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <span>CVC</span>
                                            <input type="text" name="cvc_card" size="4" data-conekta="card[cvc]" maxlength="4" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <span>Fecha de expiración (MM/AAAA)</span>
                                            <div class="clearfix"></div>
                                            <input type="text" name="exp_month_card" size="2" data-conekta="card[exp_month]" maxlength="2" style="width: 60px;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            <span>/</span>
                                            <input type="text"  name="exp_year_card" size="4" data-conekta="card[exp_year]" maxlength="4" style="width: 60px;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </label>
                                    </div>
                                    <input type="hidden" name="payment_type" value="card">
                                    <input type="hidden" name="brand_id" value="<?php echo $_GET['id']; ?>">
                                    <button class="white btn red-btn" style="margin: 0;" type="submit" onclick="event.preventDefault(); paymentCard();">PAGAR</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="text-center form-container">
                    <h1 class="header blue">¡Gracias por confiar en Registralow!</h1>
                    <p class="text">
                        Te hemos enviado un correo para completar tu registro y validar el pago de:
                    </p>
                    <h2 class="price">$<?php echo number_format($brand_cost, 2, '.', ','); ?> pesos M.N.</h2>
                    <div class="row no-margin btns-container">
                        <div class="col-sm-6 text-right">
                            <form action="<?php echo home_url(); ?>/submitsolicitor" method="POST">
                                <button type="submit" class="white btn blue-btn auto-width" name="re-sendEmail">VOLVER A ENVIAR CORREO</button>
                                <input type="hidden" name="brand_id" value="<?php echo $_GET['id']; ?>">
                            </form>
                        </div>
                        <div class="col-sm-6 text-left">
                            <form action="<?php echo home_url(); ?>/submitsolicitor" method="POST">
                                <button type="submit" class="white btn blue-btn auto-width" name="print_ticket">IMPRIMIR COMPROBANTE</button>
                                <input type="hidden" name="brand_id" value="<?php echo $_GET['id']; ?>">
                            </form>
                        </div>
                    </div>
                    <p class="text note">
                        SI REQUIERES FACTURA, SOLICÍTALA: <br>
                        <a href="mailto:facturacion@registralow.com">facturacion@registralow.com</a>
                    </p>
                </div>
            <?php } ?>
        </div>

        <div class="info-modal modal fade" id="voucher" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="ps">
                            <div class="ps-header">
                                <div class="ps-reminder">Ficha digital. No es necesario imprimir.</div>
                                <div class="ps-info">
                                    <div class="ps-brand"><img src="<?php echo bloginfo('template_url'); ?>/img/logos/spei_brand.png" alt="SPEI"></div>
                                    <div class="ps-amount">
                                        <h3>Monto a pagar</h3>
                                        <h2><div class="amount-quantity">$ 0,000.00</div> <sup>MXN</sup></h2>
                                        <p>Utiliza exactamente esta cantidad al realizar el pago.</p>
                                    </div>
                                </div>
                                <div class="ps-reference">
                                    <h3>CLABE</h3>
                                    <h1><div class="clabe-number">0000000000000000000</div></h1>
                                </div>
                            </div>
                            <div class="ps-instructions">
                                <h3>Instrucciones</h3>
                                <ol>
                                    <li>Accede a tu banca en línea.</li>
                                    <li>Da de alta la CLABE en esta ficha. <strong>El banco deberá de ser <span class="bank-name">STP</span></strong>.</li>
                                    <li>Realiza la transferencia correspondiente por la cantidad exacta en esta ficha, <strong>de lo contrario se rechazará el cargo</strong>.</li>
                                    <li>Al confirmar tu pago, el portal de tu banco generará un comprobante digital. <strong>En el podrás verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</li>
                                </ol>
                                <div class="ps-footnote">Al completar estos pasos recibirás un correo de <strong>Registralow</strong> confirmando tu pago.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <div class="loader">
        <div class="sk-fading-circle">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
        </div>
    </div>

    <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
    <script>

        Conekta.setPublishableKey('key_CzGbCVP2GvssZyX54yx65fQ');

        var conektaSuccessResponseHandler = function(token) {
            var $form = $("#card-form");
            //Inserta el token_id en la forma para que se envíe al servidor
            $form.append($("<input type='hidden' name='token_id' id='conektaTokenId'>").val(token.id));
            $form.get(0).submit(); //Hace submit
        };

        var conektaErrorResponseHandler = function(response) {
            var $form = $("#card-form");
            $form.find(".card-errors").text(response.message_to_purchaser);
            $form.find("button").prop("disabled", false);
        };

        function paymentCard() {
            var $form = $('#card-form');

            if(validateCard()) {
                $('.loader').addClass('active');

                // Previene hacer submit más de una vez
                $form.find("button").prop("disabled", true);
                Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);

                send_payment_card();
            }
        }

        function validateCard() {
            var $errors = '';

            $('#card-form').find('input').each(function () {
                if($errors == '') {
                    if($(this).val() == '') {
                        $errors += 'Asegurate de completar todos los campos para proceder con el pago.<br>'
                    }
                }
            });

            if($('input[name=phone_card]').val().length < 10) {
                $errors += 'Ingresa un teléfono válido.<br>'
            }

            if($('input[name=number_card]').val().length != 16) {
                $errors += 'Ingresa un número de tarjeta válido.<br>'
            }

            if($('input[name=exp_month_card').val().length != 2) {
                $errors += 'Ingresa un mes de expiración válido.<br>'
            }

            if($('input[name=exp_year_card').val().length != 4) {
                $errors += 'Ingresa un año de expiración válido.<br>'
            }

            if($errors == '') {
                return true;
            } else {
                console.log($errors);
                $('.card-errors').removeClass('hidden').addClass('fade').addClass('in').html($errors);
                return false;
            }
        }

        $('#bank-form').submit(function (e) {
            e.preventDefault();
            var $form = $(this);

            if(validateBank()) {
                // Previene hacer submit más de una vez
                //$form.find("button").prop("disabled", true);

                $('.loader').addClass('active');
                send_payment_bank();
            }
        });

        function validateBank() {
            var $errors = '';

            $('#bank-form').find('input').each(function () {
                if($errors == '') {
                    if($(this).val() == '') {
                        $errors += 'Asegurate de completar todos los campos para proceder con el pago.<br>'
                    }
                }
            });

            if($('input[name=phone_bank]').val().length < 10) {
                $errors += 'Ingresa un teléfono válido.<br>'
            }

            if($errors == '') {
                return true;
            } else {
                console.log($errors);
                $('.bank-errors').removeClass('hidden').addClass('fade').addClass('in').html($errors);
                return false;
            }
        }

        function send_payment_card(){
            var dataString = {
                'payment_type'  : $('#card-form input[name=payment_type]').val(),
                'name_card'   : $('input[name=name_card]').val(),
                'phone_card'   : $('input[name=phone_card]').val(),
                'number_card'   : $('input[name=number_card]').val(),
                'token_id'   : $('input[name=token_id]').val(),
                'brand_id'      : $('#card-form input[name=brand_id]').val()
            };

            $.ajax({
                type: "POST",
                url: "<?php echo home_url().'/conektacontroller' ?>",
                data: dataString,
                dataType: 'JSON',
                success: function(data) {
                    $('.loader').removeClass('active');
                }
            });
        }

        function send_payment_bank(){
            var dataString = {
                'payment_type'  : $('#bank-form input[name=payment_type]').val(),
                'name_bank'   : $('input[name=name_bank]').val(),
                'phone_bank'   : $('input[name=phone_bank]').val(),
                'token_id'   : $('input[name=token_id]').val(),
                'brand_id'      : $('#bank-form input[name=bank_id_type]').val()
            };

            $.ajax({
                type: "POST",
                url: "<?php echo home_url().'/conektacontroller' ?>",
                data: dataString,
                dataType: 'JSON',
                success: function(data) {
                    $('.amount-quantity').text(data.amount);
                    $('.clabe-number').text(data.clabe);
                    $('.bank-name').text(data.bank);

                    $('#voucher').modal('show');
                    $('.loader').removeClass('active');
                }
            });
        }
    </script>
<?php get_footer(); ?>