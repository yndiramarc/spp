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
                    <th>Embarcacion</th>
                    <th>Total de Kg Desembarcado</th>
                    <th>Porcentaje</th>
                    <th>Total Kg </th>
                </tr>
            </thead>
            <tbody>
            <?php
            include("conexion/conexion.php");
            $query = 'SELECT clientes.nombre_cliente, facturas.total_venta, facturas.numero_factura, detalle_factura.cantidad, SUM( detalle_factura.cantidad ) AS total
						FROM detalle_factura, facturas, clientes
						WHERE facturas.numero_factura = detalle_factura.numero_factura
						AND clientes.id_cliente = facturas.id_cliente
						GROUP BY facturas.id_cliente';  
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
        <script>
        $(function () {
            var colors = Highcharts.getOptions().colors,
            categories = [<?php for($y=0; $y<=$c-1; $y++){ echo "'".$categoria[$y]."',";}?>    ],
            name = 'nombre_cliente',
            data = [
            <?php for($x=0;$x<=$c-1;$x++){ ?>    
            {
                y: <?php echo $por[$x]; ?>,
                color: colors[<?php echo $x; ?>],                    
            },  
            <?php } ?>        
            ];
            function setChart(name, categories, data, color) {
                chart.xAxis[0].setCategories(categories, false);
                chart.series[0].remove(false);
                chart.addSeries({
                    name: name,
                    data: data,
                    color: color || 'white'
                }, false);
                chart.redraw();
            }
            var chart = $('#grafica').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Porcentajes s'
                },
                xAxis: {
                    categories: categories
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    var drilldown = this.drilldown;
                                    if (drilldown) {  
                                        setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                                    } else {  
                                        setChart(name, categories, data);
                                    }
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            color: colors[0],
                            style: {
                                fontWeight: 'bold'
                            },
                            formatter: function() {
                                return this.y +' %';
                            },
                        }
                    }
                },
                series: [{
                    name: name,
                    data: data,
                    color: 'white'
                }],
                exporting: {
                    enabled: true
                }
            })
            .highcharts();  
        });
        </script>
        <div id="grafica"></div>
    </div>
</body>
</html>