<?php
require_once("conexion/conexion.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Total de Kg por Especies 2018</title>

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
            text: 'Total de Kg por Especies 2018'
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
$sql=mysql_query("SELECT products.nombre_producto, year(facturas.fecha_factura) as year, month(facturas.fecha_factura) as Mes, 
                    sum(detalle_factura.cantidad ) as Cantidad
                    FROM detalle_factura,facturas, clientes, products
                                              WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura) > 2000
                                              AND clientes.id_cliente = facturas.id_cliente
                                              group by nombre_producto ");
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
$sql=mysql_query("SELECT products.nombre_producto, year(facturas.fecha_factura) as year, month(facturas.fecha_factura) as Mes, 
                    sum(detalle_factura.cantidad ) as Cantidad
                    FROM detalle_factura,facturas, clientes, products
                                              WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura) > 2000
                                              AND clientes.id_cliente = facturas.id_cliente
                                              group by Mes");
while($res=mysql_fetch_array($sql)){
?>			
			
			
			
			
			[<?php echo $res['Cantidad']; ?>],
			
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

<center><a href="ejemplo4.php"> ejemplo4 </a></center>
	</body>
</html>
