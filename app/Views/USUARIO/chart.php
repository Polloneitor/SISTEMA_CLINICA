<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Codeigniter Google Pie Charts Demo</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<style>
	.btnTemp {
		width: 20%;
		background: #3281E8;
		border-style: outset;
	}

	.sidebar {
		margin-left: 37%;
		margin-top: 1.5%;
	}
</style>

<body>

	<body>
		<div class="sidebar">
			<button id="1" class="btnTemp" style="background:#245DA8">Gráfica 1</button>
			<button id="2" class="btnTemp">Gráfica 2</button>
		</div>
		<div id="div1" style="background-color:antiquewhite;margin-top:3%;margin-left:32%;width:455px;border-style:groove;border-width:3px;">
			<div>
				<h3 style="text-align:center;">Cantidad de Personal por Área Laboral: </h3>
				<canvas id="myChart" width="450" height="400"></canvas>
			</div>
		</div>

		<div id="div2" style="background-color:antiquewhite;margin-top:3%;margin-left:32%;width:455px;display:none;border-style:groove;border-width:3px;">
			<div>
				<h3 style="text-align:center;">Cantidad de Operaciones por Área Laboral:</h3>
				<canvas id="myChart2" width="450" height="400"></canvas>
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
					hoverBorderColor: '#000000',
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

		<script>
			const ctx2 = document.getElementById('myChart2');

			new Chart(ctx2, {
				type: 'pie',
				data: {
					labels: ['SALUD', 'TECNICO', 'LIMPIEZA'],
					datasets: [{
						label: 'Cantidad de Personal por área',
						data: [<?php echo $SumSalud[0]['Op_queue'] ?>, <?php echo $SumTecnico[0]['Op_queue'] ?>, <?php echo $SumLimpieza[0]['Op_queue'] ?>],
						backgroundColor: ['#FF2828', '#9BD0F5', '#6CFF00']
					}]
				},
				options: {
					hoverBorderColor: '#000000',
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

			$("#1").click(function() {
				document.getElementById('1').style.cssText = 'width: 20%;background: #245DA8;border-style: inset;';
				var element = document.getElementById("div1");
				element.style.display = "block";
				document.getElementById('2').style.cssText = 'width: 20%;background: #3281E8;border-style: outset;';
				var element = document.getElementById("div2");
				element.style.display = "none";
				ctx.reset();
			});

			$("#2").click(function() {
				document.getElementById('2').style.cssText = 'width: 20%;background: #245DA8;border-style: inset;';
				var element = document.getElementById("div2");
				element.style.display = "block";
				document.getElementById('1').style.cssText = 'width: 20%;background: #3281E8;border-style: outset;';
				var element = document.getElementById("div1");
				element.style.display = "none";
				ctx2.reset();

			});
		</script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>

</html>