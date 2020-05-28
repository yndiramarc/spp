<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
              <td style="width: 50%; text-align: right">
                    &copy; <?php echo "Gerencia de Ordenacion Pesquera Sucre    "; echo  $anio=date('d/m/Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <?php include("encabezado_factura.php");?>
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>Datos Desembarque</td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php 
				$sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
				echo "Nombre Embarcacion: ";
				echo $rw_cliente['nombre_cliente'];
				echo "<br> Matricula: ";
				echo $rw_cliente['telefono_cliente'];
				echo "<br>Propietario: ";
				echo $rw_cliente['email_cliente'];
			 
				
				
			?>
			
		   </td>
        </tr>
        
   
    </table>
    
       <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:35%;" class='midnight-blue'>Puerto de desembarque</td>
		  <td style="width:25%;" class='midnight-blue'>Fecha</td>
		   <td style="width:40%;" class='midnight-blue'>Tipo Embarcacion</td>
        </tr>
		<tr>
           <td style="width:35%;">
			<?php 
				$sql_user=mysqli_query($con,"select * from pto_base where user_id='$id_vendedor'");
				$rw_user=mysqli_fetch_array($sql_user);
				echo $rw_user['firstname'];
			?>
		   </td>
		  <td style="width:25%;">
		  	
				<?php 
				$sql_fecha=mysqli_query($con,"SELECT * from facturas, detalle_factura where facturas.numero_factura = detalle_factura.numero_factura and id_cliente='$id_cliente'");
				$rw_fecha=mysqli_fetch_array($sql_fecha);
				 
				echo $rw_fecha['fecha_factura'];
				 
				
			?>



		  </td>
		   <td style="width:40%;" >
				<?php 
	                  
	              if ($condiciones==0){echo "Cañera";}
				elseif ($condiciones==1){echo "Palangrero";}
				elseif ($condiciones==2){echo "Polivalente";}
				elseif ($condiciones==3){echo "Cerquera";}
				elseif ($condiciones==4){echo "Costa Afuera";}
			 
				?>
		   </td>
        </tr>
		
        
   
    </table>
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 10%;text-align:center" class='midnight-blue'>Kg</th>
            <th style="width: 60%" class='midnight-blue'>ESPECIE</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sumador_cant=0;
$sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'"   );
while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_producto'];
	
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador


$cantidad=$row['cantidad_tmp'];
	$precio_cant_f=number_format($cantidad,2);//Formateo variables
	$precio_cant_r=str_replace(",","",$precio_cant_f);//Reemplazo las comas

	$precio_cant_f=number_format($precio_cant_f,2);//Precio total formateado
	$precio_cant_r=str_replace(",","",$precio_cant_f);//Reemplazo las comas
	$sumador_cant+=$precio_cant_r;//Sumador









	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}
	?>

        <tr>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td class='<?php echo $clase;?>' style="width: 60%; text-align: left"><?php echo $nombre_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>

	<?php 
	//Insert en la tabla detalle_cotizacion
	$insert_detail=mysqli_query($con, "INSERT INTO detalle_factura VALUES ('','$numero_factura','$id_producto','$cantidad','$precio_venta_r')");
	
	$nums++;
	}
	$impuesto=get_row('perfil','impuesto', 'id_perfil', 1);
	$subtotal=number_format($sumador_total,2,'.','');
	$subtotal2=number_format($sumador_cant,2,'.','');
	

	 
	$total_factura=$subtotal;
?>
	  
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;"><strong>TOTAL Bs</strong> </td>
            <td style="widtd: 15%; text-align: right;"> <strong><?php echo number_format($subtotal,2);?></strong></td>
        </tr>
		 
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;"><strong>TOTAL Kg </strong></td>
            <td style="widtd: 15%; text-align: right;"> <strong><?php echo number_format($subtotal2,2);?></strong></td>
        </tr>
    </table>
	
	
	
	<br>
	 
	
	
	  

</page>

<?php
$date=date("Y-m-d H:i:s");
$insert=mysqli_query($con,"INSERT INTO facturas VALUES (NULL,'$numero_factura','$date','$id_cliente','$id_vendedor','$condiciones','$total_factura','1')");
$delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$session_id."'");
?>