<?php
require_once("conexion/conexion.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories:    [         
<?php
$sql=mysql_query("SELECT clientes.nombre_cliente,facturas.condiciones, count(facturas.condiciones) as total FROM facturas, clientes WHERE clientes.id_cliente = facturas.id_cliente
GROUP BY facturas.condiciones");
while($res=mysql_fetch_array($sql)){    
?>
            
['<?php echo $res['condiciones']; ?>'], 
            
            
<?php
}
?>
    
            
            
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Tokyo',
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

        }, {
            name: 'New York',
            data: [<?php
$sql=mysql_query("SELECT clientes.nombre_cliente,facturas.condiciones, count(facturas.condiciones) as total FROM facturas, clientes WHERE clientes.id_cliente = facturas.id_cliente
GROUP BY facturas.condiciones");
while($res=mysql_fetch_array($sql)){
?>          
            
            
            
            
            [<?php echo $res['total']; ?>],
            
            <?php
    }
?>
      ]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
    });
});
		</script>
	</head>
	<body>
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>


<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
