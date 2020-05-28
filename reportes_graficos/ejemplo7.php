<?php
require_once("conexion/conexion.php");
?>





<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Reporte Numero de Desembarques por Embarcaciones 2018</title>

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
            text: 'Reporte %  de Desembarques por Embarcaciones 2018'
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
				$sql=mysql_query("SELECT  clientes.nombre_cliente, count(facturas.id_cliente) as desembarques FROM clientes,facturas WHERE facturas.id_cliente=  clientes.id_cliente                 GROUP BY  facturas.id_cliente; ");
				while($res=mysql_fetch_array($sql)){
				?>
			   
			    ['<?php echo $res['nombre_cliente']; ?>', <?php echo $res['desembarques']; ?> ], 		
				
				
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

<center><a href="ejemplo8.php"> ejemplo8 </a></center>
	</body>
</html>
