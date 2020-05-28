<?php
	session_start();
	include_once('db.php');
?>
<!DOCTYPE html>
<html lang="es-es">
	<head>
		<meta charset="utf-8">
		<title>Desembarques</title>
	<head>
	<body>
		<?php
		// Definimos el archivo exportado
		$arquivo = 'desembarques.xls';
		
		// Crear la tabla HTML
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Desembarques</tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>Nombre</b></td>';
		$html .= '<td><b>Matricula</b></td>';
		$html .= '<td><b>Bs</b></td>';
	 $html .= '<td><b>Kg</b></td>';
		$html .= '<td><b>Fecha</b></td>';
		$html .= '</tr>';
		
		//Seleccionar todos los elementos de la tabla
			$result_msg_contatos = "SELECT clientes.nombre_cliente, facturas.numero_factura, facturas.fecha_factura, clientes.telefono_cliente, facturas.total_venta, sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year
 FROM detalle_factura,facturas, clientes, products
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura)  <= year(curdate())
 AND clientes.id_cliente = facturas.id_cliente 
and products.id_producto = detalle_factura.id_producto
 group by  facturas.numero_factura order by facturas.numero_factura;
";


		$resultado_msg_contatos = mysqli_query($conectar , $result_msg_contatos);
		
		while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){
			$html .= '<tr>';

 


			$html .= '<td>'.$row_msg_contatos["numero_factura"].'</td>';
			$html .= '<td>'.$row_msg_contatos["nombre_cliente"].'</td>';
			$html .= '<td>'.$row_msg_contatos["telefono_cliente"].'</td>';
			$html .= '<td>'.$row_msg_contatos["total_venta"].'</td>';
		 	$html .= '<td>'.$row_msg_contatos["total"].'</td>';
			$data = date('d/m/Y ',strtotime($row_msg_contatos["fecha_factura"]));
			$html .= '<td>'.$data.'</td>';
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