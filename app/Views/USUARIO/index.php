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
  .box {
    border: 2px solid black;
    margin-left: 2.5%;
    margin-right: 2.5%;
    margin-top: 40px;
    float: left;
    width: 18rem;
    height: 13rem;
    padding: 10px;
  }

  #img1 {
    width: 50px;
    height: 50px;
    float: left;
  }
</style>

<body>
  <div class="container w-50  justify-content-center align-items-center">
    <?php if($S_Per_tipo != NULL):?>
    <div class="col-xs-1-12">
      <div class="row">
        <div class="box h-50 bg-light" style="width: 85%;">
          <div class="box-body">
            <h5 class="card-tittle">Registro de Operaciones</h5>
            <p class="card-text">Siendo, Médico, Técnico o Trabajador de Aseo, registre cuando se estime conveniente.</p>
            <a href="<?php echo base_url() ?>/commitOp" class="btn btn-primary">Ir</a>
          </div>
        </div>
      </div>
    </div>
    <?php endif ?>
    <div class="col-xs-1-12">
      <div class="row">
        <div class="box h-50 bg-light" style="width: 40%;">
          <div class="card-img-top w-50 h-50">
            <img class="card-img-top w-50 h-50" src="<?php echo base_url() ?>/public/images/hz.png" alt="Card image cap">
          </div>

          <div class="box-body">
            <h5 class="card-title">Hardzone.com</h5>
            <p class="card-text">Haga click en el boton para visitar.</p>
            <a href="https://hardzone.es/" target="_blank" class="btn btn-primary">Ir</a>
          </div>
        </div>
        <div class="box h-50 bg-light" style="width: 40%;">
          <div class="card-img-top w-50 h-50">
            <img class="card-img-top w-50 h-50" src="<?php echo base_url() ?>/public/images/xataa.jfif" alt="Card image cap">
          </div>
          <div class="box-body ">
            <h5 class="card-tittle">Xataka.com</h5>
            <p class="card-text">Haga click en el boton para visitar.</p>
            <a href="https://www.xataka.com/tablets/lenovo-tab-p11-p11-pro-caracteristicas-precio-especificaciones" target="_blank" class="btn btn-primary">Ir</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-1-12">
      <div class="row">
        <div class="box h-50 bg-light" style="width: 40%;">
          <div class="card-img-top w-50 h-50">
            <img class="card-img-top w-50 h-50" src="<?php echo base_url() ?>/public/images/Robot.png" alt="Card image cap">
          </div>
          <div class="box-body">
            <h5 class="card-title">Artículo de Alzheimer</h5>
            <p class="card-text">Haga click en el boton para visitar.</p>
            <a href="https://www.robotitus.com/hallan-mas-evidencia-de-como-dos-virus-se-unen-para-causar-alzheimer" target="_blank" class="btn btn-primary">Ir</a>
          </div>
        </div>
        <div class="box h-50 bg-light" style="width: 40%;">
          <div class="card-img-top w-50 h-50">
            <img class="card-img-top w-50 h-50" src="<?php echo base_url() ?>/public/images/Robot.png" alt="card image cap">
          </div>
          <div class="box-body">
            <h5 class="card-tittle">Artículo de investigación</h5>
            <p class="card-text">Haga click en el boton para visitar.</p>
            <a href="https://www.robotitus.com/esta-bacteria-se-esta-volviendo-tan-resistente-a-los-antibioticos-que-no-podremos-detenerla"  target="_blank" class="btn btn-primary">Ir</a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>