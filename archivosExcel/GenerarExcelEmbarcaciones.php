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
		$arquivo = 'DesembarqueEspeciesAportacionKg.xls';
		
		// Crear la tabla HTML
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Descarga por Embarcacion</tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>Embarcacion</b></td>';
		$html .= '<td><b>TOTAL KG </b></td>';
		$html .= '<td><b>AÑO</b></td>';
	 




		$html .= '</tr>';
		
		//Seleccionar todos los elementos de la tabla
		$result_msg_contatos = "SELECT clientes.nombre_cliente, facturas.total_venta, facturas.numero_factura, detalle_factura.cantidad, 
		SUM( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) as year
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura)= year(curdate())
                        AND clientes.id_cliente = facturas.id_cliente
                        GROUP BY facturas.id_cliente  order by total  desc ";
		$resultado_msg_contatos = mysqli_query($conectar , $result_msg_contatos);
		
		while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){
			$html .= '<tr>';

 

            $html .= '<td>'.$row_msg_contatos["nombre_cliente"].'</td>';
            $html .= '<td>'.$row_msg_contatos["total"].'</td>';
			$html .= '<td>'.$row_msg_contatos["year"].'</td>';
		
		  

 
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