<?php
	
	# conectare la base de datos
    $con=@mysqli_connect('localhost', 'root', '', 'simple_invoice');
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	
	function monto($table,$mes,$periodo){
		global $con;
		$fecha_inicial="$periodo-$mes-1";
		if ($mes==1 or $mes==3 or $mes==5 or $mes==7 or $mes==8 or $mes==10 or $mes==12){
			$dia_fin=31;
		} else if ($mes==2){
			if ($periodo%4==0){
				$dia_fin=29;	
			} else {
				$dia_fin=28;
			}
		} else {
			$dia_fin=30;
		}
		$fecha_final="$periodo-$mes-$dia_fin";
		
		$query=mysqli_query($con,"SELECT nombre_producto , sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year, month(facturas.fecha_factura) AS mes
 FROM detalle_factura,facturas, clientes, products
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura) <= year(curdate())
 AND clientes.id_cliente = facturas.id_cliente and detalle_factura.id_producto = products.id_producto and facturas.fecha_factura between '$fecha_inicial' and '$fecha_final'
and products.id_producto = detalle_factura.id_producto
 group by mes order by year(facturas.fecha_factura) 
   ");
		

  



		$row=mysqli_fetch_array($query);
		$monto=floatval($row['total']);
		 
		return $monto;
	}
?>
