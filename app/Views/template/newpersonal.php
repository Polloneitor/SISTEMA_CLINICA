<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<body>
    <div class="container">
        <div style="border-style:inset;margin-left:12%;margin-right:-5%;margin-top:8%;width:75%; background-color:white">
            <div class="row">
                <h1 style="margin-left:13.5%">Nuevo personal creado, código: <?php echo $Per_cod; ?></h1>
            </div>
            <div class="row">
                <div class="col">
                    <h5 style="margin-left:13.5%">Nombre: <?php echo $Per_nom ?></h5>
                </div>
                <div class="col">
                    <h5>Área de Trabajo: <?php switch ($Per_tipo) {
                                                case 1:
                                                    echo "SALUD";
                                                    break;
                                                case 2:
                                                    echo "TÉCNICO";
                                                    break;
                                                case 3:
                                                    echo "LIMPIEZA";
                                                    break;
                                            } ?></h5>
                </div>
            </div>
            <?php if ($Per_espec != null) : ?>
                <div class="row" style="margin-left:6.5%">
                    <h5>Especialidad: <?php echo $Per_espec ?></h5>
                </div>
            <?php endif ?>
            <div class="row">
                <a href='<?php echo base_url() ?>/index' style="margin-left:8.2%">
                    <button class="btn btn-primary">Ir a indice</button>
                </a>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>