 
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
        





 



 <div class="row">
                <div class="col-lg-8">
                        

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> Descargas
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
<head>
  <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <!-- Latest compiled and minified CSS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

  function errorHandler(errorMessage) {
            //curisosity, check out the error in the console
            console.log(errorMessage);
            //simply remove the error, the user never see it
            google.visualization.errors.removeError(errorMessage.id);
        }
    
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
    var periodo=$("#periodo").val();//Datos que enviaremos para generar una consulta en la base de datos
    var jsonData= $.ajax({
                        url: 'chartBF.php',
            data: {'periodo':periodo,'action':'ajax'},
                        dataType: 'json',
                        async: false
                    }).responseText;
   
    var obj = jQuery.parseJSON(jsonData);
    var data = google.visualization.arrayToDataTable(obj);
    
    

    var options = {
      title : 'REPORTE DE KILOGRAMOS'+ '    ' +periodo,
      vAxis: {title: 'Kg'},
      hAxis: {title: 'Meses'},
      seriesType: 'bars',
      series: {5: {type: 'line'}}
    };
  
    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
  google.visualization.events.addListener(chart, 'error', errorHandler);
    chart.draw(data, options);
  }
  
  // Haciendo los graficos responsivos
      jQuery(document).ready(function(){
        jQuery(window).resize(function(){
         drawVisualization();
        });
      });
    
    </script>
  </head>
  <body>



    <div >
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
    <div class='row'> 
    <div class='col-md-4'>
      <label>Selecciona período</label>
      

<select class="form-control" id="periodo" onchange="drawVisualization();" >
                                    <?php
                                    $selected= 2000;
                                        $sql_year=mysqli_query($con,"select year(facturas.fecha_factura) AS year from facturas group by year order by year");
                                        while ($rw=mysqli_fetch_array($sql_year)){
                                            $periodo=$rw["year"];
                                            $fecha=$rw["year"];
                                             $selected=2016;
                                            if ($periodo==$_SESSION['fecha_factura']){
                                                $selected="selected";
                                            } else {
                                                $selected="";
                                            }
                                            ?>
                                            <option value="<?php echo $periodo?>" <?php echo $selected;?>><?php echo $fecha?></option>
                                            <?php
                                        }
                                    ?>
                                </select>


    </div>  
  </div>

  
  
  
        <hr>
        <div id="chart_div" style="width: 100%; height: 450px;"></div>
      </div>

    </div> <!-- /container -->
  
  
    
  </body>


        



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





  
<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Desembarques Pesquerias
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                 
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Desembarques
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $total1; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Polivalentes
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows9; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Cañera
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows7; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Costa Afuera
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows11; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Cerquera
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows10; ?></em>
                                    </span>
                                </a>
                               
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Palangreras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows8; ?></em>
                                    </span>
                                </a>


                            </div>
                            <!-- /.list-group -->
                            <a href="reportes_graficos/grafica_pesqueria_2018.php" class="btn btn-default btn-block">Grafico</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
      </div>




















<div class="row">
                <div class="col-lg-8">
                        

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> Descarga por Embarcacion Año 2018
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
                            <th>Embarcacion</th>
                            <th>Total de Kg Desembarcado</th>
                            <th>Porcentaje</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include("conexion.php");
                    $query = 'SELECT clientes.nombre_cliente, facturas.total_venta, facturas.numero_factura, detalle_factura.cantidad, SUM( detalle_factura.cantidad ) AS total
                                FROM detalle_factura, facturas, clientes
                                WHERE facturas.numero_factura = detalle_factura.numero_factura
                                AND clientes.id_cliente = facturas.id_cliente and year(facturas.fecha_factura)=2018
                                GROUP BY facturas.id_cliente  order by clientes.nombre_cliente';  
                    $result = mysqli_query($con, $query);
                    $c=0;
                    $a=0;
                    $total1=0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        $categoria[$c] = $row["nombre_cliente"];
                        $datos[$c] = $row["total"];   
                        $total1 = $total1 + $row["total"];
                        $c++;
                    }
                    for ($j=0;$j<=$c-1;$j++)
                    {
                        $a++;
                        echo "<tr><td>".$categoria[$j];
                        echo "<td>".$datos[$j]."</td>";
                        echo "<td>".number_format((($datos[$j]/$total1)*100), 1, ',', '')."%";
                        $por[$j]= round( ($datos[$j]/$total1)*100, 1);
                        if ($j==0)  
                        {
                            echo "<td rowspan=".$c."></tr>";
                        }
                    }
                    mysqli_close($con);       
                    ?>
                    </tbody>
                    </table>
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











































































                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notifications Panel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-warning fa-fw"></i> Server Not Responding
                                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Payment Received
                                    <span class="pull-right text-muted small"><em>Yesterday</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    







                    <div class="panel panel-default">
                     <div id="morris-area-chart"></div>
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <a href="#" class="btn btn-default btn-block">View Details</a>
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






 
