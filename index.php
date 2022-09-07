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
<!-- <meta property="og:image" content="https://cdn.sstatic.net/Sites/es/img/apple-touch-icon@2.png?v=62634cce9d6c"> -->

<head>

	<title>Graficos</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.3.1.min.js"></script>
	<!-- <script src="librerias/plotly-latest.min.js"></script> -->
	<script src="https://cdn.plot.ly/plotly-2.14.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/manual.css">
</head>

<body class="bg-info">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel panel-heading text-center">
						Estación de CO2
					</div>
					<div class="panel panel-body">
						<div class="row">
							<div class="col-sm-12">
								<div id="" class="col-sm-12 content-select">
									<button id="BTNTODO" type="button" class="btn btn-secondary active"> TODO</button>
									<button id="BTNHUM" type="button" class="btn btn-secondary active"> HUMEDAD</button>
									<button id="BTNTEM" type="button" class="btn btn-secondary active"> TEMPERATURA</button>
									<button id="BTNCO2" type="button" class="btn btn-secondary active"> CO2</button>
									<button id="BTNCPU" type="button" class="btn btn-secondary active"> TEM CPU</button>
									<option value="0">Seleccione:</option>
									<select name="device" id="device">
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

								<!-- <?php
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




								<?php } ?> -->
							</div>
							<div id="CPU" style=" width: 1120px;" class="col-sm-12">
								<div id="cargaCPU" class="col-sm-12"></div>
							</div>
							<div style=" width: 1120px;" class="col-sm-12">
								<div id="cargaindicador" class="col-sm-12"></div>
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
		$('#cargaCPU').load('cpu.php');
	});

	setInterval(function() {

		$('#cargaco2').load('co2.php');
		$('#cargaTemperatura').load('temperatura.php');
		$('#cargaHumedad').load('humedad.php');
		// console.log("Ha pasado 1 segundo.");


	}, 60000)
	// $("#BTNDISABLED").toggle(function() {
	// 	var div = document.getElementById('cargaTemperatura');
	// 	div.classList.remove('REC1');
	// 	var div = document.getElementById('cargaHumedad');
	// 	div.classList.remove('REC2');
	// 	var div = document.getElementById('cargaCO2');
	// 	div.classList.remove('REC3');

	// }, function() {
	// 	var div = document.getElementById('cargaTemperatura');
	// 	div.classList.remove('REC1');
	// 	var div = document.getElementById('cargaHumedad');
	// 	div.classList.remove('REC2');
	// 	var div = document.getElementById('cargaCO2');
	// 	div.classList.remove('REC3');

	// });

	$("#BTNTODO").click(function() {

		$('#TEM').show();
		$('#HUM').show();
		$('#CO').show();
		var obj = document.getElementById("HUM");
		obj.style.removeProperty("display");
		var obj = document.getElementById("HUM");
		obj.style.removeProperty("display");
		var obj = document.getElementById("HUM");
		obj.style.removeProperty("display");
	});

	$("#BTNHUM").click(function() {

		$('#TEM').hide();
		$('#HUM').show();
		$('#CO').hide();
	});

	$("#BTNTEM").click(function() {

		$('#TEM').show();
		$('#HUM').hide();
		$('#CO').hide();

	});

	$("#BTNCO2").click(function() {

		$('#TEM').hide();
		$('#HUM').hide();
		$('#CO').show();
	});
	$("#BTNCPU").click(function() {

		$('#TEM').hide();
		$('#HUM').hide();
		$('#CO').hide();
		$('#CPU').show();

	});

	nombre = document.getElementById("device").value;
</script>