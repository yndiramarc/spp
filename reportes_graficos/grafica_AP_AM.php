<?php
require_once("conexion/conexion.php");
?>


<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>DESEMBARQUE POR ARTE DE PESCA</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        title: {
            text: 'DESEMBARQUE POR ARTE DE PESCA'
        },
        xAxis: {
            categories: [

<?php
$sql2=mysql_query("SELECT condiciones, year(facturas.fecha_factura) AS year,
SUM( detalle_factura.cantidad ) AS tipo_pesqueria
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  
and year(facturas.fecha_factura)>2000
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
and year(facturas.fecha_factura)>2000
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
            name: 'Palangrera',
            data: [

<?php
$sql3=mysql_query("SELECT condiciones, year(facturas.fecha_factura) AS year,
SUM( detalle_factura.cantidad ) AS tipo_pesqueria
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  
and year(facturas.fecha_factura)>2000
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
and year(facturas.fecha_factura)>2000
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
and year(facturas.fecha_factura)>2000
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
and year(facturas.fecha_factura)>2000
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



<?php
$sql11=mysql_query("SELECT year(facturas.fecha_factura) AS year,
SUM( detalle_factura.cantidad ) AS tipo_pesqueria
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  
and year(facturas.fecha_factura)>2000
 

AND clientes.id_cliente = facturas.id_cliente
group by  year;");

while($res=mysql_fetch_array($sql11)){
?>                         
    [<?php echo $res['tipo_pesqueria']; ?>],
 

<?php
    }
?>
 









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

<center><a href="../indicadores2.php"> Regresar </a></center>
    </body>
</html>


 <div>
                <div >
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Artes de Pesca
                            <div class="pull-right">
                                <div class="btn-group">

                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                            <div>
  <table >
                    <thead>
                        <tr>
                        <th>Año</th>
                         <th>Total Kg</th>
                            <th>Cañera</th>
                            <th>Palangre</th>
                            <th>Polivalente</th>
                            <th>Cerquera</th>
                            <th>Costa Afuera</th>
                                                  
                         
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include("conexion.php");
                    $query = 'SELECT  sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year,
sum(CASE WHEN condiciones = 0 THEN detalle_factura.cantidad ELSE 0 END) AS Cañera,
sum(CASE WHEN condiciones = 1 THEN detalle_factura.cantidad ELSE 0 END) AS Palangre,
sum(CASE WHEN condiciones = 2 THEN detalle_factura.cantidad ELSE 0 END) AS Polivalente,
sum(CASE WHEN condiciones = 3 THEN detalle_factura.cantidad ELSE 0 END) AS Cerquera,
sum(CASE WHEN condiciones = 4 THEN detalle_factura.cantidad ELSE 0 END) AS Costa
 FROM detalle_factura,facturas, clientes, products
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura)  <= year(curdate())
 AND clientes.id_cliente = facturas.id_cliente 
and products.id_producto = detalle_factura.id_producto
 group by year order by year(facturas.fecha_factura);';  
                    $result = mysqli_query($con, $query);
                    $c=0;
                    $a=0;
                    $b=0;
                    $total1=0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                         
                        $categoria[$c] = $row["year"];
                        
                         $categoria3[$c] = $row["total"];
                         $categoria3[$c]=number_format($categoria3[$c],0, ",", ".");//Formateo variables


                           $datos[$c] = $row["Cañera"]; 
                             $datos[$c]=number_format($datos[$c],2, ",", ".");//Formateo variables
                           $datos1[$c] = $row["Palangre"]; 
                             $datos1[$c]=number_format($datos1[$c],2, ",", ".");//Formateo variables
                           $datos2[$c] = $row["Polivalente"]; 
                             $datos2[$c]=number_format($datos2[$c],2, ",", ".");//Formateo variables
                           $datos3[$c] = $row["Cerquera"]; 
                             $datos3[$c]=number_format($datos3[$c],2, ",", ".");//Formateo variables
                           $datos4[$c] = $row["Costa"]; 
                             $datos4[$c]=number_format($datos4[$c],2, ",", ".");//Formateo variables
                           
                        $c++;
                    }
                    for ($j=0;$j<=$c-1;$j++)
                    {
                        $a++;
                        echo "<tr><td>".$categoria[$j]."</td>";
                          
                         echo "<td>".$categoria3[$j]."</td>";
                        echo "<td>".$datos[$j]."</td>";
                        echo "<td>".$datos1[$j]."</td>";
                        echo "<td>".$datos2[$j]."</td>";
                        echo "<td>".$datos3[$j]."</td>";
                        echo "<td>".$datos4[$j]."</td>";
                        

                      
                        if ($j==0)  
                        {
                            
                        }
                    }
                    mysqli_close($con);       
                    ?>
                  
                    </table>

                          </div>

                        </div>
                        <!-- /.panel-body -->
           
 </div>
