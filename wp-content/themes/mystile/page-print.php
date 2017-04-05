<?php
if(!is_user_logged_in()) {
    wp_redirect(home_url());
    exit();
}

$brand_id = $_GET['id'];

$brand = $wpdb->get_results("SELECT * FROM brands WHERE brand_id =".$brand_id." LIMIT 1");
$user_data = get_user_by('id',$brand[0]->user_id);

if(get_current_user_id() != $user_data->ID) {
    wp_redirect(home_url());
    exit();
}

if ($brand[0]->status_id < 3) {
    if($brand[0]->is_paid_revision == 0) {
        wp_redirect(home_url());
        exit();
    }
    $type = 'revision';
    $price = '$4,999.00';
} else {
    if($brand[0]->is_paid_register == 0) {
        wp_redirect(home_url());
        exit();
    }
    $type = 'register';
    $price = '$199.00';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/style.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <style type="text/css" media="print">
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }
    </style>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Open+Sans");
        table {
            font-family: "Open Sans","sans-serif";
        }
        body {
            -webkit-print-color-adjust:exact;
            pointer-events: none;
        }
        .a4 {
            width: 210mm;
            padding: 30px;
        }
        .text {
            font-size: 16px!important;
        }
        h2 {
            margin: 10px 0!important;
        }
        p {
            margin: 3px 0;
        }
    </style>
</head>
<body>
<div class="a4">
    <table style="border-collapse: collapse;margin: 0 auto;background: #fff;border-radius: 5px;width: 800px;border: 1px solid #e3e3e3;border-spacing: 0;">
        <tbody>
        <tr style="background-color: #dede38;margin-bottom: 5px;">
            <td colspan="2" style="margin: 0 auto;height: auto;padding: 10px 15px;">
                <img src="<?php echo get_bloginfo('template_url')?>/img/index/icons/r-blue.png" alt="Registralow" style="display: inline-block;width: 30px;margin-right: 15px;float: left;">
                <a href="https://registralow.com" style="color: #1da6df;display: inline-block;line-height:30px;margin:0;text-decoration:none!important;font-size:16px;">www.registralow.com</a>
            </td>
        </tr>
        <tr style="height: 5px;"></tr>
        <tr style="background-color: #1da6df;">
            <td style="margin: 0 auto;height: auto;padding: 15px;color: #353535;color:#fff;">
                <h2 style="font-weight:400;font-size:22px;">Confirmación de pago:</h2>

                <h2 class="price"><?php echo $price; ?> pesos M.N.</h2>
                <p class="text">
                    <strong>Folio: </strong><?php echo $brand[0]->brand_id; ?>
                </p>
                <p class="text">
                    <strong>Solicitante: </strong><?php echo $user_data->user_firstname.' '.$user_data->user_lastname; ?>
                </p>
            </td>
            <td>
                <img src="<?php echo get_bloginfo('template_url')?>/img/index/nosotros/h3.png" style="max-width: 420px;position:relative;bottom:-6px;">
            </td>
        </tr>
        </tbody>
    </table>
</div>
<script>
    window.onload = function() {
        setTimeout("window.print();", 500);
    };
    (function() {
        var beforePrint = function() {
            console.log('Functionality to run before printing.');
        };
        var afterPrint = function() {
            window.history.back();
        };
        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (mql.matches) {
                    beforePrint();
                } else {
                    afterPrint();
                }
            });
        }
        window.onbeforeprint = beforePrint;
        window.onafterprint = afterPrint;
    }());
</script>
</body>
</html>