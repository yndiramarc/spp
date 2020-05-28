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
</head>
<body>
<div class="contenedor">
    <div id="consulta"><h1>Reporte Descarga por Embarcacion Año 2018</h1><hr>

        <table>
            <thead>
                <tr>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Numero de Embarcaciones</th>
                     <th>Total Kg </th>
                      <th>CPUE</th>
                    <th>Porcentaje</th>
                    <th>Numero Total de Embarcaciones</th>

                   
                </tr>
            </thead>
            <tbody>
            <?php
            include("conexion.php");

            $query = 'SELECT year(fecha_factura) as year, month(fecha_factura) as mes, 
            count(facturas.id_factura) as numeroEmb, sum(facturas.id_factura) as prodMes  
            FROM `facturas` WHERE year(fecha_factura)<= year(curdate()) group by mes order by year';  
            $result = mysqli_query($con, $query);

            $c=0;
            $a=0;
            $d=0;
            $total1=0;
            $cpue=0;
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $categoria[$c] = $row["year"];
                 $categoria1[$c] = $row["mes"];
                $datos[$c] = $row["numeroEmb"];   
                $total1 =  $total1+ $row["numeroEmb"];
                $totalPro[$c]= $row["prodMes"];
                $total2[$c] =  $row["numeroEmb"];
                $c++;
            }
            for ($j=0;$j<=$c-1;$j++)
            {
                $a++;

                echo "<tr><td>".$categoria[$j];
                 echo "<td>".$categoria1[$j]."</td>";
                echo "<td>".$datos[$j]."</td>";
                 echo "<td>".$totalPro[$j]."</td>";

            echo "<td>".number_format(($totalPro[$j]/$total2[$j]), 1, ',', '');
                echo "<td>".number_format((($total1 /$datos[$j])*100), 1, ',', '')."%";
                
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


















</body>
</html>