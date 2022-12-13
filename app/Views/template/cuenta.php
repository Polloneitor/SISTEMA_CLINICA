<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<section class="vh-50">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-10 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <?php if ($file == NULL) : ?>
                                <a href="<?php echo base_url() ?>/preupload" tabindex="-1" aria-disabled="true"><img src="<?php echo base_url() ?>/public/images/default.png" alt="Avatar" class="img-fluid my-5" style="width: 100%;margin:10%;"></a>
                            <?php else : ?>
                                <a href="<?php echo base_url() ?>/preupload" tabindex="-1" aria-disabled="true"><img src="<?php echo base_url().$file ?>" alt="Avatar" class="img-fluid my-5" style="width: 100%;margin:10%;"></a>
                            <?php endif ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Información</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Correo Electrónico</h6>
                                        <?php if ($Per_email == NULL) : ?>
                                            <a href="<?php echo base_url() ?>/changeemail" tabindex="-1" aria-disabled="true"><p class="text-muted">Haga click para registrar correo. </p></a>
                                        <?php else : ?>
                                            <a href="<?php echo base_url() ?>/editemail" tabindex="-1" aria-disabled="true"><p class="text-muted"><?php echo $Per_email ?></p></a>
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
        <a style="float:right;" href="<?php echo base_url() ?>/passview" tabindex="-1" aria-disabled="true"> <button type="button" name="login" id="login" class="btn btn-primary btn-lg">Cambiar Contraseña</button></a>
    </div>
</section>
</container>
</div>
</body>

</html>