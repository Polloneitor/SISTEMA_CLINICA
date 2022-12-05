<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container" style="background: rgba(0, 133, 255, 0.65);">
        <div style="width: 75%;margin-left:auto;margin-right:auto;margin-top: 20px;">
            <?php if ($S_Per_tipo == 1) : ?>
                <h1>Atención Médica.</h1>
                <form action='<?php echo base_url() ?>/commitOp' method="post">
                    <div class='form-group'>
                        <label>Detalle(Opcional)</label>
                        <textarea name="Op_detalle" rows="10" cols="50">

                        </textarea>
                    </div>
                </form>
            <?php elseif ($S_Per_tipo == 2) : ?>
                <h1>Trabajo Técnico en Clínica.</h1>
                <form action='<?php echo base_url() ?>/commitOp' method="post">
                    <div class='form-group'>
                        <label>Especificar labor.</label>
                        <textarea name="Op_detalle" rows="10" cols="50">
                        </textarea>
                    </div>
                </form>
            <?php elseif ($S_Per_tipo == 3) : ?>
                <h1>Registro de Limpieza, especificar ala.</h1>
                <form action='<?php echo base_url() ?>/commitOp' method="post">
                    <div class='form-group'>
                        <label>Especificar labor.</label>
                        <select class="form-control form-control-sm" name="Op_detalle">
                            <option selected>Elegir Género</option>
                            <option value="Ala A">Ala A</option>
                            <option value="Ala B">Ala B</option>
                            <option value="Ala C">Ala C</option>
                        </select>
                    </div>
                </form>

            <?php endif; ?>
        </div>
    </div>
</body>

</html>