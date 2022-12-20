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
      <h1>Ingresar Personal</h1>
      <form action="<?php echo base_url() . '/VerStaff/editar/post' ?>" method="post">
        <div class="row mb-4">
          <div class="col">
            <div class='form-group'>
              <label>Nombre</label>
              <input type="text" name="Per_nom" class='form-control' value=<?php echo $data['Per_nom'] ?>>
              <input name="Per_cod" type="hidden" value="<?php echo $data['Per_cod'] ?>">
            </div>
          </div>
          <div class="col">
            <div class='form-group'>
              <label>Edad</label>
              <input type="text" name="Per_edad" class='form-control' value=<?php echo $data['Per_edad'] ?>>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col">
            <div class='form-group'>
              <label>Género</label>
              <div class="form-group">
                <select class="form-control form-control-sm" name="Per_gen">
                  <?php if ($data['Per_gen'] == 'M') : ?>
                    <option>Elegir Género</option>
                    <option selected value="M">M</option>
                    <option value="F">F</option>
                    <option value="O">O</option>
                  <?php elseif ($data['Per_gen'] == 'F') : ?>
                    <option>Elegir Género</option>
                    <option value="M">M</option>
                    <option selected value="F">F</option>
                    <option value="O">O</option>
                  <?php elseif ($data['Per_gen'] == 'O') : ?>
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
          <div class="col">
            <div class='form-group'>
              <label>Tipo</label>
              <select class="form-control form-control-sm" name="Per_tipo" id="Per_tipo">
                <option>Elegir Tipo de Personal</option>
                <?php foreach ($listaPersonal as $item) : ?>
                  <td>
                    <?php if ($data['Per_tipo'] == $item['tipo_cod']) : ?>
                      <option selected value="<?php echo $item['tipo_cod']; ?>"><?php echo $item['tipo_nom']; ?></option>
                    <?php else : ?>
                      <option value="<?php echo $item['tipo_cod']; ?>"><?php echo $item['tipo_nom']; ?></option>
                    <?php endif ?>
                  </td>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div id="container" class='form-group' style="margin-top:-4%;margin-bottom:15%">
          <label id="text-especialidad">Especialidad</label>
          <input type="text" name="Per_espec" value="<?php echo $data['Per_espec'];?>"id="Per_espec" class='form-control'>
        </div>
        <?php if($data['Per_espec'] != NULL):?>
          <div class='form-group' style="margin-top:-5%;margin-bottom:-5%">
          <input type="submit" name="ingreso" value=Ingresar class='btn btn-primary' style="margin-top:-8%">
        </div>
        <?php else:?>
          <div class='form-group' style="margin-top:-7%;margin-bottom:-5%">
          <input type="submit" name="ingreso" value=Ingresar class='btn btn-primary' style="margin-top:-8%">
        </div>
        <?php endif;?>
      </form>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
    var e = document.getElementById("Per_tipo");
    var tex = document.getElementById("Per_espec");
    var div = document.getElementById('container');
    var backup = tex.value;

    function onChange() {
      var text = e.options[e.selectedIndex].text;
      if (text == "SALUD") {
        div.style.visibility = 'visible';
        tex.value = backup;
       
      } else {
        if ((document.getElementById("text-especialidad") != null) && (document.getElementById("Per_espec") != null)) {
          tex.value = '';
          div.style.visibility = 'hidden';
        }
      }
    }
    e.onchange = onChange;
    onChange();
  </script>


</body>

</html>