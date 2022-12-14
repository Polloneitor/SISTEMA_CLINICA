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
<div class="container" style="background: rgba(0, 133, 255, 0.65);border-style: outset; border-width:8px;margin-top:2.5%;">
    <div style="width: 75%;margin-left:auto;margin-right:auto;margin-top: 25px;margin-bottom:2.5%;">
      <h1>Ingresar Paciente</h1>
      <form action="<?php echo base_url() . '/VerPacientes/editar/post' ?>" method="post">
        <div class='form-group'>
          <label>Rut</label>
          <input type="text" id="disabledInput" disabled value="<?php echo $data['Pac_rut'] ?>" name="disabled" class='form-control'>
          <input name="Pac_rut" type="hidden" value="<?php echo $data['Pac_rut'] ?>">
        </div>
        <div class="row mb-4">
          <div class="col">
            <div class='form-group'>
              <label>Nombre</label>
              <input type="text" value="<?php echo $data['Pac_nom'] ?>" name="Pac_nom" class='form-control'>
            </div>
          </div>
          <div class="col">
            <div class='form-group'>
              <label>Edad</label>
              <input type="text" value="<?php echo $data['Pac_edad'] ?>" name="Pac_edad" class='form-control'>
            </div>
          </div>
          <div class="col">
            <div class='form-group'>
              <label>Género</label>
              <div class="form-group">
                <select class="form-control form-control-sm" name="Pac_gen">
                  <?php if ($data['Pac_gen'] == 'M') : ?>
                    <option>Elegir Género</option>
                    <option selected value="M">M</option>
                    <option value="F">F</option>
                    <option value="O">O</option>
                  <?php elseif ($data['Pac_gen'] == 'F') : ?>
                    <option>Elegir Género</option>
                    <option value="M">M</option>
                    <option selected value="F">F</option>
                    <option value="O">O</option>
                  <?php elseif ($data['Pac_gen'] == 'O') : ?>
                    <option>Elegir Género</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                    <option selected value="O">O</option>
                  <?php else : ?>
                    <option selected>Elegir Género</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                    <option value="O">O</option>
                  <?php endif ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class='form-group'>
          <input type="submit" name="ingreso" value=Editar class='btn btn-primary' style="margin-top:-5%">
        </div>
      </form>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>