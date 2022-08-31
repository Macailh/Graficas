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
	<title>Graficos</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.3.1.min.js"></script>
	<script src="librerias/plotly-latest.min.js"></script>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/manual.css">
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
									$class = "";
									if ($c > 0 && $c < 300) {
										$c = "circle";
										$class = " ";
									} else if ($c > 300 && $c < 600) {
										$c = "circle2";
										$class = "parpadea";
									} else if ($c > 599) {
										$c = "circle3";
										$class = "parpadea";
									}
								?>

									<div style=" margin-top: 205px;
		 font-size:30px;"><?php echo $row['CO2']; ?></div>
									<div id='<?php echo $c; ?>' class="<?php echo $class; ?>"></div>




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
	setInterval(function() {

		$('#cargaco2').load('co2.php');
		$('#cargaTemperatura').load('temperatura.php');
		$('#cargaHumedad').load('humedad.php');
		// console.log("Ha pasado 1 segundo.");


	}, 1000)

	

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
</script>