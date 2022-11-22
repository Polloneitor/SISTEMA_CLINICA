<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Codeigniter Google Pie Charts Demo</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body>

	<body>
		<div style="background-color:antiquewhite;margin-top:3%;margin-left:32%;width:455px">
			<div>
				<canvas id="myChart" width="450" height="400"></canvas>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.esm.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.mjs"></script>


		<script>
			const ctx = document.getElementById('myChart');

			new Chart(ctx, {
				type: 'pie',
				data: {
					labels: ['SALUD', 'TECNICO', 'LIMPIEZA'],
					datasets: [{
						label: 'Cantidad de Personal por área',
						data: [<?php foreach ($SALUD as $data) {
									echo $data;
								} ?>, <?php foreach ($TECNICO as $data) {
													echo $data;
												} ?>, <?php foreach ($LIMPIEZA as $data) {
															echo $data;
														} ?>],
						backgroundColor: ['#FF2828', '#9BD0F5', '#6CFF00']
					}]
				},
				options: {
					hoverBorderColor:'#000000',
					animation: {
						duration: 1500,
						easing: 'easeInExpo'
					},
					responsive: false,
					scales: {
						y: {
							beginAtZero: false
						},
						x: {
							beginAtZero: false
						}
					},
				}
			});
		</script>
	</body>

</html>