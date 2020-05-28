<?php

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$usuario=$_SESSION['firstname'];
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$active_arte="";
	$active_reporte="active";	
	$title="SGP | Reportes";

	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>
	
    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-info"> <href="perfil_embarcacion.php"><span class="glyphicon glyphicon-plus" ></span> Embarcaciones</button>
			</div>
			<div class="btn-group pull-right">
				<button type='button' class="btn btn-info">  <href="perfil.php"><span class="glyphicon glyphicon-plus" ></span> Puertos Base</button>
			</div>
			<div class="btn-group pull-right">
				<button type='button' class="btn btn-info">  <href="perfil.php"><span class="glyphicon glyphicon-plus" ></span> Artes de Pesca</button>
			</div>
			
			 <div class="btn-group pull-right">
				<button type='button' class="btn btn-info">  <href="perfil.php"><span class="glyphicon glyphicon-plus" ></span> Especies</button>
			</div>
    
            <div class="btn-group pull-right">
				<button type='button' class="btn btn-info">  <href="perfil.php"><span class="glyphicon glyphicon-plus" ></span> Desembarques</button>
			</div>
 
			<h4><i class='glyphicon glyphicon-file'></i> Reportes</h4>
		</div>
		<div class="panel-body">
		
		<?php
require_once("reportes_graficos/conexion/conexion.php");
?>



 <!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Artes de Pesca 2018</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
#container {
	height: 100px; 
	min-width: 310px; 
	max-width: 800px;
	margin: 0 auto;
}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 60,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Total Kg por Artes de Pesca 2018'
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        xAxis: {
            categories: [
			
			
<?php
$sql=mysql_query("SELECT clientes.nombre_cliente,facturas.condiciones, count(facturas.condiciones) as total FROM facturas, clientes WHERE clientes.id_cliente = facturas.id_cliente
GROUP BY facturas.condiciones");
while($res=mysql_fetch_array($sql)){	
?>
			
['<?php echo $res['condiciones']; ?>'], 
			
			
<?php
}
?>
	
			
			
			]
        },
        yAxis: {
            title: {
                text: 'Total Kg',
            }
        },
        series: [{
            name: 'Artes de Pesca',
            data: [
	<?php
$sql=mysql_query("SELECT clientes.nombre_cliente,facturas.condiciones, count(facturas.condiciones) as total FROM facturas, clientes WHERE clientes.id_cliente = facturas.id_cliente
GROUP BY facturas.condiciones");
while($res=mysql_fetch_array($sql)){
?>			
			
			
			
			
			[<?php echo $res['total']; ?>],
			
			<?php
	}
?>
			
			]


            
        }]
    });
});
		</script>
	</head>
	<body>
<script src="reportes_graficos/Highcharts-4.1.5/js/highcharts.js"></script>
<script src="reportes_graficos/Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="reportes_graficos/Highcharts-4.1.5/js/modules/exporting.js"></script>


<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<br><br>

<center><a href="ejemplo1.php"> ejemplo1 </a></center>
	</body>
</html>

  </body>
</html>
