<?php
require_once("conexion/conexion.php");
?>





<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Reporte % de Kg Desembarcados por Embarcaciones 2018</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>

		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Reporte % de Kg Desembarcados por Embarcaciones 2018'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'plotShadow',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Desembarques',
            data: [
               
			    <?php
				$sql=mysql_query("SELECT year(facturas.fecha_factura) AS year,
count( facturas.numero_factura) AS cantdFact, SUM( detalle_factura.cantidad ) AS kg
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  and year(facturas.fecha_factura)>2000 
AND clientes.id_cliente = facturas.id_cliente
group by year ");
				while($res=mysql_fetch_array($sql)){
				?>
			   
			    ['<?php echo $res['year']; ?>', <?php echo $res['kg']; ?> ], 		
				
				
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
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<br><br>

 	</body>
</html>
