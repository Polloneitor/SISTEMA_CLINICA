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
            <form action="<?php echo base_url() ?>/VerStaff" method="post">
                <?php if ($S_Per_tipo == 1) : ?>
                    <h1>Atención Médica.</h1>
                    <div class='form-group'>
                        <label>Pacientes Registrados</label>
                        <select class="form-control form-control-sm" name="Pac_no" id="Per_tipo">
                            <option selected>Eligir Paciente</option>
                            <?php foreach ($listaPacientes as $item) : ?>
                                <td>
                                    <option value="<?php echo $item['Pac_nom']; ?>"><?php echo $item['Pac_nom']; ?></option>
                                </td>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class='form-group'>
                        <label>Detalle(Opcional)</label>
                        <textarea name="Op_detalle" rows="10" cols="50" class='form-control'></textarea>
                    </div>
                <?php elseif ($S_Per_tipo == 2) : ?>
                    <h1>Trabajo Técnico en Clínica.</h1>
                    <label>Especificar labor.</label>
                    <div class='form-group'>
                        <textarea name="Op_detalle" rows="10" cols="50" class='form-control'></textarea>
                    </div>
                <?php elseif ($S_Per_tipo == 3) : ?>
                    <h1>Registro de Limpieza</h1>
                    <div class='form-group'>
                        <label>Especificar Ala en la cual trabajó.</label>
                        <select class="form-control form-control-sm" name="Op_detalle">
                            <option selected>Elegir Ala.</option>
                            <option value="Ala A">Ala A</option>
                            <option value="Ala B">Ala B</option>
                            <option value="Ala C">Ala C</option>
                        </select>
                    </div>
                <?php endif; ?>
                <div class='form-group'>
                    <input type="submit" name="ingreso" value=Ingresar class='btn btn-primary'>
                </div>
            </form>
        </div>
    </div>

</body>

</html>