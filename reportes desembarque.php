 
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
            <h4><i class='glyphicon glyphicon-file'></i> Reporte Desembarques</h4>
        </div>
        <div class="panel-body">
		
		<?php
require_once("reportes_graficos/conexion/conexion.php");
?>



<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		





 



 <div >
                <div >
                        

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> Desembarques
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
                        <?php
//including FusionCharts PHP Wrapper
include("fusioncharts/fusioncharts.php"); 
$hostdb   = "localhost"; // MySQl host
$userdb   = "root"; // MySQL username
$passdb   = ""; // MySQL password
$namedb   = "simple_invoice"; // MySQL database name

//Establish connection with the database
$dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

//Validating DB Connection
if ($dbhandle->connect_error) {
    exit("There was an error with your connection: " . $dbhandle->connect_error);
}

?>

<html>
   <head>
       <!-- FusionCharts Core Package File -->
      <script src="fusioncharts/js/fusioncharts.js"></script> 
      <script type="text/javascript" src="fusioncharts/js/elegant.js"></script>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

  </head>

<?php

//SQL Query for the Parent chart.
$strQuery = "SELECT year(facturas.fecha_factura) AS year, SUM( detalle_factura.cantidad ) AS total
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura
                        AND clientes.id_cliente = facturas.id_cliente
                        GROUP BY year";

//Execute the query, or else return the error message.
$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

