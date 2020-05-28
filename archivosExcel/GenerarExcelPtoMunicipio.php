<?php
	session_start();
	include_once('db.php');
?>
<!DOCTYPE html>
<html lang="es-es">
	<head>
		<meta charset="utf-8">
		<title>Especies</title>
	<head>
	<body>
		<?php
		// Definimos el archivo exportado
		$arquivo = 'desembarques_pto_base.xls';
		
		// Crear la tabla HTML
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Descarga por Puertos Base</tr>';
		$html .= '</tr>';
		
			 
		$html .= '<tr>';

		$html .= '<td><b>AÑO</b></td>';
		$html .= '<td><b>Pto Desembarque</b></td>';
		$html .= '<td><b>TOTAL KG </b></td>';
		
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
		$result_msg_contatos = "SELECT sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year,
sum(CASE WHEN id_vendedor= 0 THEN detalle_factura.cantidad ELSE 0 END) AS AEB,
sum(CASE WHEN id_vendedor= 1 THEN detalle_factura.cantidad ELSE 0 END) AS Andres,
sum(CASE WHEN id_vendedor= 2 THEN detalle_factura.cantidad ELSE 0 END) AS Arismendi,
sum(CASE WHEN id_vendedor= 3 THEN detalle_factura.cantidad ELSE 0 END) AS Benitez,
sum(CASE WHEN id_vendedor= 4 THEN detalle_factura.cantidad ELSE 0 END) AS Bermudez,
sum(CASE WHEN id_vendedor= 5 THEN detalle_factura.cantidad ELSE 0 END) AS Bolivar,
sum(CASE WHEN id_vendedor= 6 THEN detalle_factura.cantidad ELSE 0 END) AS Cajigal,
sum(CASE WHEN id_vendedor= 7 THEN detalle_factura.cantidad ELSE 0 END) AS CSA,
sum(CASE WHEN id_vendedor= 8 THEN detalle_factura.cantidad ELSE 0 END) AS Libertador,
sum(CASE WHEN id_vendedor= 9 THEN detalle_factura.cantidad ELSE 0 END) AS Mariño,
sum(CASE WHEN id_vendedor= 10 THEN detalle_factura.cantidad ELSE 0 END) AS Mejia,
sum(CASE WHEN id_vendedor= 11 THEN detalle_factura.cantidad ELSE 0 END) AS Montes,
sum(CASE WHEN id_vendedor= 12 THEN detalle_factura.cantidad ELSE 0 END) AS Ribero,
sum(CASE WHEN id_vendedor= 13 THEN detalle_factura.cantidad ELSE 0 END) AS Sucre,
sum(CASE WHEN id_vendedor= 15 THEN detalle_factura.cantidad ELSE 0 END) AS Valdez
 FROM detalle_factura,facturas, clientes, products, pto_base
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura)  <= year(curdate())
 AND clientes.id_cliente = facturas.id_cliente  and facturas.id_vendedor=pto_base.user_id
and products.id_producto = detalle_factura.id_producto group by year";
		$resultado_msg_contatos = mysqli_query($conectar , $result_msg_contatos);
		
		while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){
			$html .= '<tr>';

 

            $html .= '<td>'.$row_msg_contatos["year"].'</td>';
            $html .= '<td>'.$row_msg_contatos["firstname"].'</td>';
			$html .= '<td>'.$row_msg_contatos["total"].'</td>';
		
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