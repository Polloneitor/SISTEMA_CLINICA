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
            <form action="<?php echo base_url() ?>/commitOp/Send" method="post">
                <?php if ($S_Per_tipo == 1) : ?>
                    <h1>Atención Médica.</h1>
                    <div class='form-group'>
                        <label>Pacientes Registrados</label>
                        <select class="form-control form-control-sm" name="Pac_nom" id="Pac_nom">
                            <option selected value="">Eligir Paciente</option>
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
                            <option value="" selected>Elegir Ala.</option>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>