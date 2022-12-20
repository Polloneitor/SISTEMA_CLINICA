<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .elem {
        width: 250px;
        height: 250px;
    }


    .img-cardTemp {
        width: 125px;
        height: 125px;
        margin-top: -16%;
        margin-left: 31.8%;

    }

    .cardTemp {
        position: relative;
        display: inline;
    }

    .cardTemp .img-top {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 99;
    }

    .cardTemp:hover .img-top {
        display: inline;
    }

    .cardTemp:hover .elem {
        opacity: 0.5;
    }
</style>
<section class="vh-50" >
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100" style="margin-bottom:-100px">
            <div class="col col-lg-10 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <div class="cardTemp">
                                <?php if ($file == NULL) : ?>
                                    <a href="<?php echo base_url() ?>/preupload" tabindex="-1" aria-disabled="true"><img src="<?php echo base_url() ?>/public/images/default.png" alt="Avatar" class="img-fluid my-5 elem" style="width: 250px;margin:10%;border:solid;border-color:black;"><img src="<?php echo base_url() ?>/public/images/plus.png" alt="Avatar" class="img-top img-cardTemp"></a>
                                <?php else : ?>
                                    <a href="<?php echo base_url() ?>/preupload" tabindex="-1" aria-disabled="true"><img src="<?php echo base_url() . $file ?>" alt="Avatar" class="img-fluid my-5 elem" style="width: 250px;margin:10%;border:solid;border-color:black;"><img src="<?php echo base_url() ?>/public/images/plus.png" alt="Avatar" class="img-top img-cardTemp"></a>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Información</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Correo Electrónico</h6>
                                        <?php if ($Per_email == NULL) : ?>
                                            <a href="<?php echo base_url() ?>/changeemail" tabindex="-1" aria-disabled="true">
                                                <p class="text-muted">Haga click para registrar correo. </p>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?php echo base_url() ?>/editemail" tabindex="-1" aria-disabled="true">
                                                <p class="text-muted"><?php echo $Per_email ?></p>
                                            </a>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Código Personal</h6>
                                        <p class="text-muted"><?php echo $Per_cod ?></p>
                                    </div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Área Laboral</h6>
                                        <p class="text-muted"><?php switch ($S_Per_tipo) {
                                                                    case 1:
                                                                        echo "SALUD";
                                                                        break;
                                                                    case 2:
                                                                        echo "TÉCNICO";
                                                                        break;
                                                                    case 3:
                                                                        echo "LIMPIEZA";
                                                                        break;
                                                                } ?></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Nombre</h6>
                                        <p class="text-muted"><?php echo $nom_cuenta ?></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <?php if ($S_Per_tipo == 1) : ?>
                                        <div>Pacientes Atendidos: <?php if ($Op_queue == NULL || $Op_queue == 0) echo 0;
                                                                    else echo $Op_queue; ?></div>
                                    <?php elseif ($S_Per_tipo == 2) : ?>
                                        <div>Interacciones con el sistema efectuadas: <?php if ($Op_queue == NULL || $Op_queue == 0) echo 0;
                                                                                        else echo $Op_queue; ?></div>
                                    <?php elseif ($S_Per_tipo == 3) : ?>
                                        <div>Habitaciones Limpiadas: <?php if ($Op_queue == NULL || $Op_queue == 0) echo 0;
                                                                        else echo $Op_queue; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a style="float:right;" href="<?php echo base_url() ?>/passview" tabindex="-1" aria-disabled="true"> <button type="button" name="login" id="login" class="btn btn-primary btn-lg" style="margin-left:-46.5%; margin-top:50%; margin-bottom:-28%">Cambiar Contraseña</button></a>
    </div>
</section>
</container>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>