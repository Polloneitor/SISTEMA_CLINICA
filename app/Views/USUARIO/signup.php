<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Codeigniter Auth User Registration Example</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <h2 class="text-light bg-dark">Crear nueva cuenta</h2>
                <?php if (isset($validation)) : ?>
                    <div class="alert alert-warning">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
                <form action="<?php base_url(); ?>/SISTEMA_CLINICA/SignupController/store" method="post">
                    <div class="form-group mb-3">
                        <input type="text" name="nom_cuenta" placeholder="Nombre" value="<?= set_value('nom_cuenta') ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="Per_cod" placeholder="Código Personal" value="<?= set_value('Per_cod') ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>