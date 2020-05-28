<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Highcharts Example</title>

		<style type="text/css">

		</style>
	</head>
	<body>

<script src="../../code/highcharts.js"></script>
<script src="../../code/highcharts-3d.js"></script>
<script src="../../code/modules/exporting.js"></script>
<script src="../../code/modules/export-data.js"></script>

<div id="container" style="height: 400px"></div>


		<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Browser market shares at a specific website, 2014'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Browser share',
        data: [
          <?php
$sql=mysql_query("SELECT products.nombre_producto, sum( detalle_factura.cantidad ) AS total
                        FROM detalle_factura, products
                        WHERE detalle_factura.id_producto = products.id_producto 
                        GROUP BY products.nombre_producto ");
while($res=mysql_fetch_array($sql)){  
?>
      
['<?php echo $res['nombre_producto']; ?>'], 
      
      
<?php
}
?>
  
      
      
      ]
        },
        yAxis: {
            title: {
                text: 'Kg',
            }
        },
        series: [{
            name: 'Especies',
            data: [
  <?php
$sql=mysql_query("SELECT products.nombre_producto, sum( detalle_factura.cantidad ) AS total
                        FROM detalle_factura, products
                        WHERE detalle_factura.id_producto = products.id_producto
                        GROUP BY products.nombre_producto order by total  desc");
while($res=mysql_fetch_array($sql)){
?>      
      
      
      
      
      [<?php echo $res['total']; ?>],
      
      <?php
  }
?>
        ]
    }]
});
		</script>
	</body>
 
    </head>
    <body>
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>


<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </body>
</html>