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
            "theme" => "elegant"

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
                                                "theme" => "elegant"
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
                                "paletteColors"=> "#6baa01",
                                "baseFont"=> "Open Sans",
                                "theme" => "elegant"
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

      </body>
</html>