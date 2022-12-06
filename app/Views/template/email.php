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
        <div style="width: 75%;margin-left:auto;margin-right:auto;margin-top: 20px;">
            <h1>Ingresar Personal</h1>
            <form action="<?php echo base_url()?>/editingMail" method="post">
                <div class="row mb-4">
                    <div class="col">
                        <div class='form-group'>
                            <label>Personal: <?php echo $Per_nom ?>, registre su correo</label>
                            <input class='form-control' name="Per_email" type="text" value="<?php if ($Per_email != NULL) {
                                                                                                echo $Per_email;
                                                                                            }; ?>">
                        </div>
                    </div>
                    <div class='form-group'>
                        <input type="submit" name="ingreso" value=Ingresar class='btn btn-primary'>
                    </div>
            </form>
        </div>
    </div>