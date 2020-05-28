<?php
	
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");
if (!empty($id) and !empty($cantidad) and !empty($precio_venta))
{
$insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id) VALUES ('$id','$cantidad','$precio_venta','$session_id')");

}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_tmp=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM tmp WHERE id_tmp='".$id_tmp."'");
}
$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
?>
	<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>Id</th>
					<th>Kg</th>
					<th>Especie</th>
					<th>Precio Unit.</th>                   
					<th class='text-right'>Total Bs</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
<?php
	$sumador_total=0;
	$sumador_cant=0;
	$sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
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



		?>
		<tr>
			<td class='text-left'><?php echo $codigo_producto;?></td>
			<td ><?php echo $cantidad;?></td>
			<td ><?php echo $nombre_producto;?></td>
			<td class='text-left'><?php echo $precio_venta_f;?></td>
			<td class='text-right' ><?php echo $precio_total_f;?></td>
			<td class='text-right'><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}
	$impuesto=get_row('perfil','impuesto', 'id_perfil', 1);
	$subtotal=number_format($sumador_total,2,'.','');
	$subtotal2=number_format($sumador_cant,2,'.','');
	

	 
	$total_factura=$subtotal;

?>
<tr>
	<td class='text-right' colspan=4>TOTAL Bs</td>
	<td class='text-right'><?php echo number_format($subtotal,2);?></td>
	<td></td>
</tr>

<tr>
	<td class='text-right' colspan=4>TOTAL Kg </td>
	<td class='text-right'><?php echo number_format($subtotal2,2);?></td>
	<td></td>
</tr>


</table>
