<?php
require_once("conexion/conexion.php");
?>


<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>DESEMBARQUE POR PESQUERIA</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        title: {
            text: 'DESEMBARQUE POR PESQUERIA'
        },
        
        xAxis: {
            categories: [

<?php
$sql2=mysql_query("SELECT condiciones, year(facturas.fecha_factura) AS year,
SUM( detalle_factura.cantidad ) AS tipo_pesqueria
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  
and year(facturas.fecha_factura)>2017
 and condiciones=0
AND clientes.id_cliente = facturas.id_cliente
group by  year");

while($res=mysql_fetch_array($sql2)){
?>                         
    [<?php echo $res['year']; ?>],
 

<?php
    }
?>
           ]
        },
        labels: {
            items: [{
                html: '',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Cañera',
            data: 

[

<?php
$sql2=mysql_query("SELECT condiciones, year(facturas.fecha_factura) AS year,
SUM( detalle_factura.cantidad ) AS tipo_pesqueria
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  
and year(facturas.fecha_factura)>2017
 and condiciones=0
AND clientes.id_cliente = facturas.id_cliente
group by  year");

while($res=mysql_fetch_array($sql2)){
?>                         
    [<?php echo $res['tipo_pesqueria']; ?>],
 

<?php
    }
?>

]

       }, {
            

            type: 'column',
            name: 'Palangre',
            data: [

<?php
$sql3=mysql_query("SELECT condiciones, year(facturas.fecha_factura) AS year,
SUM( detalle_factura.cantidad ) AS tipo_pesqueria
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  
and year(facturas.fecha_factura)>2017
 and condiciones=1
AND clientes.id_cliente = facturas.id_cliente
group by  year");

while($res=mysql_fetch_array($sql3)){
?>                         
    [<?php echo $res['tipo_pesqueria']; ?>],
 

<?php
    }
?>

            ]


        }, {


            type: 'column',
            name: 'Polivalente',
            data: [
 <?php
$sql2=mysql_query("SELECT condiciones, year(facturas.fecha_factura) AS year,
SUM( detalle_factura.cantidad ) AS tipo_pesqueria
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  
and year(facturas.fecha_factura)>2017
 and condiciones=2
AND clientes.id_cliente = facturas.id_cliente
group by  year");

while($res=mysql_fetch_array($sql2)){
?>                         
    [<?php echo $res['tipo_pesqueria']; ?>],
 

<?php
    }
?>

           ]
        }, {




            type: 'column',
            name: 'Cerquera',
            data: [
<?php
$sql2=mysql_query("SELECT condiciones, year(facturas.fecha_factura) AS year,
SUM( detalle_factura.cantidad ) AS tipo_pesqueria
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  
and year(facturas.fecha_factura)>2017
 and condiciones=3
AND clientes.id_cliente = facturas.id_cliente
group by  year");

while($res=mysql_fetch_array($sql2)){
?>                         
    [<?php echo $res['tipo_pesqueria']; ?>],
 

<?php
    }
?>

 

            ]


        }, {






            type: 'column',
            name: 'Costa Afuera',
            data: [

<?php
$sql2=mysql_query("SELECT condiciones, year(facturas.fecha_factura) AS year,
SUM( detalle_factura.cantidad ) AS tipo_pesqueria
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  
and year(facturas.fecha_factura)>2017
 and condiciones=4
AND clientes.id_cliente = facturas.id_cliente
group by  year");

while($res=mysql_fetch_array($sql2)){
?>                         
    [<?php echo $res['tipo_pesqueria']; ?>],
 

<?php
    }
?>
 

            ]


        }, 
       
     {
            type: 'spline',
            name: 'Total Descarga',
            data: [



 









            ],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, 



/*

        {
            type: 'pie',
            name: 'Total consumption',
            data: [{
                name: 'Jane',
                y: 13,
                color: Highcharts.getOptions().colors[0] // Jane's color
            }, {
                name: 'John',
                y: 23,
                color: Highcharts.getOptions().colors[1] // John's color
            }, {
                name: 'Joe',
                y: 19,
                color: Highcharts.getOptions().colors[2] // Joe's color
            }],
            center: [100, 80],
            size: 100,
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }



*/


        ]
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

     </body>
</html>


