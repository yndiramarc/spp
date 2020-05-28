<?php

	 
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_factura=intval($_GET['id']);
		$del1="delete from facturas where numero_factura='".$numero_factura."'";
		$del2="delete from detalle_factura where numero_factura='".$numero_factura."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  $sTable = "facturas, clientes, users";
		 $sWhere = "";
		 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= "  and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%'  or clientes.telefono_cliente like '%$q%' )";
			
		}
		
		$sWhere.=" order by facturas.numero_factura  desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './facturas.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			   <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr class='text-center'>
          <th>Número</th>
         
          <th>Fecha</th>
          <th>Desembarque</th>
           <th>Total kg</th>
          <th>Total Bs</th>
          
    
        </tr>
      </thead>
      <tbody>
    
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT facturas.total_venta, facturas.fecha_factura, detalle_factura.numero_factura, sum(detalle_factura.cantidad) as cantidad
  , GROUP_CONCAT( products.codigo_producto, '..',  
  products.nombre_producto, '..', detalle_factura.cantidad SEPARATOR '__') AS products FROM facturas 
INNER JOIN detalle_factura ON detalle_factura.numero_factura = facturas.id_factura INNER JOIN products 
ON products.id_producto = detalle_factura.id_producto GROUP BY facturas.id_factura ORDER BY facturas.id_factura;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

        <?php foreach($ventas as $facturas){ ?>
        <tr>
          <td><?php echo $facturas->numero_factura ?></td>
          <td><?php echo $facturas->fecha_factura ?></td>
          <td>
            <table class="table table-bordered">
              <thead>
                <tr class='text-center'>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Cantidad kg</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php foreach(explode("__", $facturas->products) as $productosConcatenados){ 
                $producto = explode("..", $productosConcatenados)
                ?>
                <tr>
                  <td><?php echo $producto[0] ?></td>
                  <td><?php echo $producto[1] ?></td>
                  <td><?php echo $producto[2] ?></td>
               
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </td>

            <td><?php echo $facturas->cantidad ?></td>
           <td><?php echo $facturas->total_venta ?></td>
         
         </tr>
        <?php } ?>
      </tbody>
    </table>
			</div>
			<?php
		}
	}
?>