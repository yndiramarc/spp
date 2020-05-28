<?php
require_once("conexion/conexion.php");
?>



<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Reporte Kg Desembarques por Embarcaciones 2018</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Total de Kg Desembarcado por Embarcaciones 2018'
        },
        subtitle: {
            text: 'x'
        },
        xAxis: {
            categories: [
			
<?php
$sql=mysql_query("SELECT clientes.nombre_cliente, SUM( detalle_factura.cantidad ) AS total
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura
                        AND clientes.id_cliente = facturas.id_cliente
                        GROUP BY facturas.id_cliente order by total  desc");
while($res=mysql_fetch_array($sql)){	
?>
			
['<?php echo $res['nombre_cliente']; ?>'], 
			
			
<?php
}
?>
			
			
			
			],
            title: {
                 text: 'Embarcaciones',
                align: 'high'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Kilogramos (Kg)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Kilogramos'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Año 2018',
            data: [
			
<?php
$sql=mysql_query("SELECT clientes.nombre_cliente, SUM( detalle_factura.cantidad ) AS total
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura
                        AND clientes.id_cliente = facturas.id_cliente
                        GROUP BY facturas.id_cliente order by total  desc");
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


<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<br><br>

<center><a href="ejemplo1.php"> ejemplo1 </a></center>
	</body>
</html>
