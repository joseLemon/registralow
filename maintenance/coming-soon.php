<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registralow | Próximamente</title>
        <style>
            @font-face {
                font-family: 'Gandhi';
                src: url('fonts/GandhiSans-Regular.otf')
            }
            body {
                font-family: 'Gandhi', sans-serif;
                background-color: #1da6df;
                letter-spacing: 2px;
                margin: 0;
                /*position: relative;
                height: 100vh;*/
            }
            .white {
                color: #fff;
            }
            .yellow {
                color: #e0e035;
            }
            .dark-blue {
                color: #45606f;
            }
            .text-center {
                text-align: center;
            }
            .center-block {
                margin: 0 auto;
            }
            .img-responsive {
                max-width: calc(100% - 30px);
                padding: 0 15px;
            }
            .left-right-padding {
                padding: 0px 15px;
            }
            .container {
                padding: 50px 0px;
                left: 0;
                right: 0;
                margin: 0 auto;
                max-width: 100vw;
                position: absolute;
                /*top: 50%;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                transform: translateY(-50%);*/
            }
            h1 {
                margin: 0;
            }
            h2 {
                font-weight: 100;
            }
            .yellow-decor {
                position: relative;
                width: 281px;
                max-width: 100%;
                height: 17px;
                background: url(img/index/decorations/yellow-decor.png) no-repeat;
            }
            .yellow-decor.top {
                top: 8.5px;
            }
            .yellow-decor.bottom {
                bottom: 8.5px;
            }
            .coming-soon {
                background-color: #3183a7;
                padding: 15px 0;
            }
            .coming-soon h1:nth-of-type(1) {
                font-size: 40px;
            }
            .coming-soon h1:nth-of-type(2) {
                font-size: 50px;
            }
            @media(max-width: 767px) {
                h2 {
                    font-size: 20px;
                }
                h3 {
                    font-size: 16px;
                }
                .coming-soon h1:nth-of-type(1) {
                    font-size: 25px;
                }
                .coming-soon h1:nth-of-type(2) {
                    font-size: 35px;
                }
            }
            @media(max-width: 480px) {
                body {
                    height: auto;
                }
                .container {
                    top: 0;
                    transform: none;
                }
            }
        </style>
    </head>
    <body>
        <div class="container text-center">
            <img src="img/index/decorations/logo.png" alt="Registralow" class="img-responsive center-block">
            <h2 class="yellow left-right-padding">REGISTRO DE MARCAS ONLINE</h2>
            <div class="yellow-decor center-block top"></div>
            <div class="coming-soon left-right-padding">
                <h1 class="white">PRÓXIMAMENTE</h1>
                <h1 class="white">FEBRERO 2017</h1>
            </div>
            <div class="yellow-decor center-block bottom"></div>
            <h3 class="dark-blue left-right-padding">
                Estámos renovandonos para atender<br>
                mejor todas tus necesidades
            </h3>
            <img src="img/index/decorations/buildings.png" alt="Decoración" class="img-responsive center-block">
        </div>
    </body>
</html>