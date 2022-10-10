<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body style="background-color: #EDE7D3;">
    <div class="container" style="float:cente; padding:15%; border: 3px solid black; margin-top:5%">
        <div><h1>No se encuentra conectado a una sesión.</h1></div>
        <a href="<?php echo base_url() ?>/SigninController/index"  tabindex="-1" aria-disabled="true">        <button type="button" name="login" id="login" class="btn btn-primary btn-lg">Iniciar sesión</button></a>
        <a href="<?php echo base_url() ?>"  tabindex="-1" aria-disabled="true">        <button type="button" name="login" id="login" class="btn btn-primary btn-lg">Volver al Inicio</button></a>
    </div>
</body>
</html>