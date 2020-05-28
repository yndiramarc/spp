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
    $title="SGP | Indicadores";
?>
 
 <!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
    require_once ("C:\wamp\www\SGP3/head.php");
       require_once ("C:\wamp\www\SGP3/navbar.php");
    ?>
    
    <div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
             <h4><i class='glyphicon glyphicon-search'></i> Indicadores</h4>
        </div>
        <div class="panel-body">
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="estilo.css" />
<script src="Highcharts-6.1.0/code/js/jquery.min.js"></script>
<script src="Highcharts-6.1.0/code/js/highcharts.js"></script>
<script src="Highcharts-6.1.0/code/js/themes/grid.js"></script>
<script src="Highcharts-6.1.0/code/js/modules/exporting.js"></script>
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

<body>

    
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
                        AND clientes.id_cliente = facturas.id_cliente");
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

             <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Desembarques
                            <div class="pull-right">
                                <div class="btn-group">

                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                            <div>
  <table class="table table-striped table-bordered table-hover" align="center">
              
                            <th>Año</th>
                            <th>N° Desembarques</th>
                            <th>Porcentaje</th>
                            <th>Kg Desembarques</th>
                            <th>Porcentaje</th>
           
                   
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
                         echo "<tr><td>".$categoria[$j];
                        echo "<td>".$datos[$j]."</td>";
                    //    echo "<td>".$kg1[$j]."</td>";
                    
            echo "<td>".number_format((($datos[$j]/$desembarques1)*100), 1, ',', '')."%";
            echo "<td>".number_format(($kg1[$j]), 2, ',', '.');

          
            $por[$j]= round( ($datos[$j]/$cantdFact)*100, 1);
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
                        </div>
                        <!-- /.panel-body -->
                    </div>

                       </div>




<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Desembarques Pesquerias
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' .number_format(($total1), 2, ',', '.'); ?></em>
                                    </span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                         
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Polivalentes
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . number_format(($numrows9), 2, ',', '.'); ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Cañera
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . number_format(($numrows7), 2, ',', '.');  ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Costa Afuera
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . number_format(($numrows11), 2, ',', '.'); ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Cerquera
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' .number_format(($numrows10), 2, ',', '.'); ?></em>

                                    </span>
                                </a>
                               
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Palangreras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' .number_format(($numrows8), 2, ',', '.'); ?></em>
                                    </span>
                                </a>


                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
      </div>

        </div>





      <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Embarcaciones
                            <div class="pull-right">
                                <div class="btn-group">

                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                            <div>
  <table class="table table-striped table-bordered table-hover" align="center">
              
                            <th>Año</th>
                            <th>N° Desembarques</th>
                            <th>Porcentaje</th>
                            <th>Kg Desembarques</th>
                            <th>Porcentaje</th>
           
                   
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
                         echo "<tr><td>".$categoria[$j];
                        echo "<td>".$datos[$j]."</td>";
                    //    echo "<td>".$kg1[$j]."</td>";
                    
            echo "<td>".number_format((($datos[$j]/$desembarques1)*100), 1, ',', '')."%";
            echo "<td>".number_format(($kg1[$j]), 2, ',', '.');

          
            $por[$j]= round( ($datos[$j]/$cantdFact)*100, 1);
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
                        </div>
                        <!-- /.panel-body -->
                    </div>

                       </div>


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
