<?php
require_once("conexion/conexion.php");
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
            text: 'Artes de Pesca 2018'
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
                text: 'Total',
            }
        },
        series: [{
            name: 'Artes',
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

<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="height: 400px"></div>

<br><br>

<center><a href="ejemplo5.php"> ejemplo5 </a></center>
	</body>
</html>
