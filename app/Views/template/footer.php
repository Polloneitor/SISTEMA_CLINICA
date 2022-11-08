<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>
<style>
  #footer {
    width: 100%;
    height: 150px;
    float: left;
    margin-top: 9.5%;
    background: #2065BF;
    background-blend-mode: lighten;
  }

  .footertext {
    font-size: 1.2em;
    text-align: center;
    color: black;
    margin: 1.95%;
  }

  #img1 {
    width: 50px;
    height: 50px;
    float:left;
    padding: 1%;
  }
  
</style>

<body>
  <footer id="footer">
    <p class="footertext">Trabajo realizado desde la Universidad de Playa Ancha, Región de Valparaíso, Ciudad de San Felipe</p>
    <div style="width:25%;height:25%;float:right">
      <a href="https://bonzibuddy.tk/"><img id="img1" src="<?php echo base_url() ?>/public/images/bonzi.png"></a>
      <a href="https://www.youtube.com/"><img id="img1" src="<?php echo base_url() ?>/public/images/youtube.png"></a>
      <a href="https://www.instagram.com/"><img id="img1" src="<?php echo base_url() ?>/public/images/insta.png"></a>
      <a href="https://twitter.com/?lang=es"><img id="img1" src="<?php echo base_url() ?>/public/images/twitt.png"></a>
    </div>
  </footer>
</body>

</html>