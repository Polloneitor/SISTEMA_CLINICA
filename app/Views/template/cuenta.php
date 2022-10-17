<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<body style="background-image: url(<?php echo base_url() ?>/public/images/imagen_fondo2)">
    <div class="container">
        <container>
            <table id="tabla2" class="table table-bordered" style="width: 75%;margin-left:auto;margin-right:auto;margin-top: 20px;">
                <th scope="col" style="background-color: #F3F3F3;">Código de Cuenta</th>
                <th scope="col" style="background-color: #F3F3F3;">Nombre Cuenta</th>
                <th scope="col" style="background-color: #F3F3F3;">Código Personal</th>
                <th scope="col" style="background-color: #F3F3F3;">Tipo de Personal</th>
                </tr>
                </thead>
                <tbody class='table-group-divider'>
                    <td><?php echo $cod_cuenta ?></td>
                    <td><?php echo $nom_cuenta ?></td>
                    <td><?php echo $Per_cod ?></td>
                    <td><?php switch ($S_Per_tipo) {
                            case 1:
                                echo "SALUD";
                                break;
                            case 2:
                                echo "TÉCNICO";
                                break;
                            case 3:
                                echo "LIMPIEZA";
                                break;
                        } ?></td>
                </tbody>
            </table>
            <a href="<?php echo base_url() ?>/changepass" tabindex="-1" aria-disabled="true"> <button type="button" name="login" id="login" class="btn btn-primary btn-lg">Cambiar Contraseña</button></a>
        </container>
    </div>
</body>

</html>