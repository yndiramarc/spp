<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Estadístias PHP - JS</title>
<link rel="stylesheet" href="estilo.css" />
<script src="Highcharts-6.1.0/code/js/jquery.min.js"></script>
<script src="Highcharts-6.1.0/code/js/highcharts.js"></script>
<script src="Highcharts-6.1.0/code/js/themes/grid.js"></script>
<script src="Highcharts-6.1.0/code/js/modules/exporting.js"></script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Reporte Total de Kg Desembarcados por Embarcaciones 2018</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
${demo.css}
        </style>



 

<div class="contenedor">
    <div id="consulta"><h1>Reporte Descarga por Embarcacion Año 2018</h1><hr>

        <table>
            <thead>
                <tr>
                    <th>Embarcacion</th>
                    <th>Total de Kg Desembarcado</th>
                    <th>Porcentaje</th>
                    <th>Total Kg </th>
                </tr>
            </thead>
            <tbody>
            <?php
            include("conexion.php");
            $query = 'SELECT clientes.nombre_cliente, facturas.total_venta, facturas.numero_factura, detalle_factura.cantidad, SUM( detalle_factura.cantidad ) AS total
						FROM detalle_factura, facturas, clientes
						WHERE facturas.numero_factura = detalle_factura.numero_factura
						AND clientes.id_cliente = facturas.id_cliente
						GROUP BY facturas.id_cliente  order by total  desc';  
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
                    echo "</td><td rowspan=".$c.">".$total1."</td></tr>";
                }
            }
            mysqli_close($con);       
            ?>
            </tbody>
            </table>
        </div>
       
        <div id="grafica"></div>
    </div>








<div class="contenedor">
    <div id="consulta"><h1>Reporte Descarga por Especie Año 2018</h1><hr>

        <table>
            <thead>
                <tr>
                    <th>Embarcacion</th>
                    <th>Total de Kg Desembarcado</th>
                    <th>Porcentaje</th>
                    <th>Total Kg </th>
                </tr>
            </thead>
            <tbody>
            <?php
            include("conexion.php");
            $query = 'SELECT products.nombre_producto, sum( detalle_factura.cantidad ) AS total
                        FROM detalle_factura, products
                        WHERE detalle_factura.id_producto = products.id_producto
                        GROUP BY products.nombre_producto  order by total  desc';  
            $result = mysqli_query($con, $query);
            $c=0;
            $a=0;
            $total1=0;
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $categoria[$c] = $row["nombre_producto"];
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
                    echo "</td><td rowspan=".$c.">".$total1."</td></tr>";
                }
            }
            mysqli_close($con);       
            ?>
            </tbody>
            </table>
        </div>
       
        <div id="grafica"></div>
    </div>


 

      <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Reporte % de Kg Desembarcados por Embarcaciones 2018'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'plotShadow',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Desembarques',
            data: [
               
                <?php
                $sql=mysql_query("SELECT clientes.nombre_cliente, SUM( detalle_factura.cantidad ) AS total
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura
                        AND clientes.id_cliente = facturas.id_cliente
                        GROUP BY facturas.id_cliente ");
                while($res=mysql_fetch_array($sql)){
                ?>
               
                ['<?php echo $res['nombre_cliente']; ?>', <?php echo $res['total']; ?> ],       
                
                
                 <?php
        }
                ?>
                                                    
                
            ]
        }]
    });
});


        </script>
       









<body>
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<br><br>

<center><a href="ejemplo.php"> ejemplo3 </a></center>
<center><a href="ejemplo7.php"> ejemplo7 </a></center>
    </body>








 
</html>

</head>