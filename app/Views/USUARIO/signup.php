<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div>
        <div style="margin-top:5%;margin-left:32.5%;background:white;width:495px;border-style:outset; border-width: 6px;border-color:beige; ">
            <div class="col">
                <h2 class="text-dark" style="text-align:center">Crear nueva cuenta</h2>
                <?php if (isset($validation)) : ?>
                    <div class="alert alert-warning">
                        <?= $validation->listErrors() ?>
                        <span class="close">&times;</span>
                    </div>
                <?php endif; ?>
                <form action="<?php base_url(); ?>/SISTEMA_CLINICA/SignupController/store" method="post">
                    <div class="form-group mb-3">
                        <input type="text" name="nom_cuenta" placeholder="Nombre" value="<?= set_value('nom_cuenta') ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="Per_cod" placeholder="Código Personal" value="<?= set_value('Per_cod') ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    // Get all elements with class="close"
var closebtns = document.getElementsByClassName("close");
var i;

// Loop through the elements, and hide the parent, when clicked on
for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>