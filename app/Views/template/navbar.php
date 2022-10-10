<!DOCTYPE html>
 <html>
  <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title></title>  
  </head>
  <body>
   <!-- depends on your template design -->
   <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand">
            <img src="<?php echo base_url() ?>/public/images/logo.png" alt="logo" width="250px" height="125px" name="image" id="image"> 
        </a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <di v id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php ECHO base_url() ?>/Home/index">Indice<span class="sr-only">(current)</span></a>
                </li>
                <?php 
                //Revisar si el usuario existe y está conectado
                if($nom_cuenta != NULL ) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php ECHO base_url() ?>/Home/VerPacientes"  tabindex="-1" aria-disabled="true">Lista de Pacientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php ECHO base_url() ?>/FormaControlador/InPac" tabindex="-1" aria-disabled="true">Ingresar Paciente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php ECHO base_url() ?>/Home/VerStaff"  tabindex="-1" aria-disabled="true">Lista de Personal</a>
                </li>
                <?php if($S_Per_tipo == 2):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php ECHO base_url() ?>/FormaControlador/InPer"  tabindex="-1" aria-disabled="true">Ingresar Personal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php ECHO base_url() ?>/SignupController/index"  tabindex="-1" aria-disabled="true">Crear Cuenta</a>
                </li>
                <?php endif?>
                <li class="nav-item">
                    <a class="nav-link" tabindex="-1" aria-disabled="true">Datos de Cuenta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php ECHO base_url() ?>/ExitProfile/index"  tabindex="-1" aria-disabled="true">Salir Cuenta</a>
                </li>
                <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php ECHO base_url() ?>/SigninController/index"  tabindex="-1" aria-disabled="true">Ingresar Cuenta</a>
                </li>
                <?php endif?>
                <li class="nav-item">
                   <?php echo $nom_cuenta?>
                </li>
                <?php if($S_Per_tipo == 1): ?>
                <li class="nav-item">
                   <?php echo "CUENTA: SALUD"?>
                </li>
                <?php endif?>
                <?php if($S_Per_tipo == 2): ?>
                <li class="nav-item">
                   <?php echo "CUENTA: TÉCNICO"?>
                </li>
                <?php endif?>
            </ul>
        </div>
    </nav>
     