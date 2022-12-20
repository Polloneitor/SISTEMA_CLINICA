<!DOCTYPE html>
<html lang="en">
<head>
	<title id="Description">QRcode basic demo.</title>
	<link rel="stylesheet" href="<?php echo base_url()?>/public/QR/jqwidgets/styles/jqx.base.css" type="text/css" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />
	<script type="text/javascript" src="<?php echo base_url()?>/public/QR/jqwidgets/jqxcore.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>/public/QR/jqwidgets/jqxbarcode.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>/public/QR/jqwidgets/jqxqrcode.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>/public/QR/jqwidgets/jqxbuttons.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>/public/QR/scripts/demos.js"></script>
	<script type="text/javascript">
		window.onload = function () {
			// create QR code
			const qrcode = new jqxQRcode("#qrcode", {
				displayLabel: true,
				labelPosition: 'bottom',
				labelFontSize: 10,
				value: '<?php echo base_url()?>/infoPer/QR/<?php echo $Per_cod?>'});
		}
	</script>
</head>

<body>
	<h2 style="text-align: center;margin-top:5%">¡Escaneame!</h2>
	<div id="qrcode" style="margin-left: 39.1%; margin-top:5%"></div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>