<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<body>
  <?php
  if ($firstlogin_cuenta == 0) :
  ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Ha iniciado por primera vez, por favor cambie su contraseña.</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif ?>
  <div class="container" style="background: rgba(0, 133, 255, 0.65);">
    <div style="width: 75%;margin-left:auto;margin-right:auto;margin-top: 20px;">
      <form action="/SISTEMA_CLINICA/AccountData/changepass" method="post" style="padding:5%">
        <div class="row">
          <div class='form-group'>
            <label>Contraseña Original</label>
            <input type="password" name="OldPass" class='form-control'>
          </div>
        </div>
        <div class="row">
          <div class='form-group'>
            <label>Contraseña Nueva</label>
            <input type="password" name="NewPass" class='form-control'>
          </div>
          <div class='form-group' style="margin-left: 30px;">
            <label>Confirmar Contraseña Nueva</label>
            <input type="password" name="ConfirmNewPass" class='form-control'>
          </div>
        </div>
        <div class="row">
          <div class='form-group'>
            <input type="submit" name="ingreso" value=Ingresar class='btn btn-primary'>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>