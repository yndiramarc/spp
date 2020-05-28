 
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
            <h4><i class='glyphicon glyphicon-file'></i> Reportes Especies</h4>
        </div>
        <div class="panel-body">
		
		<?php
require_once("reportes_graficos/conexion/conexion.php");
?>



<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Reporte Kg Desembarcado por Especies</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		





 



 <div >
                <div >
                        

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> Especies Kilogramos
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
                        url: 'chartEspeciesAno.php',
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
        <div id="chart_div" style="width: 100%; height: 100%;"></div>
      </div>

    </div> <!-- /container -->
  
  
    
  </body>


        



    </head>
    <body>
<script src="reportes_graficos/Highcharts-4.1.5/js/highcharts.js"></script>
<script src="reportes_graficos/Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="reportes_graficos/Highcharts-4.1.5/js/modules/exporting.js"></script>

 
 
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

 


 <div>
                <div >
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Especies Kg
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
                        <th>Especie</th>
                        <th>Total Kg</th>
                        <th>Año</th>
                         
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
                    $query = 'SELECT  nombre_producto , sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year,
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
 FROM detalle_factura,facturas, clientes, products
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura) <= year(curdate())
 AND clientes.id_cliente = facturas.id_cliente and detalle_factura.id_producto = products.id_producto
and products.id_producto = detalle_factura.id_producto
 group by nombre_producto, year order by year(facturas.fecha_factura)';  
                    $result = mysqli_query($con, $query);
                    $c=0;
                    $a=0;
                    $b=0;
                    $total1=0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                         
                        $categoria[$c] = $row["year"];
                         $categoria1[$c] = $row["nombre_producto"];
                           $categoria2[$c] = $row["total"];
                           $categoria2[$c]=number_format($categoria2[$c],2, ",", ".");//Formateo variables


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
                        
                        echo "<tr><td>".$categoria1[$j];
                          echo "<td>".$categoria2[$j];
                        echo "<td>".$categoria[$j];
                         
                        
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
                      

                     
                    }
                    mysqli_close($con);       
                    ?>
                    </tbody>
                    </table>

                          </div>
 
                        </div>
                        <!-- /.panel-body -->
              <center> <a href="../SGP2/archivosExcel/GenerarExcelEspecie.php"><button type='button' class='btn btn-sm btn-primary' class="text-center">Generar Excel</button></a></center>

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






 
