<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="/SISTEMA_CLINICA/AccountData/changepass" method="post">
      <div class = 'form-group'>
        <label>Contraseña Original</label>
        <input type="text" name="OldPass" class='form-control'>
      </div>
      <div class = 'form-group'>
        <label>Contraseña Nueva</label>
        <input type="text" name="NewPass" class='form-control'>
      </div>
      <div class = 'form-group'>
        <label>Confirmar Contraseña Nueva</label>
        <input type="text" name="ConfirmMewPass" class='form-control'>
      </div>
      <div class = 'form-group'>
        <input type="submit" name="ingreso" value=Ingresar class='btn btn-primary'>
      </div>
      </form>
</body>
</html>