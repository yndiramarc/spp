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
            <h4><i class='glyphicon glyphicon-file'></i> Indicadores de Gestion</h4>
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

             <div>
                <div >
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
                            <th>Total Kg</th>
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
    <a href="reportes_graficos/grafica_pesqueria_2018.php" class="btn btn-default btn-block">Grafico</a>

                        </div>
                        <!-- /.panel-body -->
           
 </div>
     
       


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
 group by year order by year(facturas.fecha_factura)';  
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
                              <a href="../SGP2/reporte_artePeca_A.php" class="btn btn-default btn-block">Grafico</a>

                        </div>
                        <!-- /.panel-body -->
           
 </div>




 <div>
                <div >
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Puertos Base
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
                    $query = ' SELECT  *, sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year,
sum(CASE WHEN id_vendedor= 1 THEN detalle_factura.cantidad ELSE 0 END) AS AEB
 sum(CASE WHEN user_name="Andres" THEN detalle_factura.cantidad ELSE 0 END) AS Andres,
sum(CASE WHEN user_name='Arismendi' THEN detalle_factura.cantidad ELSE 0 END) AS Benitez,
sum(CASE WHEN user_name='Bermudez' THEN detalle_factura.cantidad ELSE 0 END) AS Bermudez,
sum(CASE WHEN user_name='Bolivar' THEN detalle_factura.cantidad ELSE 0 END) AS Bolivar,
sum(CASE WHEN user_name='Cajigal' THEN detalle_factura.cantidad ELSE 0 END) AS Cajigal,
sum(CASE WHEN user_name='CSA' THEN detalle_factura.cantidad ELSE 0 END) AS CSA,
sum(CASE WHEN user_name='Libertador' THEN detalle_factura.cantidad ELSE 0 END) AS Libertador,
sum(CASE WHEN user_name='Mariño' THEN detalle_factura.cantidad ELSE 0 END) AS Mariño,
sum(CASE WHEN user_name='Montes' THEN detalle_factura.cantidad ELSE 0 END) AS Montes,
sum(CASE WHEN user_name='Ribero' THEN detalle_factura.cantidad ELSE 0 END) AS Ribero,
sum(CASE WHEN user_name='Sucre' THEN detalle_factura.cantidad ELSE 0 END) AS Sucre,
sum(CASE WHEN user_name='Valdez' THEN detalle_factura.cantidad ELSE 0 END) AS Valdez

 FROM detalle_factura,facturas, clientes, products, pto_base
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura)  <= year(curdate())
 AND clientes.id_cliente = facturas.id_cliente  and facturas.id_vendedor=pto_base.user_id
and products.id_producto = detalle_factura.id_producto
 group by user_name order by id_vendedor ';  
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
                         $datos[$c] = $row["user_name"]; 
                            
                        $c++;
                    }
                    for ($j=0;$j<=$c-1;$j++)
                    {
                        $a++;
                        echo "<tr><td>".$categoria[$j]."</td>";
                        echo "<td>".$categoria3[$j]."</td>";
                        echo "<td>".$datos[$j]."</td>";
                    

                      
                        if ($j==0)  
                        {
                            
                        }
                    }
                    mysqli_close($con);       
                    ?>
                  
                    </table>

                          </div>
                              <a href="../SGP2/reporte_artePeca_A.php" class="btn btn-default btn-block">Grafico</a>

                        </div>
                        <!-- /.panel-body -->
           
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
