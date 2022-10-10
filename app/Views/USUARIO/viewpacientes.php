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
  <container>
      <table id="tabla2" class="table table-bordered" style="width: 75%;margin-left:auto;margin-right:auto;margin-top: 20px;">
                  <th scope="col" style="background-color: #F3F3F3;">Nombre</th>
                  <th scope="col" style="background-color: #F3F3F3;">Edad</th>
                  <th scope="col" style="background-color: #F3F3F3;">Género</th>
                  <th scope="col" style="background-color: #F3F3F3;">Rut</th>
                  <?php if($S_Per_tipo == 2):?>
                    <th scope="col" style="background-color: #F3F3F3;">Modificar</th>
                    <th scope="col" style="background-color: #F3F3F3;">Borrar</th>
                  <?php endif ?>
              </tr>
          </thead>
          <tbody class='table-group-divider'>
              <?php foreach ($listaPacientes as $item):?>
                  <tr><?php if($S_Per_tipo == 2):?>
                      <td><?php echo $item['Pac_nom'];?></td>
                      <td><?php echo $item['Pac_edad'];?></td>
                      <td><?php echo $item['Pac_gen'];?></td>
                      <td><?php echo $item['Pac_rut'];?></td>
                      <?php else:?>
                      <td><?php echo $item['Pac_nom'];?></td>
                      <td><?php echo $item['Pac_edad'];?></td>
                      <td><?php echo $item['Pac_gen'];?></td>
                      <td><?php echo $item['Pac_rut'];?></td>
                      <td><?php echo 'Cambiar';?></td>
                      <td><?php echo 'X';?></td>
                      <?php endif?>
                  </tr>
              <?php endforeach;?>
          </tbody>
      </table>
  </container>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready( function () {
      $('#tabla2').DataTable();
    } );
    </script>
  </body>
</html>