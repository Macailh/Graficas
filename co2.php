<?php
require_once "php/conexion.php";
$conexion = conexion();

//Dispositivo 1
$sql = "SELECT FECHA,CO2
				FROM DATOS WHERE DEVICE = 1 ORDER BY FECHA";
$result = mysqli_query($conexion, $sql);
$valoresY = array(); //montos
$valoresX = array(); //fechas

while ($ver = mysqli_fetch_row($result)) {
	$valoresY[] = $ver[1];
	$valoresX[] = $ver[0];
}

$datosX = json_encode($valoresX);
$datosY = json_encode($valoresY);

//Dispositivo 2
$sql2 = "SELECT FECHA,CO2
				FROM DATOS WHERE DEVICE = 2 ORDER BY FECHA";
$result2 = mysqli_query($conexion, $sql2);
$valoresY2 = array(); //montos
$valoresX2 = array(); //fechas

while ($ver2 = mysqli_fetch_row($result2)) {
	$valoresY2[] = $ver2[1];
	$valoresX2[] = $ver2[0];
}

$datosX2 = json_encode($valoresX2);
$datosY2 = json_encode($valoresY2);

//Dispositivo 3
$sql3 = "SELECT FECHA,CO2
				FROM DATOS WHERE DEVICE = 3 ORDER BY FECHA";
$result3 = mysqli_query($conexion, $sql3);
$valoresY3 = array(); //montos
$valoresX3 = array(); //fechas

while ($ver3 = mysqli_fetch_row($result3)) {
	$valoresY3[] = $ver3[1];
	$valoresX3[] = $ver3[0];
}

$datosX3 = json_encode($valoresX3);
$datosY3 = json_encode($valoresY3);
?>
<div id="graficaco2"></div>

<script type="text/javascript">
	function crearCadenaLineal(json) {
		var parsed = JSON.parse(json);
		var arr = [];
		for (var x in parsed) {
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>


<script type="text/javascript">
	datosX = crearCadenaLineal('<?php echo $datosX ?>');
	datosY = crearCadenaLineal('<?php echo $datosY ?>');

	datosX2 = crearCadenaLineal('<?php echo $datosX2 ?>');
	datosY2 = crearCadenaLineal('<?php echo $datosY2 ?>');

	datosX3 = crearCadenaLineal('<?php echo $datosX3 ?>');
	datosY3 = crearCadenaLineal('<?php echo $datosY3 ?>');


	var trace1 = {
		x: datosX,
		y: datosY,
		type: 'lines',
		line: {
			shape: 'hvh'
		},
		name: 'Dispositivo 1',
		line: {
			color: 'rgb(55, 128, 10)',
			width: 3
		}
	};

	var trace2 = {
		x: datosX2,
		y: datosY2,
		type: 'scatter',
		line: {
			shape: 'hvh'
		},
		name: 'Dispositivo 2',
		line: {
			color: 'rgb(25,25,112)',
			width: 3
		}
	};

	var trace3 = {
		x: datosX3,
		y: datosY3,
		type: 'scatter',
		line: {
			shape: 'hvh'
		},
		name: 'Dispositivo 3',
		line: {
			color: 'rgb(220,20,60)',
			width: 3
		}
	};

	var layout = {
		title: 'CO2'
	};

	var options = {
		displayModeBar: true,
		displaylogo: false,
		responsive: true,
		modeBarButtonsToRemove: ['toggleSpikelines', 'hoverClosestCartesian', 'hoverCompareCartesian']
	}

	var data = [trace1,trace2, trace3];
	var data2 = [trace2];
	var data3 = [trace3];

	//Plotly.newPlot('graficaco2', data, layout);

	Plotly.react('graficaco2', data, layout, options);

</script>