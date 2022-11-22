<!DOCTYPE html>
<html lang="en">
<head>
	<title id="Description">QRcode basic demo.</title>
	<link rel="stylesheet" href="../../../jqwidgets/styles/jqx.base.css" type="text/css" />
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
	<div id="qrcode" style="margin-left: 10%; margin-top:5%"></div>
</body>
</html>