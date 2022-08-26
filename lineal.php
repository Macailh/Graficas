
<?php
	require_once "php/conexion.php"; 
	$conexion=conexion();
	$sql="SELECT fechaVenta,montoVenta 
			from ventas";
	$result=mysqli_query($conexion,$sql);
	$valoresY=array();//montos
	$valoresX=array();//fechas

	while ($ver=mysqli_fetch_row($result)) {
		$valoresY[]=$ver[1];
		$valoresX[]=$ver[0];
	}

	$datosX=json_encode($valoresX);
	$datosY=json_encode($valoresY);


	$sql2="SELECT fechaVenta,montoVenta 
			from ventas2";
	$result2=mysqli_query($conexion,$sql2);
	$valoresY2=array();//montos
	$valoresX2=array();//fechas

	while ($ver2=mysqli_fetch_row($result2)) {
		$valoresY2[]=$ver2[1];
		$valoresX2[]=$ver2[0];
	}

	$datosX2=json_encode($valoresX2);
	$datosY2=json_encode($valoresY2);

 ?>
<div id="graficaLineal"></div>

<script type="text/javascript">
	function crearCadenaLineal(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>


<script type="text/javascript">

	datosX=crearCadenaLineal('<?php echo $datosX ?>');
	datosY=crearCadenaLineal('<?php echo $datosY ?>');
	
	datosX2=crearCadenaLineal('<?php echo $datosX2 ?>');
	datosY2=crearCadenaLineal('<?php echo $datosY2 ?>');

	var trace1 = {
		x: datosX,
		y: datosY,
		type: 'scatter'
	};
	

	// var trace2 = {
	// x: [1990, 2020, 2012, 2013],
	// y: [16000, 50000, 11000, 9000],
	// type: 'scatter'
	// };

	var trace2 = {
		x: datosX2,
		y: datosY2,
		type: 'scatter'
	};

	var data = [trace1, trace2];

	Plotly.newPlot('graficaLineal', data);
</script>