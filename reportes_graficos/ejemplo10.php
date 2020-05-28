
<?php
require_once("conexion/conexion.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>DESEMBARQUE POR AÑO/MES</title>

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
            text: 'Produccion Pesquera por Municipio'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: ['AEB', 'Sucre', 'Arismendi', 'Valdez', 'Bermudez', 'Marino', 'Cajigal', 'CSA', 'Libertador', 'Bolivar', 'Mejia', 'Montes', 'Ribero', 'Andres', 'Benitez'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Kilogramos (kg)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
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
            y: 50,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Year 2016',
            data: [

      <?php
$sql=mysql_query("SELECT sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year,
sum(CASE WHEN id_vendedor= 0 THEN detalle_factura.cantidad ELSE 0 END) AS AEB,
sum(CASE WHEN id_vendedor= 1 THEN detalle_factura.cantidad ELSE 0 END) AS Sucre,
sum(CASE WHEN id_vendedor= 2 THEN detalle_factura.cantidad ELSE 0 END) AS Arismendi,
sum(CASE WHEN id_vendedor= 3 THEN detalle_factura.cantidad ELSE 0 END) AS Valdez,
sum(CASE WHEN id_vendedor= 4 THEN detalle_factura.cantidad ELSE 0 END) AS Bermudez,
sum(CASE WHEN id_vendedor= 5 THEN detalle_factura.cantidad ELSE 0 END) AS Marino,
sum(CASE WHEN id_vendedor= 6 THEN detalle_factura.cantidad ELSE 0 END) AS Cajigal,
sum(CASE WHEN id_vendedor= 7 THEN detalle_factura.cantidad ELSE 0 END) AS CSA,
sum(CASE WHEN id_vendedor= 8 THEN detalle_factura.cantidad ELSE 0 END) AS Libertador,
sum(CASE WHEN id_vendedor= 9 THEN detalle_factura.cantidad ELSE 0 END) AS  Bolivar,
sum(CASE WHEN id_vendedor= 10 THEN detalle_factura.cantidad ELSE 0 END) AS Mejia,
sum(CASE WHEN id_vendedor= 11 THEN detalle_factura.cantidad ELSE 0 END) AS Montes,
sum(CASE WHEN id_vendedor= 12 THEN detalle_factura.cantidad ELSE 0 END) AS Ribero,
sum(CASE WHEN id_vendedor= 13 THEN detalle_factura.cantidad ELSE 0 END) AS Andres,
sum(CASE WHEN id_vendedor= 15 THEN detalle_factura.cantidad ELSE 0 END) AS Benitez
 FROM detalle_factura,facturas, clientes, products, pto_base
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura)=2016
 AND clientes.id_cliente = facturas.id_cliente  and facturas.id_vendedor=pto_base.user_id
and products.id_producto = detalle_factura.id_producto group by year order by id_vendedor ");

while($res=mysql_fetch_array($sql)){
?>          
            
            
            
            [<?php echo $res['AEB']; ?>],
            [<?php echo $res['Sucre']; ?>],
          
               [<?php echo $res['Arismendi']; ?>],
               [<?php echo $res['Valdez']; ?>],
                 [<?php echo $res['Bermudez']; ?>],
                  [<?php echo $res['Marino']; ?>],


            [<?php echo $res['Cajigal']; ?>],
            [<?php echo $res['CSA']; ?>],
              [<?php echo $res['Libertador']; ?>],
               [<?php echo $res['Bolivar']; ?>],
               [<?php echo $res['Mejia']; ?>],
                 [<?php echo $res['Montes']; ?>],
                  [<?php echo $res['Ribero']; ?>],

                    [<?php echo $res['Andres']; ?>],
                 
                    [<?php echo $res['Benitez']; ?>],




            <?php
    }
?>

     
                ]


        }, {
            name: 'Year 2017',
            data: [


    <?php
$sql=mysql_query("SELECT sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year,
sum(CASE WHEN id_vendedor= 0 THEN detalle_factura.cantidad ELSE 0 END) AS AEB,
sum(CASE WHEN id_vendedor= 1 THEN detalle_factura.cantidad ELSE 0 END) AS Sucre,
sum(CASE WHEN id_vendedor= 2 THEN detalle_factura.cantidad ELSE 0 END) AS Arismendi,
sum(CASE WHEN id_vendedor= 3 THEN detalle_factura.cantidad ELSE 0 END) AS Valdez,
sum(CASE WHEN id_vendedor= 4 THEN detalle_factura.cantidad ELSE 0 END) AS Bermudez,
sum(CASE WHEN id_vendedor= 5 THEN detalle_factura.cantidad ELSE 0 END) AS Marino,
sum(CASE WHEN id_vendedor= 6 THEN detalle_factura.cantidad ELSE 0 END) AS Cajigal,
sum(CASE WHEN id_vendedor= 7 THEN detalle_factura.cantidad ELSE 0 END) AS CSA,
sum(CASE WHEN id_vendedor= 8 THEN detalle_factura.cantidad ELSE 0 END) AS Libertador,
sum(CASE WHEN id_vendedor= 9 THEN detalle_factura.cantidad ELSE 0 END) AS  Bolivar,
sum(CASE WHEN id_vendedor= 10 THEN detalle_factura.cantidad ELSE 0 END) AS Mejia,
sum(CASE WHEN id_vendedor= 11 THEN detalle_factura.cantidad ELSE 0 END) AS Montes,
sum(CASE WHEN id_vendedor= 12 THEN detalle_factura.cantidad ELSE 0 END) AS Ribero,
sum(CASE WHEN id_vendedor= 13 THEN detalle_factura.cantidad ELSE 0 END) AS Andres,
sum(CASE WHEN id_vendedor= 15 THEN detalle_factura.cantidad ELSE 0 END) AS Benitez
 FROM detalle_factura,facturas, clientes, products, pto_base
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura) =2017
 AND clientes.id_cliente = facturas.id_cliente  and facturas.id_vendedor=pto_base.user_id
and products.id_producto = detalle_factura.id_producto group by year order by id_vendedor ");

while($res=mysql_fetch_array($sql)){
?>          
            
            
        [<?php echo $res['AEB']; ?>],
            [<?php echo $res['Sucre']; ?>],
          
               [<?php echo $res['Arismendi']; ?>],
               [<?php echo $res['Valdez']; ?>],
                 [<?php echo $res['Bermudez']; ?>],
                  [<?php echo $res['Marino']; ?>],


            [<?php echo $res['Cajigal']; ?>],
            [<?php echo $res['CSA']; ?>],
              [<?php echo $res['Libertador']; ?>],
               [<?php echo $res['Bolivar']; ?>],
               [<?php echo $res['Mejia']; ?>],
                 [<?php echo $res['Montes']; ?>],
                  [<?php echo $res['Ribero']; ?>],

                    [<?php echo $res['Andres']; ?>],
                 
                    [<?php echo $res['Benitez']; ?>],
            
            <?php
    }
?>






            ]
        }, {
            name: 'Year 2018',
              data: [

  
   <?php
$sql=mysql_query("SELECT sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year,
sum(CASE WHEN id_vendedor= 0 THEN detalle_factura.cantidad ELSE 0 END) AS AEB,
sum(CASE WHEN id_vendedor= 1 THEN detalle_factura.cantidad ELSE 0 END) AS Sucre,
sum(CASE WHEN id_vendedor= 2 THEN detalle_factura.cantidad ELSE 0 END) AS Arismendi,
sum(CASE WHEN id_vendedor= 3 THEN detalle_factura.cantidad ELSE 0 END) AS Valdez,
sum(CASE WHEN id_vendedor= 4 THEN detalle_factura.cantidad ELSE 0 END) AS Bermudez,
sum(CASE WHEN id_vendedor= 5 THEN detalle_factura.cantidad ELSE 0 END) AS Marino,
sum(CASE WHEN id_vendedor= 6 THEN detalle_factura.cantidad ELSE 0 END) AS Cajigal,
sum(CASE WHEN id_vendedor= 7 THEN detalle_factura.cantidad ELSE 0 END) AS CSA,
sum(CASE WHEN id_vendedor= 8 THEN detalle_factura.cantidad ELSE 0 END) AS Libertador,
sum(CASE WHEN id_vendedor= 9 THEN detalle_factura.cantidad ELSE 0 END) AS  Bolivar,
sum(CASE WHEN id_vendedor= 10 THEN detalle_factura.cantidad ELSE 0 END) AS Mejia,
sum(CASE WHEN id_vendedor= 11 THEN detalle_factura.cantidad ELSE 0 END) AS Montes,
sum(CASE WHEN id_vendedor= 12 THEN detalle_factura.cantidad ELSE 0 END) AS Ribero,
sum(CASE WHEN id_vendedor= 13 THEN detalle_factura.cantidad ELSE 0 END) AS Andres,
sum(CASE WHEN id_vendedor= 15 THEN detalle_factura.cantidad ELSE 0 END) AS Benitez
 FROM detalle_factura,facturas, clientes, products, pto_base
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura) =2018
 AND clientes.id_cliente = facturas.id_cliente  and facturas.id_vendedor=pto_base.user_id
and products.id_producto = detalle_factura.id_producto group by year order by id_vendedor ");

while($res=mysql_fetch_array($sql)){
?>          
            
            
            
          [<?php echo $res['AEB']; ?>],
            [<?php echo $res['Sucre']; ?>],
          
               [<?php echo $res['Arismendi']; ?>],
               [<?php echo $res['Valdez']; ?>],
                 [<?php echo $res['Bermudez']; ?>],
                  [<?php echo $res['Marino']; ?>],


            [<?php echo $res['Cajigal']; ?>],
            [<?php echo $res['CSA']; ?>],
              [<?php echo $res['Libertador']; ?>],
               [<?php echo $res['Bolivar']; ?>],
               [<?php echo $res['Mejia']; ?>],
                 [<?php echo $res['Montes']; ?>],
                  [<?php echo $res['Ribero']; ?>],

                    [<?php echo $res['Andres']; ?>],
                 
                    [<?php echo $res['Benitez']; ?>],
         
            
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





