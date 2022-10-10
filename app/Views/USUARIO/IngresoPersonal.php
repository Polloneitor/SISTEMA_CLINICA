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
    .head{
        background-color: black;
        color: white;
        border: 4px solid black;
        margin: 20px;
        padding: 20px;
    }
  </style>
  <body style="background-color:white">
    <div style="width: 75%;margin-left:auto;margin-right:auto;margin-top: 20px;">
      <h1>Ingresar Personal</h1>
      <form action=/SISTEMA_CLINICA/FormaControlador/insertarPersonal method="post">
      <div class = 'form-group'>
        <label>Nombre</label>
        <input type="text" name="Per_nom" class='form-control'>
      </div>
      <div class = 'form-group'>
        <label>Edad</label>
        <input type="text" name="Per_edad" class='form-control'>
      </div>
      <div class = 'form-group'>
        <label>Género</label>
        <select class="form-select" aria-label="Default select example" name="Per_gen">
          <option selected>Elegir Género</option>
          <option value="M">M</option>
          <option value="F">F</option>
          <option value="O">O</option>
        </select>
      </div>
      <div class = 'form-group'>
        <label>Tipo</label>
        <select class="form-select" aria-label="Default select example" name="Per_tipo" id="Per_tipo">
        <option selected>Elegir Tipo de Personal</option>
        <?php foreach($listaPersonal as $item): ?>
        <td>
          <option value="<?php echo $item['tipo_cod'];?>"><?php echo $item['tipo_nom'];?></option>
        </td>
        <?php endforeach;?>
        </select>
      </div>
      <div id="container">
      </div>
      <div class = 'form-group'>
        <input type="submit" name="ingreso" value=Ingresar class='btn btn-primary'>
      </div>
      </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
    Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
    }
    NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
        for(var i = this.length - 1; i >= 0; i--) {
            if(this[i] && this[i].parentElement) {
                this[i].parentElement.removeChild(this[i]);
            }
        }
    }
    var e = document.getElementById("Per_tipo");
    function onChange() {
      var text = e.options[e.selectedIndex].text;
      if(text == "SALUD"){
        var label = document.createElement("label");
        label.innerHTML = "Especialidad: "
        label.htmlFor = "Especialidad";
        label.id = "text-especialidad"
        var input = document.createElement("input");
        input.name = "especialidad";
        input.id = "Per_espec";
        document.getElementById("container").appendChild(label).appendChild(input);
      }else
      {
        if((document.getElementById("text-especialidad") != null) && (document.getElementById("Per_espec") != null)){
          document.getElementById("text-especialidad").remove();
          document.getElementById("Per_espec").remove();
        }
      }
    }
    e.onchange = onChange;
    onChange();

  </script>
    
    
  </body>
</html>