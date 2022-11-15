<!DOCTYPE html>
<style>
    .back{
        background-color: black;
    }
</style>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
    <div>
        <h5>¿Desea modificar al personal?</h5>
        <button><a href="<?php echo base_url() . '/VerStaff/editar/' . $target ?>">Editar</a></button>
        <button><a href="<?php echo base_url() . '/VerStaff'?>">Volver</a></button>
    </div>
</body>
</html>