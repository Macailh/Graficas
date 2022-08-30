<?php
	require_once "php/conexion.php";
	$conexion=conexion();
	$sql="SELECT FECHA,CO2 
			from DATOS order by FECHA";
	$result=mysqli_query($conexion,$sql);
	$valoresY=array();//montos
	$valoresX=array();//fechas

	while ($ver=mysqli_fetch_row($result)) {
		$valoresY[]=$ver[1];
		$valoresX[]=$ver[0];
	}

	$datosX=json_encode($valoresX);
	$datosY=json_encode($valoresY);
 ?>

<div id="graficaBarras"></div>

<script type="text/javascript">
	function crearCadenaBarras(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>

<script type="text/javascript">

	datosX=crearCadenaBarras('<?php echo $datosX ?>');
	datosY=crearCadenaBarras('<?php echo $datosY ?>');

	// var data = [
	// 	{
	// 		x: datosX,
	// 		y: datosY,
	// 		type: 'bar'
	// 	}
	// ];
	
	let datosYN=[]
	for (i = 0; i < datosY.length; i++) {
  	// console.log(parseInt(datosY[i]));
		datosYN.push(parseInt(datosY[i]))
	} 

	console.log(datosYN);
	console.log(datosX);

	var data = [{
  values: datosYN,
  labels: datosX,
  text: 'CO2',
  textposition: 'inside',
  domain: {column: 1},
  name: 'CO2 Emissions',
  hoverinfo: 'label+percent+name',
  hole: .4,
  type: 'pie'
}];

var layout = {
  title: 'CO2',
  annotations: [
    {
      font: {
        size: 20
      },
      showarrow: false,
      text: 'CO2',
      x: 0.5,
      y: 0.5
    }
  ],
  showlegend: false,

};

	Plotly.newPlot('graficaBarras', data, layout);
	// Plotly.newPlot('graficaBarras', data);
</script>