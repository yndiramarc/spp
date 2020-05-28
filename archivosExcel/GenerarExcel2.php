<?php
	session_start();
	include_once('db.php');
?>
<!DOCTYPE html>
<html lang="es-es">
	<head>
		<meta charset="utf-8">
		<title>Contacto</title>
	<head>
	<body>
		<?php
		// Definimos el archivo exportado
		$arquivo = 'desembarques.xls';
		
		// Crear la tabla HTML
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Descarga por Año</tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>AÑO</b></td>';
		$html .= '<td><b>TOTAL KG</b></td>';
		$html .= '<td><b>Ene</b></td>';
		$html .= '<td><b>Feb</b></td>';
		$html .= '<td><b>Mar</b></td>';
        $html .= '<td><b>Abr</b></td>';
		$html .= '<td><b>May</b></td>';
		$html .= '<td><b>Jun</b></td>';
  		$html .= '<td><b>Jul</b></td>';
		$html .= '<td><b>Ago</b></td>';
 		$html .= '<td><b>Sep</b></td>';
		$html .= '<td><b>Oct</b></td>';
 		$html .= '<td><b>Nov</b></td>';
		$html .= '<td><b>Dic</b></td>';





		$html .= '</tr>';
		
		//Seleccionar todos los elementos de la tabla
		$result_msg_contatos = "SELECT year(facturas.fecha_factura) AS year, month(facturas.fecha_factura) AS mes, SUM( detalle_factura.cantidad ) AS kg,
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
               group by  year ";
		$resultado_msg_contatos = mysqli_query($conectar , $result_msg_contatos);
		
		while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){
			$html .= '<tr>';

 


			$html .= '<td>'.$row_msg_contatos["year"].'</td>';
			$html .= '<td>'.$row_msg_contatos["kg"].'</td>';
			$html .= '<td>'.$row_msg_contatos["Ene"].'</td>';
            $html .= '<td>'.$row_msg_contatos["Feb"].'</td>';
            $html .= '<td>'.$row_msg_contatos["Mar"].'</td>';
            $html .= '<td>'.$row_msg_contatos["Abr"].'</td>';
            $html .= '<td>'.$row_msg_contatos["May"].'</td>';
            $html .= '<td>'.$row_msg_contatos["Jun"].'</td>';
            $html .= '<td>'.$row_msg_contatos["Jul"].'</td>';
            $html .= '<td>'.$row_msg_contatos["Ago"].'</td>';
            $html .= '<td>'.$row_msg_contatos["Sep"].'</td>';
            $html .= '<td>'.$row_msg_contatos["Oct"].'</td>';
            $html .= '<td>'.$row_msg_contatos["Nov"].'</td>';
            $html .= '<td>'.$row_msg_contatos["Dic"].'</td>';

 
 		$html .= '</tr>';
			;
		}
		// Configuración en la cabecera
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generado Data" );
		// Envia contenido al archivo
		echo $html;
		exit; ?>
	</body>
</html>