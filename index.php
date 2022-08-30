<?php
require_once "php/conexion.php";
$result;
$device;

$sql = 'SELECT * FROM DATOS ORDER BY id DESC LIMIT 1 ';

$result = $conn->query($sql);

$rows = $result->fetchAll();

$sql2 = 'SELECT DISTINCT device,id FROM DATOS GROUP BY device desc ';

$result2 = $conn->query($sql2);

$rows2 = $result2->fetchAll();



?>
<!DOCTYPE html>
<html>

<head>
	<title>Graficos con plotly</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.3.1.min.js"></script>
	<script src="librerias/plotly-latest.min.js"></script>
	<style>
		#circle {
			margin-top: -100px;
			background-color: green;
			border-radius: 50%;
			width: 100px;
			height: 100px;
			margin-left: 975px;
		}

		#circle2 {
			margin-top: -100px;
			background-color: yellow;
			border-radius: 50%;
			width: 100px;
			height: 100px;
			margin-left: 975px;
		}

		#circle3 {
			margin-top: -80px;
			background-color: red;
			border-radius: 50%;
			width: 100px;
			height: 100px;
			margin-left: 975px;

		}

		.parpadea {

			animation-name: parpadeo;
			animation-duration: 1s;
			animation-timing-function: linear;
			animation-iteration-count: infinite;

			-webkit-animation-name: parpadeo;
			-webkit-animation-duration: 1s;
			-webkit-animation-timing-function: linear;
			-webkit-animation-iteration-count: infinite;
		}

		@-moz-keyframes parpadeo {
			0% {
				opacity: 1.0;
			}

			50% {
				opacity: 0.0;
			}

			100% {
				opacity: 1.0;
			}
		}

		@-webkit-keyframes parpadeo {
			0% {
				opacity: 1.0;
			}

			50% {
				opacity: 0.0;
			}

			100% {
				opacity: 1.0;
			}
		}

		@keyframes parpadeo {
			0% {
				opacity: 1.0;
			}

			50% {
				opacity: 0.0;
			}

			100% {
				opacity: 1.0;
			}
		}

		

		

		.content-select select {
			width: 20%;
			cursor: pointer;
			padding: 5px 8px;
			height: 42px;
			outline: 0;
			border: 0;
			border-radius: 0;
			background: #f0f0f0;
			color: #7b7b7b;
			font-size: 1em;
			color: #999;
			font-family:
				'Quicksand', sans-serif;
			border: 2px solid rgba(0, 0, 0, 0.2);
			border-radius: 12px;
			transition: all 0.25s ease;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel panel-heading text-center">
						Graficas con plotly
					</div>
					<div class="panel panel-body">
						<div class="row">
							<div class="col-sm-12">
								<div id="" class="col-sm-12 content-select">
									<button id="BTNTODO" type="button" class="btn btn-secondary active"> TODO</button>
									<button id="BTNHUM" type="button" class="btn btn-secondary active"> HUMEDAD</button>
									<button id="BTNTEM" type="button" class="btn btn-secondary active"> TEMPERATURA</button>
									<button id="BTNCO2" type="button" class="btn btn-secondary active"> CO2</button>
									<select name="device" id="device">
										<option value="0">Seleccione:</option>
										<?php
										foreach ($rows2 as $row2) {
										?>
											<option value="<?php echo $row2['id']; ?>"> DISPOSITIVO <?php echo $row2['device']; ?></option>;

										<?php } ?>
									</select>
									<button id="BTNDEVICE" type="button" class="btn btn-success active"> SEND</button>

								</div>
							</div>

							<div id="TEM" style=" width: 1120px;" class="col-sm-12">
								<div id="cargaTemperatura" class="col-sm-12"></div>
							</div>
							<div id="HUM" style=" width: 1120px;" class="col-sm-12">
								<div id="cargaHumedad" class="col-sm-12"></div>
							</div>
							<div id="CO" style=" width: 1120px;" class="col-sm-12">
								<div id="cargaco2" class="col-sm-10"></div>

								<?php
								foreach ($rows as $row) {
									$c = $row['CO2'];
									if ($c > 0 && $c < 300) {
										$c = "circle";
									} else if ($c > 300 && $c < 600) {
										$c = "circle2";
									} else if ($c > 599) {
										$c = "circle3";
									}
								?>

									<div style=" margin-top: 180px;
		 font-size:30px;"><?php echo $row['CO2']; ?></div>
									<div id='<?php echo $c; ?>' class="parpadea"></div>




								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#cargaTemperatura').load('temperatura.php');
		$('#cargaHumedad').load('humedad.php');
		$('#cargaco2').load('co2.php');
	});

	$("#BTNTODO").click(function() {

		$('#TEM').show();
		$('#HUM').show();
		$('#CO').show();
	});

	$("#BTNHUM").click(function() {

		$('#TEM').show();
		$('#HUM').hide();
		$('#CO').hide();
	});

	$("#BTNTEM").click(function() {

		$('#TEM').hide();
		$('#HUM').show();
		$('#CO').hide();
	});

	$("#BTNCO2").click(function() {

		$('#TEM').hide();
		$('#HUM').hide();
		$('#CO').show();
	});

	nombre = document.getElementById("device").value;
	console.log(nombre);
</script>