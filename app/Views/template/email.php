<!doctype html>
<html lang="en">

<head>
    <title>CLINICA</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    .head {
        background-color: black;
        color: white;
        border: 4px solid black;
        margin: 20px;
        padding: 20px;
    }
</style>

<body>
    <div class="container" style="background: rgba(0, 133, 255, 0.65);">
        <div style="width: 75%;margin-left:auto;margin-right:auto;margin-bottom: -65px;margin-top: 65px;">
            <h1>Registro de Correo Electrónico</h1>
            <form action="<?php echo base_url() ?>/editingMail" method="post">
                <div class="row mb-4">
                    <div class="col">
                        <div class='form-group'>
                            <label>Personal, <?php echo $Per_nom ?>, registre su correo</label>
                            <input class='form-control' name="Per_email" type="text" value="<?php if ($Per_email != NULL) {
                                                                                                echo $Per_email;
                                                                                            }; ?>">
                        </div>
                    </div>
                </div>
                <div class="row mb-4" style="margin-left:0.5px;  margin-top:-10.5px">
                    <div class='form-group'>
                        <input type="submit" name="ingreso" value=Ingresar class='btn btn-primary'>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>