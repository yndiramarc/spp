 
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
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$usuario=$_SESSION['firstname'];
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$active_arte="";
	$active_reporte="active";	
	$title="SGP | Reportes";

	
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
				 <a  href="reportes.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Desembarques</a>
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
			<h4><i class='glyphicon glyphicon-file'></i> Reportes Puertos Base</h4>
		</div>
		<div class="panel-body">
		
		<?php
require_once("reportes_graficos/conexion/conexion.php");
?>



<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Reporte Kg Desembarcado por Año</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		





 

     <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Desembarques Grafica
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="list-group">

                                 
                               <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'DESEMBARQUE POR AÑO/MES'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'kg',
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
$sql=mysql_query("SELECT  year(facturas.fecha_factura) AS year,
sum(CASE WHEN month(facturas.fecha_factura) = 1 THEN detalle_factura.cantidad ELSE 0 END) AS Ene,
sum(CASE WHEN month(facturas.fecha_factura) = 2 THEN detalle_factura.cantidad ELSE 0 END) AS Feb,
sum(CASE WHEN month(facturas.fecha_factura) = 3 THEN detalle_factura.cantidad ELSE 0 END) AS Mar,
sum(CASE WHEN month(facturas.fecha_factura) = 4 THEN detalle_factura.cantidad ELSE 0 END) AS Abr,
sum(CASE WHEN month(facturas.fecha_factura) = 5 THEN detalle_factura.cantidad ELSE 0 END) AS May,
sum(CASE WHEN month(facturas.fecha_factura) = 6 THEN detalle_factura.cantidad ELSE 0 END) AS Jun,
sum(CASE WHEN month(facturas.fecha_factura) = 7 THEN detalle_factura.cantidad ELSE 0 END) AS Jul,
sum(CASE WHEN month(facturas.fecha_factura) = 8 THEN detalle_factura.cantidad ELSE 0 END) AS Ago,
sum(CASE WHEN month(facturas.fecha_factura) = 9 THEN detalle_factura.cantidad ELSE 0 END) AS Sep,
sum(CASE WHEN month(facturas.fecha_factura) = 10 THEN detalle_factura.cantidad ELSE 0 END) AS Oct,
sum(CASE WHEN month(facturas.fecha_factura) = 11 THEN detalle_factura.cantidad ELSE 0 END) AS Nov,
sum(CASE WHEN month(facturas.fecha_factura) = 12 THEN detalle_factura.cantidad ELSE 0 END) AS Dic
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura 
AND year(facturas.fecha_factura)=2016
AND clientes.id_cliente = facturas.id_cliente
group by  year");

while($res=mysql_fetch_array($sql)){
?>          
            
            
            
            [<?php echo $res['Ene']; ?>],
            [<?php echo $res['Feb']; ?>],
            [<?php echo $res['Mar']; ?>],
            [<?php echo $res['Abr']; ?>],
            [<?php echo $res['May']; ?>],
            [<?php echo $res['Jun']; ?>],
            [<?php echo $res['Jul']; ?>],
            [<?php echo $res['Ago']; ?>],
            [<?php echo $res['Sep']; ?>],
            [<?php echo $res['Oct']; ?>],
            [<?php echo $res['Nov']; ?>],
            [<?php echo $res['Dic']; ?>],
            
            <?php
    }
?>
     
                ]


        }, {
            name: 'Year 2017',
            data: [


   <?php
$sql=mysql_query("SELECT  year(facturas.fecha_factura) AS year,
sum(CASE WHEN month(facturas.fecha_factura) = 1 THEN detalle_factura.cantidad ELSE 0 END) AS Ene,
sum(CASE WHEN month(facturas.fecha_factura) = 2 THEN detalle_factura.cantidad ELSE 0 END) AS Feb,
sum(CASE WHEN month(facturas.fecha_factura) = 3 THEN detalle_factura.cantidad ELSE 0 END) AS Mar,
sum(CASE WHEN month(facturas.fecha_factura) = 4 THEN detalle_factura.cantidad ELSE 0 END) AS Abr,
sum(CASE WHEN month(facturas.fecha_factura) = 5 THEN detalle_factura.cantidad ELSE 0 END) AS May,
sum(CASE WHEN month(facturas.fecha_factura) = 6 THEN detalle_factura.cantidad ELSE 0 END) AS Jun,
sum(CASE WHEN month(facturas.fecha_factura) = 7 THEN detalle_factura.cantidad ELSE 0 END) AS Jul,
sum(CASE WHEN month(facturas.fecha_factura) = 8 THEN detalle_factura.cantidad ELSE 0 END) AS Ago,
sum(CASE WHEN month(facturas.fecha_factura) = 9 THEN detalle_factura.cantidad ELSE 0 END) AS Sep,
sum(CASE WHEN month(facturas.fecha_factura) = 10 THEN detalle_factura.cantidad ELSE 0 END) AS Oct,
sum(CASE WHEN month(facturas.fecha_factura) = 11 THEN detalle_factura.cantidad ELSE 0 END) AS Nov,
sum(CASE WHEN month(facturas.fecha_factura) = 12 THEN detalle_factura.cantidad ELSE 0 END) AS Dic
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura 
AND year(facturas.fecha_factura)=2017
AND clientes.id_cliente = facturas.id_cliente
group by  year");

while($res=mysql_fetch_array($sql)){
?>          
            
            
            
            [<?php echo $res['Ene']; ?>],
            [<?php echo $res['Feb']; ?>],
            [<?php echo $res['Mar']; ?>],
            [<?php echo $res['Abr']; ?>],
            [<?php echo $res['May']; ?>],
            [<?php echo $res['Jun']; ?>],
            [<?php echo $res['Jul']; ?>],
            [<?php echo $res['Ago']; ?>],
            [<?php echo $res['Sep']; ?>],
            [<?php echo $res['Oct']; ?>],
            [<?php echo $res['Nov']; ?>],
            [<?php echo $res['Dic']; ?>],
            
            <?php
    }
?>
     
 
     





            ]
        }, {
            name: 'Year 2018',
              data: [

  
   <?php
$sql=mysql_query("SELECT  year(facturas.fecha_factura) AS year,
sum(CASE WHEN month(facturas.fecha_factura) = 1 THEN detalle_factura.cantidad ELSE 0 END) AS Ene,
sum(CASE WHEN month(facturas.fecha_factura) = 2 THEN detalle_factura.cantidad ELSE 0 END) AS Feb,
sum(CASE WHEN month(facturas.fecha_factura) = 3 THEN detalle_factura.cantidad ELSE 0 END) AS Mar,
sum(CASE WHEN month(facturas.fecha_factura) = 4 THEN detalle_factura.cantidad ELSE 0 END) AS Abr,
sum(CASE WHEN month(facturas.fecha_factura) = 5 THEN detalle_factura.cantidad ELSE 0 END) AS May,
sum(CASE WHEN month(facturas.fecha_factura) = 6 THEN detalle_factura.cantidad ELSE 0 END) AS Jun,
sum(CASE WHEN month(facturas.fecha_factura) = 7 THEN detalle_factura.cantidad ELSE 0 END) AS Jul,
sum(CASE WHEN month(facturas.fecha_factura) = 8 THEN detalle_factura.cantidad ELSE 0 END) AS Ago,
sum(CASE WHEN month(facturas.fecha_factura) = 9 THEN detalle_factura.cantidad ELSE 0 END) AS Sep,
sum(CASE WHEN month(facturas.fecha_factura) = 10 THEN detalle_factura.cantidad ELSE 0 END) AS Oct,
sum(CASE WHEN month(facturas.fecha_factura) = 11 THEN detalle_factura.cantidad ELSE 0 END) AS Nov,
sum(CASE WHEN month(facturas.fecha_factura) = 12 THEN detalle_factura.cantidad ELSE 0 END) AS Dic
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura 
AND year(facturas.fecha_factura)=2018
AND clientes.id_cliente = facturas.id_cliente
group by  year");

while($res=mysql_fetch_array($sql)){
?>          
            
            
            
            [<?php echo $res['Ene']; ?>],
            [<?php echo $res['Feb']; ?>],
            [<?php echo $res['Mar']; ?>],
            [<?php echo $res['Abr']; ?>],
            [<?php echo $res['May']; ?>],
            [<?php echo $res['Jun']; ?>],
            [<?php echo $res['Jul']; ?>],
            [<?php echo $res['Ago']; ?>],
            [<?php echo $res['Sep']; ?>],
            [<?php echo $res['Oct']; ?>],
            [<?php echo $res['Nov']; ?>],
            [<?php echo $res['Dic']; ?>],
            
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
<script src="reportes_graficos/Highcharts-4.1.5/js/highcharts.js"></script>
<script src="reportes_graficos/Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="reportes_graficos/Highcharts-4.1.5/js/modules/exporting.js"></script>


<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<br><br>
                              <a href="reportes_graficos/grafica_descarga_A.php" class="btn btn-default btn-block">Grafico Barra</a>

 
    </body>

                            </div>
                            <!-- /.list-group -->
                         </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
      </div>






  



     <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Desembarques <?php echo " "; echo  $anio=date('d/m/Y'); ?> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                  <table class="table table-striped table-bordered table-hover" align="center">
              
                            <th>Año</th>
                            <th>N°</th>
                            <th>%</th>
                            <th>Tot.Kg</th>
                            <th>% Kg</th>
           
                   
                    <?php
                    include("conexion.php");
                    $query = 'SELECT year(facturas.fecha_factura) AS year,
count( facturas.numero_factura) AS cantdFact, SUM( detalle_factura.cantidad ) AS kg
FROM detalle_factura,facturas, clientes
WHERE facturas.numero_factura = detalle_factura.numero_factura  and year(facturas.fecha_factura)>2000 
AND clientes.id_cliente = facturas.id_cliente
group by year';  

    $result = mysqli_query($con, $query);
                    $c=0;
                    $a=0;
                    $cantdFact=0;
                    $kg=0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        $categoria[$c] = $row["year"];
                        $datos[$c] = $row["cantdFact"];   
                        $cantdFact = $cantdFact + $row["cantdFact"];
                        $kg1[$c] = $row["kg"];
                        $kg = $kg + $row["kg"];
                        $c++;
                    }
                    for ($j=0;$j<=$c-1;$j++)
                    {
                        $a++;
                     
                        
                        if ($j==0)  
                        {
                            
                        }
                    }
                 mysqli_close($con);       
                    ?>




   <?php
                    include("conexion.php");

  $query1 = 'SELECT year(fecha_factura) as year, count(facturas.id_factura) as desembarques1 FROM `facturas` WHERE year(fecha_factura)<= year(curdate())
group by year(fecha_factura)';  


                    $result1 = mysqli_query($con, $query1);
                    $c=0;
                    $a=0;
                    $desembarques1=0;
                    
                    while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC))
                    {
                        $categoria[$c] = $row["year"];
                        $datos[$c] = $row["desembarques1"];   
                        $desembarques1 = $desembarques1 + $row["desembarques1"];
                        
                        $c++;
                    }
                    for ($j=0;$j<=$c-1;$j++)
                    {
                        $a++;
                         echo "<tr class='text-center'><td>".$categoria[$j];
                        echo "<td>".$datos[$j]."</td>";
                    //    echo "<td>".$kg1[$j]."</td>";
                    
            echo "<td>".number_format((($datos[$j]/$desembarques1)*100), 1, ',', '')."%";
            echo "<td>".number_format(($kg1[$j]), 0, ',', '.');

          
            $por[$j]= round( ($datos[$j]/$cantdFact)*100, 0);
            echo "<td>".number_format((($kg1[$j]/$kg)*100), 1, ',', '')."%";
                        
                        if ($j==0)  
                        {
                            
                        }
                    }
                    mysqli_close($con);       
                    ?>
                    </tbody>
                    </table>
                                


                            </div>
        <a href="reportes_graficos/porcentaje_total.php" class="btn btn-default btn-block">Grafico</a>

                            <!-- /.list-group -->
                         </div>

                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
      </div>





 <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Lista de Desembarques <?php echo " "; echo  $anio=date('d/m/Y'); ?> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                 
                                <a href="ListaexcelDesembarqueTotales.php" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Lista total de desembarques
                                    <span class="pull-right text-muted small"><em></em>
                                    </span>
                                </a>
                                  <a href="ListaexcelDesembarqueTotalesPtoBase.php" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Lista desembarque puertos base
                                    <span class="pull-right text-muted small"><em></em>
                                    </span>
                                </a>
                                  <a href="ListaexcelDesembarqueEspecies.php" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Lista desembarque especies
                                    <span class="pull-right text-muted small"><em></em>
                                    </span>
                                </a>
                                

                            </div>
                            <!-- /.list-group -->
                         </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
      </div>




















<div class="row">
                <div class="col-lg-12">
                        

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> Descarga por Año <?php echo " "; echo  $anio=date('d/m/Y'); ?> 
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
                         <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                        <th>Año</th>
                         <th>Total Kg</th> 
                            <th>Ene</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Abr</th>
                            <th>May</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Ago</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dic</th>
                         
                         
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include("conexion.php");
                    $query = 'SELECT year(facturas.fecha_factura) AS year, SUM( detalle_factura.cantidad ) AS kg,
sum(CASE WHEN month(facturas.fecha_factura) = 1 THEN detalle_factura.cantidad ELSE 0 END) AS Ene,
sum(CASE WHEN month(facturas.fecha_factura) = 2 THEN detalle_factura.cantidad ELSE 0 END) AS Feb,
sum(CASE WHEN month(facturas.fecha_factura) = 3 THEN detalle_factura.cantidad ELSE 0 END) AS Mar,
sum(CASE WHEN month(facturas.fecha_factura) = 4 THEN detalle_factura.cantidad ELSE 0 END) AS Abr,
sum(CASE WHEN month(facturas.fecha_factura) = 5 THEN detalle_factura.cantidad ELSE 0 END) AS May,
sum(CASE WHEN month(facturas.fecha_factura) = 6 THEN detalle_factura.cantidad ELSE 0 END) AS Jun,
sum(CASE WHEN month(facturas.fecha_factura) = 7 THEN detalle_factura.cantidad ELSE 0 END) AS Jul,
sum(CASE WHEN month(facturas.fecha_factura) = 8 THEN detalle_factura.cantidad ELSE 0 END) AS Ago,
sum(CASE WHEN month(facturas.fecha_factura) = 9 THEN detalle_factura.cantidad ELSE 0 END) AS Sep,
sum(CASE WHEN month(facturas.fecha_factura) = 10 THEN detalle_factura.cantidad ELSE 0 END) AS Oct,
sum(CASE WHEN month(facturas.fecha_factura) = 11 THEN detalle_factura.cantidad ELSE 0 END) AS Nov,
sum(CASE WHEN month(facturas.fecha_factura) = 12 THEN detalle_factura.cantidad ELSE 0 END) AS Dic

 FROM detalle_factura,facturas, clientes
                                              WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura) > 2000
                                              AND clientes.id_cliente = facturas.id_cliente
               group by  year';  
                    $result = mysqli_query($con, $query);
                    $c=0;
                    $a=0;
                    $b=0;
                    $total1=0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                         
                        $categoria[$c] = $row["year"];
                         $categoria1[$c] = $row["kg"];



                          $categoria1[$c]=number_format($categoria1[$c],0, ",", ".");//Formateo variables
                           $datos[$c] = $row["Ene"]; 
                             $datos[$c]=number_format($datos[$c],0, ",", ".");//Formateo variables
                           $datos1[$c] = $row["Feb"]; 
                             $datos1[$c]=number_format($datos1[$c],0, ",", ".");//Formateo variables
                           $datos2[$c] = $row["Mar"]; 
                             $datos2[$c]=number_format($datos2[$c],0, ",", ".");//Formateo variables
                           $datos3[$c] = $row["Abr"]; 
                             $datos3[$c]=number_format($datos3[$c],0, ",", ".");//Formateo variables
                           $datos4[$c] = $row["May"]; 
                             $datos4[$c]=number_format($datos4[$c],0, ",", ".");//Formateo variables
                           $datos5[$c] = $row["Jun"]; 
                             $datos5[$c]=number_format($datos5[$c],0, ",", ".");//Formateo variables
                           $datos6[$c] = $row["Jul"];  
                             $datos6[$c]=number_format($datos6[$c],0, ",", ".");//Formateo variables
                           $datos7[$c] = $row["Ago"]; 
                             $datos7[$c]=number_format($datos7[$c],0, ",", ".");//Formateo variables
                           $datos8[$c] = $row["Sep"]; 
                             $datos8[$c]=number_format($datos8[$c],0, ",", ".");//Formateo variables
                           $datos9[$c] = $row["Oct"]; 
                             $datos9[$c]=number_format($datos9[$c],0, ",", ".");//Formateo variables
                           $datos10[$c] = $row["Nov"]; 
                             $datos10[$c]=number_format($datos10[$c],0, ",", ".");//Formateo variables 
                           $datos11[$c] = $row["Dic"]; 
                             $datos11[$c]=number_format($datos11[$c],0, ",", ".");//Formateo variables
                                           
                        $c++;
                    }
                    for ($j=0;$j<=$c-1;$j++)
                    {
                        $a++;
                        echo "<tr><td>".$categoria[$j];
                            echo "<td>".$categoria1[$j];
                         
                        echo "<td>".$datos[$j]."</td>";
                        echo "<td>".$datos1[$j]."</td>";
                        echo "<td>".$datos2[$j]."</td>";
                        echo "<td>".$datos3[$j]."</td>";
                        echo "<td>".$datos4[$j]."</td>";
                        echo "<td>".$datos5[$j]."</td>";
                        echo "<td>".$datos6[$j]."</td>";
                        echo "<td>".$datos7[$j]."</td>";
                        echo "<td>".$datos8[$j]."</td>";
                        echo "<td>".$datos9[$j]."</td>";
                        echo "<td>".$datos10[$j]."</td>";
                        echo "<td>".$datos11[$j]."</td>";
                      

                      
                        if ($j==0)  
                        {
                         }
                    }
                    mysqli_close($con);       
                    ?>
                    </tbody>
                    </table>
                </div>
                <div id="grafica"></div>
                <div  ></div>
   <center> <a href="../SGP2/archivosExcel/GenerarExcel2.php"><button type='button' class='btn btn-sm btn-primary' class="text-center">Generar Excel</button></a></center>
 

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











































































                <!-- /.col-lg-8 -->
              






                   

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






 
