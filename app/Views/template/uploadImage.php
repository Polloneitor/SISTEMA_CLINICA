<!DOCTYPE html>
<html lang="en">

<style>
  .btn {
    width: 20%;
    background: #3281E8;
  }
</style>


<body>
  <div class="row" style="margin-left:15%;margin-top:4.5%;margin-bottom:-4%;">
    <div class="col">
      <?php

      use App\Models\T_Cuenta;

      $db = \Config\Database::connect();
      $session = session();
      $cod = $session->get('cod_cuenta');
      $user = new T_Cuenta($db);
      $result = $user->find($cod);
      if ($result == NULL) {
        $file['file'] = NULL;
      } else {
        $file['file'] = $result['file'];
      };
      if ($file['file'] == NULL) :
      ?>
        <img src="<?php echo base_url() ?>/public/images/default.png" width="200px" height="200" style="border:solid;margin-left:27%">

      <?php else : ?>
        <img src="<?php echo base_url() . $file['file'] ?>" width="200px" height="200" style="border:solid;margin-left:27%">

      <?php endif ?>
    </div>
    <div class="col">
      <img src="<?php echo base_url() ?>/public/images/arrow.png" style="width:200px;height:200px;">
    </div>
    <div class="col">
      <img src="<?php echo base_url() ?>/public/images/question.png" style="width:200px;height:200px;margin-left:-35%">
    </div>
    <div class="container" style="width:50%">
      <?php foreach ($errors as $error) : ?>
        <li><?= esc($error) ?></li>
      <?php endforeach ?>
      <?= form_open_multipart('/upload/upload') ?>
      <div class="row" style="margin-left:-13.5%;margin-top:5%">
        <div class="col" style="margin-right:8%;margin-left:-3%">
          <div class="form-group">
            <input type="file" name="userfile" size="20" class='btn btn-primary' style="width:134%; margin-left:-44%">
          </div>
        </div>
        <div class="col">
          <input type="submit" value="Subir" class='btn btn-primary' style="width:120%;height:73%;margin-left:-19%">
        </div>
      </div>
      </form>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>