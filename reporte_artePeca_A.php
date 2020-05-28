 
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>


 

<?php

    session_start();
    if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
        exit;
        }
        $usuario=$_SESSION['firstname'];
    $active_facturas="active";
    $active_productos="";
    $active_clientes="";
    $active_usuarios="";    
    $active_usuarios1="";   
    $active_arte="";
    $active_reporte="";   
    $title="SGP | Desembarques ";
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>
	
   <div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="btn-group pull-right">
                 <a  href="reporte_desembarques.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Desembarques</a>
            </div>
            <div class="btn-group pull-right">
            <a  href="reporte_embarcaciones.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Embarcaciones</a>
            </div>
            <div class="btn-group pull-right">
            <a  href="reporte_artes.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Artes de Pesca</a>
            </div>
            <div class="btn-group pull-right">
            <a  href="reporte_especies.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Especies</a>
            </div>
            <div class="btn-group pull-right">
            <a  href="reporte_ptoBase.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Puertos Bases</a>
            </div>
            <div class="btn-group pull-right">
            <a  href="indicadores2.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Indicadores de Gestion</a>
            </div>
            <h4><i class='glyphicon glyphicon-file'></i> Reportes</h4>
        </div>
        <div class="panel-body">
		
		<?php
require_once("reportes_graficos/conexion/conexion.php");
?>



<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Reporte Kg Desembarcado por Embarcaciones 2018</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		





 



 <div >
                <div >
                        

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> Kilogramos Arte de Pesca
                                                                        <div class="pull-right">
                                        <div class="btn-group">                                         
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div >
                                            <div >
                                               <div >
                                                    <div>
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
<script src="reportes_graficos/Highcharts-4.1.5/js/highcharts.js"></script>
<script src="reportes_graficos/Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="reportes_graficos/Highcharts-4.1.5/js/modules/exporting.js"></script>


<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<br><br>
 
    </body>
</html>

  </body>
</html>

                </div>
                <div id="grafica"></div>
                <div  ></div>
            </div>
            </div>
            </div>
            <div class="col-lg-8">
                                          
                                        </div>
                                        <!-- /.col-lg-8 (nested) -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>




  <?php

           


                $count_query6   = mysqli_query($con, "SELECT clientes.nombre_cliente, facturas.total_venta, facturas.numero_factura, detalle_factura.cantidad, 
                        SUM( detalle_factura.cantidad ) AS total1
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura)=2018
                        AND clientes.id_cliente = facturas.id_cliente");
                $row6= mysqli_fetch_array($count_query6);
                $total1 = $row6['total1'];



                $count_query7   = mysqli_query($con, "SELECT condiciones, SUM( detalle_factura.cantidad ) AS numrows7
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and condiciones=0 and year(facturas.fecha_factura)=2018
                        AND clientes.id_cliente = facturas.id_cliente ");
                $row7= mysqli_fetch_array($count_query7);
                $numrows7 = $row7['numrows7'];


                $count_query8   = mysqli_query($con, "SELECT condiciones, SUM( detalle_factura.cantidad ) AS numrows8
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and condiciones=1 and year(facturas.fecha_factura)=2018
                        AND clientes.id_cliente = facturas.id_cliente ");
                $row8= mysqli_fetch_array($count_query8);
                $numrows8 = $row8['numrows8'];



                $count_query9   = mysqli_query($con, "SELECT condiciones, SUM( detalle_factura.cantidad ) AS numrows9
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and condiciones=2 and year(facturas.fecha_factura)=2018
                        AND clientes.id_cliente = facturas.id_cliente ");
                $row9= mysqli_fetch_array($count_query9);
                $numrows9 = $row9['numrows9'];



                $count_query10   = mysqli_query($con, "SELECT condiciones, SUM( detalle_factura.cantidad ) AS numrows10
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and condiciones=3 and year(facturas.fecha_factura)=2018
                        AND clientes.id_cliente = facturas.id_cliente ");
                $row10= mysqli_fetch_array($count_query10);
                $numrows10 = $row10['numrows10'];



                $count_query11   = mysqli_query($con, "SELECT condiciones, SUM( detalle_factura.cantidad ) AS numrows11
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and condiciones=4 and year(facturas.fecha_factura)=2018
                        AND clientes.id_cliente = facturas.id_cliente ");
                $row11= mysqli_fetch_array($count_query11);
                $numrows11 = $row11['numrows11'];

            ?>


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
  <table class="table table-striped table-bordered table-hover">
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




  
 
















 

      






 
                    <!-- /.panel -->
                    
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>






 
