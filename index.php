<?php
    require_once "php/conexion.php";
    $result;
	
    $sql = 'SELECT * FROM DATOS ORDER BY id DESC LIMIT 1 ';
    
    $result = $conn->query($sql);
      
    $rows = $result->fetchAll();
    
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
		 margin-top: -100px;
         background-color: red;
         border-radius: 50%;
         width: 100px;
         height: 100px;
		 margin-left: 975px;
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
								<div id="" class="bg-danger col-sm-12">
									<button id="BTNTODO">TODO</button>
									<button	id="BTNHUM">HUMEDAD</button>
									<button id="BTNTEM">TEMPERATURA</button>
									<button id="BTNCO2">CO2</button>
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
										if ($c > 0 && $c < 300){
											$c = "circle";
										} else if ($c > 300 && $c < 600) {
											$c = "circle2";
										} else if ($c > 599) {
											$c = "circle3";
										}
										?>	

										<div style=" margin-top: 180px;
		 font-size:30px;"><?php echo $row['CO2']; ?></div>;
										<div id='<?php echo $c; ?>'></div>



										
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
	$(document).ready(function(){
		$('#cargaTemperatura').load('temperatura.php');
		$('#cargaHumedad').load('humedad.php');
		$('#cargaco2').load('co.php');
		$('#circle').load('c.php');
	});

	$("#BTNTODO").click(function(){
  
	$('#TEM').show();
	$('#HUM').show();
	$('#CO').show();	 
	});

	$("#BTNHUM").click(function(){
  
	$('#TEM').show();
	$('#HUM').hide();
	$('#CO').hide();	 
	});

	$("#BTNTEM").click(function(){
  
	$('#TEM').hide();
	$('#HUM').show();
	$('#CO').hide();	 
	});

	$("#BTNCO2").click(function(){
  
	$('#TEM').hide();
	$('#HUM').hide();
	$('#CO').show();	 
	});
			
</script>