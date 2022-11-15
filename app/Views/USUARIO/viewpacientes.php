<!doctype html>
<html lang="en">

<head>
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
  <div class="container" style="margin-top:1%;background: rgba(0, 133, 255, 0.65);">
    <table id="tabla" class="table table-bordered" style="width: 75%;margin-left:auto;margin-right:auto;margin-top: 20px;">
      <thead>
        <tr>
          <th scope="col" style="background-color: #F3F3F3;">Nombre</th>
          <th scope="col" style="background-color: #F3F3F3;">Edad</th>
          <th scope="col" style="background-color: #F3F3F3;">Género</th>
          <th scope="col" style="background-color: #F3F3F3;">Rut</th>
          <?php if ($S_Per_tipo == 2) : ?>
            <th scope="col" style="background-color: #F3F3F3;">Modificar</th>
            <th scope="col" style="background-color: #F3F3F3;">Borrar</th>
          <?php endif ?>
        </tr>
      </thead>
      <tbody class='table-group-divider' style="background-color:#FFFFFF;">
        <?php foreach ($listaPacientes as $item) : ?>
          <tr><?php if ($S_Per_tipo == 2) : ?>
              <td><?php echo $item['Pac_nom']; ?></td>
              <td><?php echo $item['Pac_edad']; ?></td>
              <td><?php echo $item['Pac_gen']; ?></td>
              <td><?php echo $item['Pac_rut'];  ?></td>
              <td><a href="<?php echo base_url() . '/VerPacientes/editar/question/' . $item['Pac_rut'] ?>">Modificar</a></td>
              <td><a href="<?php echo base_url() . '/VerPacientes/eliminar/question/' . $item['Pac_rut'] ?>">Borrar</a></td>
            <?php else : ?>
              <td><?php echo $item['Pac_nom']; ?></td>
              <td><?php echo $item['Pac_edad']; ?></td>
              <td><?php echo $item['Pac_gen']; ?></td>
              <td><?php echo $item['Pac_rut']; ?></td>
            <?php endif ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tabla').DataTable({
        scrollY: 200,
        deferRender: true,
        scroller: true,
        "language": {
          "aria": {
            "sortAscending": ": orden ascendente",
            "sortDescending": ": orden descendente"
          },
          "autoFill": {
            "cancel": "Cancelar",
            "fill": "Llenar todas las celdas con <i>%d&lt;\\\/i&gt;<\/i>",
            "fillHorizontal": "Llenar celdas horizontalmente",
            "fillVertical": "Llenar celdas verticalmente"
          },
          "buttons": {
            "collection": "Colección <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
            "colvis": "Visibilidad de la columna",
            "colvisRestore": "Restaurar visibilidad",
            "copy": "Copiar",
            "copyKeys": "Presiona ctrl or u2318 + C para copiar los datos de la tabla al portapapeles.<br \/><br \/>Para cancelar, haz click en este mensaje o presiona esc.",
            "copySuccess": {
              "_": "Copió %ds registros al portapapeles",
              "1": "Copió un registro al portapapeles"
            },
            "copyTitle": "Copiado al portapapeles",
            "csv": "CSV",
            "excel": "Excel",
            "pageLength": {
              "_": "Mostrar %ds registros",
              "-1": "Mostrar todos los registros"
            },
            "pdf": "PDF",
            "print": "Imprimir"
          },
          "datetime": {
            "amPm": [
              "AM",
              "PM"
            ],
            "hours": "Horas",
            "minutes": "Minutos",
            "months": {
              "0": "Enero",
              "1": "Febrero",
              "10": "Noviembre",
              "11": "Diciembre",
              "2": "Marzo",
              "3": "Abril",
              "4": "Mayo",
              "5": "Junio",
              "6": "Julio",
              "7": "Agosto",
              "8": "Septiembre",
              "9": "Octubre"
            },
            "next": "Siguiente",
            "previous": "Anterior",
            "seconds": "Segundos",
            "weekdays": [
              "Dom",
              "Lun",
              "Mar",
              "Mie",
              "Jue",
              "Vie",
              "Sab"
            ]
          },
          "decimal": ",",
          "editor": {
            "close": "Cerrar",
            "create": {
              "button": "Nuevo",
              "submit": "Crear",
              "title": "Crear nuevo registro"
            },
            "edit": {
              "button": "Editar",
              "submit": "Actualizar",
              "title": "Editar registro"
            },
            "error": {
              "system": "Ocurrió un error de sistema (&lt;a target=\"\\\" rel=\"nofollow\" href=\"\\\"&gt;Más información)."
            },
            "multi": {
              "info": "Los elementos seleccionados contienen diferentes valores para esta entrada. Para editar y configurar todos los elementos de esta entrada con el mismo valor, haga clic o toque aquí, de lo contrario, conservarán sus valores individuales.",
              "noMulti": "Esta entrada se puede editar individualmente, pero no como parte de un grupo.",
              "restore": "Deshacer cambios",
              "title": "Múltiples valores"
            },
            "remove": {
              "button": "Eliminar",
              "confirm": {
                "_": "¿Está seguro de que desea eliminar %d registros?",
                "1": "¿Está seguro de que desea eliminar 1 registro?"
              },
              "submit": "Eliminar",
              "title": "Eliminar registro"
            }
          },
          "emptyTable": "Sin registros",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 a 0 de 0 registros",
          "infoFiltered": "(filtrado de _MAX_ registros)",
          "infoThousands": ".",
          "lengthMenu": "Mostrar _MENU_ registros",
          "loadingRecords": "Cargando...",
          "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
          },
          "processing": "Procesando...",
          "search": "Buscar:",
          "searchBuilder": {
            "add": "Agregar Condición",
            "button": {
              "_": "Filtros (%d)",
              "0": "Filtrar"
            },
            "clearAll": "Limpiar Todo",
            "condition": "Condición",
            "conditions": {
              "array": {
                "contains": "Contiene",
                "empty": "Vacío",
                "equals": "Igual",
                "not": "Distinto",
                "notEmpty": "No vacío",
                "without": "Sin"
              },
              "date": {
                "after": "Mayor",
                "before": "Menor",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual",
                "not": "Distinto",
                "notBetween": "No entre",
                "notEmpty": "No vacío"
              },
              "number": {
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual",
                "gt": "Mayor",
                "gte": "Mayor o igual",
                "lt": "Menor",
                "lte": "Menor o igual",
                "not": "Distinto",
                "notBetween": "No entre",
                "notEmpty": "No vacío"
              },
              "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina con",
                "equals": "Igual",
                "not": "Distinto",
                "notEmpty": "No vacío",
                "startsWith": "Comienza con"
              }
            },
            "data": "Datos",
            "deleteTitle": "Eliminar regla de filtrado",
            "leftTitle": "Filtros anulados",
            "logicAnd": "Y",
            "logicOr": "O",
            "rightTitle": "Filtro",
            "title": {
              "_": "Filtros (%d)",
              "0": "Filtrar"
            },
            "value": "Valor"
          },
          "searchPanes": {
            "clearMessage": "Limpiar todo",
            "collapse": {
              "_": "Paneles de búsqueda (%d)",
              "0": "Paneles de búsqueda"
            },
            "count": "{total}",
            "countFiltered": "{shown} ({total})",
            "emptyPanes": "Sin paneles de búsqueda",
            "loadMessage": "Cargando paneles de búsqueda...",
            "title": "Filtros activos - %d"
          },
          "select": {
            "cells": {
              "_": "%d celdas seleccionadas",
              "1": "Una celda seleccionada"
            },
            "columns": {
              "_": "%d columnas seleccionadas",
              "1": "Una columna seleccionada"
            },
            "rows": {
              "1": "Una fila seleccionada",
              "_": "%d filas seleccionadas"
            }
          },
          "thousands": ".",
          "zeroRecords": "No se encontraron registros"
        }
      });
    });
  </script>
</body>

</html>