//If the query returns a valid response, preparing the JSON array.
if ($result) {
    //`$arrData` holds the Chart Options and Data.
    $arrData = array(
        "chart" => array(
            "caption" => "Descarga Por Año",
            "xAxisName"=> "Año",
            "yAxisName"=> "Kg",
            "paletteColors"=> "#008ee4",
            "yAxisMaxValue"=> "50000",
            "baseFont"=> "Open Sans",
            "theme" => " "

        )
    );

    //Create an array for Parent Chart.
    $arrData["data"] = array();

    // Push data in array.
    while ($row = mysqli_fetch_array($result)) {
        array_push($arrData["data"], array(
            "label" => $row["year"],
            "value" => $row["total"],
            //Create link for yearly drilldown as "2011"
            "link" => "newchart-json-" . $row["year"]
        ));

    }

    //Data for Linked Chart will start from here, SQL query from mesly_sales table 
  //  $year = 2017;
    $strmesly = "SELECT   year(facturas.fecha_factura) as year, 
                month(facturas.fecha_factura) as mes, 
                sum(detalle_factura.cantidad ) as total FROM detalle_factura,facturas, clientes 
                WHERE facturas.numero_factura = detalle_factura.numero_factura           
       AND clientes.id_cliente = facturas.id_cliente  group by year, mes ";
                               
      
                        


    $resultmesly = $dbhandle->query($strmesly) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    //If the query returns a valid response, preparing the JSON array.
        if ($resultmesly) {
        $arrData["linkeddata"] = array(); //"linkeddata" is responsible for feeding data and chart options to child charts.
        $arrDataMonth[2011]["linkeddata"] = array();
        $arrDataMonth[2012]["linkeddata"] = array();
        $arrDataMonth[2013]["linkeddata"] = array();
        $arrDataMonth[2014]["linkeddata"] = array();
        $arrDataMonth[2015]["linkeddata"] = array();
        $arrDataMonth[2016]["linkeddata"] = array();
        $arrDataMonth[2017]["linkeddata"] = array();
        $arrDataMonth[2018]["linkeddata"] = array();
        $arrDataMonth[2019]["linkeddata"] = array();
        $i = 0;        
        if ($resultmesly) {
            while ($row = mysqli_fetch_array($resultmesly)) {
                //Collect the Year for which mesly drilldown will be created
                $year = $row['year'];

                //Create the monthly drilldown data                
                $arrMonthHeader[$year][$row["mes"]] = array();
                $arrMonthData[$year][$row["mes"]] = array();

                // Retrieve monthly data based on year and mes
                $strMonthly = "SELECT   year(facturas.fecha_factura) as year, 
                month(facturas.fecha_factura) as mes, 
                sum(detalle_factura.cantidad ) as Cantidad
                               FROM detalle_factura,facturas, clientes
      WHERE facturas.numero_factura = detalle_factura.numero_factura AND clientes.id_cliente = facturas.id_cliente group by year, mes";   
                               
            $resultMonthly = $dbhandle->query($strMonthly) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

                //Loop through monthly results 
                 while ($rowMonthly = mysqli_fetch_assoc($resultMonthly)) {
                        //Create the monthly data for each mes
                        if($rowMonthly['mes'] == $row["mes"])
                        {
                            array_push($arrMonthData[$year][$row["mes"]], array(
                                    "label" => $rowMonthly["mes"],
                                    "value" => $rowMonthly["Cantidad"]
                                ));
                        }
                    }
                    //Create the data for monthly drilldown
                    $arrMonthHeader[$year][$row["mes"]] = array(
                                        //Create the unique link id's provided from mesly data as "2011Q1"
                                        "id" => $year . $row['mes'],
                                        //Create the data for the monthly charts for each mes
                                        "linkedchart" => array(
                                            "chart" => array(
                                                //Create dynamic caption based on the year and mes
                                                "caption" => "Kg por mes ".$row["mes"]." of $year",
                                                "xAxisName"=> "Mes",
                                                "yAxisName"=> "Kg",
                                                "paletteColors"=> "#f5555C",
                                                "baseFont"=> "Open Sans",
                                                "theme" => " "
                                            ),
                                        "data" => $arrMonthData[$year][$row["mes"]]    
                                        )                    
                                    );
                     //Finally push the data created into linkeddata node. Now our linked data for monthly drilldown for each mes is ready
                     array_push($arrDataMonth[$year]["linkeddata"],$arrMonthHeader[$year][$row["mes"]]);

                //Create the linkeddata for mesly drilldown    
                //If the linnkeddata for a mes of a year is ready and the year matches 
                 if (isset($arrData["linkeddata"][$i-1]) && $arrData["linkeddata"][$i-1]["id"] == $year) {                    
                    if($row["mes"] == 'Q4'){
                        array_push($arrData["linkeddata"][$i-1]["linkedchart"]["data"], array(
                            "label" => $row["mes"],
                            "value" => $row["Cantidad"],
                            //Create the link for mesly drilldown as "newchart-json-2011Q1"
                            "link" => "newchart-json-" . $year . $row["mes"]
                        ));    
                    //If we've reached the last mes, append the data created for monthly drilldown
                     $arrData["linkeddata"][$i-1]["linkedchart"] = array_merge($arrData["linkeddata"][$i-1]["linkedchart"],$arrDataMonth[$year]);
                    }                    
                    else{
                        array_push($arrData["linkeddata"][$i-1]["linkedchart"]["data"], array(
                            "label" => $row["mes"],
                            "value" => $row["total"],
                            //Create the link for mesly drilldown as "newchart-json-2011Q1"
                            "link" => "newchart-json-" . $year . $row["mes"]
                        ));

                    }
                }
                //Inititate the linked data for mesly drilldown
                else {

                    array_push($arrData["linkeddata"], array(
                        "id" => "$year",
                        "linkedchart" => array(
                            "chart" => array(
                                //Create dynamic caption based on the year
                                "caption" => "Descarga Año $year",
                                "xAxisName"=> "Mes",
                                "yAxisName"=> "Kg",
                                "paletteColors"=> "",
                                "baseFont"=> "Open Sans",
                                "theme" => " "
                            ),
                            "data" => array(
                                array(
                                    "label" => $row["mes"],
                                    "value" => $row["total"],
                                    //Create the link for mesly drilldown as "newchart-json-2011Q1"
                                    "link" => "newchart-json-" . $year . $row["total"]
                                )
                            )
                        )

                    ));

                    $i++;
                }

            }

        }

       //Convert the array created into JSON as our chart would recieve the dat ain JSON
        $jsonEncodedData = json_encode($arrData);

        $columnChart = new FusionCharts("column2d", "myFirstChart" , "300%", "500", "linked-chart", "json", "$jsonEncodedData"); 

        $columnChart->render();    //Render Method

        $dbhandle->close(); //Closing DB Connection

    }



}
?> 

     <body>
     <!-- DOM element for Chart -->
     <?php echo "<script type=\"text/javascript\" >
               FusionCharts.ready(function () {
            FusionCharts('myFirstChart').configureLink({     
            overlayButton: {            
            message: 'Regresar',
            padding: '13',
            fontSize: '16',
            fontColor: '#F7F3E7',
            bold: '0',
            bgColor: '#22252A',           
            borderColor: '#D5555C'         }     });
             });
            </script>" 
?>
         <div style="width:300px;" ><center><div id="linked-chart"></div></center></div>

 
<script src="reportes_graficos/Highcharts-4.1.5/js/highcharts.js"></script>
<script src="reportes_graficos/Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="reportes_graficos/Highcharts-4.1.5/js/modules/exporting.js"></script>


  
    </body>
</html>
 

                </div>
                <div id="grafica"></div>
                <div  ></div>
         



  

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
                    $query = ' SELECT  sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year,
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
                        
                       
                          
                        echo "<tr><td>".$categoria[$j];
                         echo "<td>".$categoria2[$j];
                        
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






 
