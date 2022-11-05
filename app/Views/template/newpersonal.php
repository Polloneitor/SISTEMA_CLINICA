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
    <div class="container" style="float:left;">
        <h1>Nuevo personal creado, código: <?php echo $Per_cod; ?></h1>
        <li>Nombre: <?php echo $Per_nom ?></li>
        <li>Área de Trabajo: <?php switch ($Per_tipo) {
                                    case 1:
                                        echo "SALUD";
                                        break;
                                    case 2:
                                        echo "TÉCNICO";
                                        break;
                                    case 3:
                                        echo "LIMPIEZA";
                                        break;
                                } ?></li>
        <?php if ($Per_espec != null) : ?>
            <li>Especialidad: <?php echo $Per_espec ?></li>
        <?php endif ?>
        <a href='<?php echo base_url() ?>/index'>
            <h1>--->Ir a indice<---</h1>
            <img src="<?php echo base_url() ?>/public/images/jarjar.gif" alt="bailajarjar" name="image" id="image">
        </a>
    </div>
</body>

</html>