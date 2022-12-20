<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<html>

<body>
    <!-- depends on your template design -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary" style="border-style:outset;border-color:#3281E8;border-width:6px">
        <a class="navbar-brand">
            <img src="<?php echo base_url() ?>/public/images/logo.png" alt="logo" width="250px" height="100px" name="image" id="image">
        </a>

        <di v id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>/index">Indice</a>
                </li>
                <?php
                //Revisar si el usuario existe y está conectado
                if ($nom_cuenta != NULL) : ?>
                    <?php
                    //Si Cuenta es Salud o Técnico
                    $prio = [1, 2];
                    if (in_array($S_Per_tipo, $prio)) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pacientes
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?php echo base_url() ?>/VerPacientes" tabindex="-1" aria-disabled="true">Lista de Pacientes</a>
                                <a class="dropdown-item" href="<?php echo base_url() ?>/IngresarPaciente" tabindex="-1" aria-disabled="true">Ingresar Paciente</a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Personal
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo base_url() ?>/VerStaff" tabindex="-1" aria-disabled="true">Lista de Personal</a>
                            <?php
                            //Si Cuenta es solo Técnico 
                            if ($S_Per_tipo == 2) : ?>
                                <a class="dropdown-item" href="<?php echo base_url() ?>/IngresarStaff" tabindex="-1" aria-disabled="true">Ingresar Personal</a>
                            <?php endif ?>
                        </div>
                    </li>
                    <?php
                    //Si Cuenta es solo Técnico 
                    if ($S_Per_tipo == 2) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sistema
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?php echo base_url() ?>/signup" tabindex="-1" aria-disabled="true">Crear Cuenta</a>
                                <a class="dropdown-item" href="<?php echo base_url() ?>/DiagramaGraph/initChart" tabindex="-1" aria-disabled="true">Diagrama de Datos</a>
                            </div>
                        </li>

                    <?php endif ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url() ?>/details" tabindex="-1" aria-disabled="true">Datos de Cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url() ?>/ExitProfile/index" tabindex="-1" aria-disabled="true">Salir Cuenta</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url() ?>/signin" tabindex="-1" aria-disabled="true">Ingresar Cuenta</a>
                    </li>
                <?php endif ?>
            </ul>
            <ul class="navbar-nav">
                <?php if ($S_Per_tipo == 1) : ?>
                    <li class="nav-item">
                        <?php echo "CUENTA: SALUD" ?>
                    </li>
                    <li class="nav-item">
                        <img src="<?php echo base_url() ?>/public/images/medical.png" style="width:50px;height:50px;">
                    </li>
                <?php endif ?>
                <?php if ($S_Per_tipo == 2) : ?>
                    <li class="nav-item">
                        <?php echo "CUENTA: TÉCNICO" ?>
                    </li>
                    <li class="nav-item">
                        <img src="<?php echo base_url() ?>/public/images/admin.png" style="width:50px;height:50px;">
                    </li>
                <?php endif ?>
                <?php if ($S_Per_tipo == 3) : ?>
                    <li class="nav-item">
                        <?php echo "CUENTA: LIMPIEZA" ?>
                        <img src="<?php echo base_url() ?>/public/images/lindolimpiador.png" style="width:50px;height:50px;">
                    </li>
                <?php endif ?>
            </ul>
            </div>
    </nav>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>