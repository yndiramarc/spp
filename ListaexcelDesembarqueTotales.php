
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
 


<?php

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
    $usuario=$_SESSION['firstname'];
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
		$active_usuarios1="";	
	$active_arte="";
	$title="SGP | Desembarques ";
?>

		
			
			
		 <!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>
	
    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
 			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Descargar Archivos Excel  Desembarques</h4>
		</div>
		<div class="panel-body">
		
			
			
		 <?php
	 
	include_once('db.php');
 ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
	 
	<head>
	<body>
 
<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
<!--Inicio elementos contenedor-->

		<?php
			//Verificar se esta sendo passado na URL a página atual, senão é atribuido a pagina
			$pagina=(isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
			
			//Selecionar todos os itens da tabela 
			$result_msg_contato = "SELECT * FROM facturas ";
			$resultado_msg_contato = mysqli_query($conectar , $result_msg_contato);
			
			//Contar o total de itens
			$total_msg_contatos = mysqli_num_rows($resultado_msg_contato);
			
			//Seta a quantidade de itens por página
			$quantidade_pg = 20;
			
			//calcular o número de páginas 
			$num_pagina = ceil($total_msg_contatos/$quantidade_pg);
			
			//calcular o inicio da visualizao	
			$inicio = ($quantidade_pg*$pagina)-$quantidade_pg;
			
			//Selecionar  os itens da página
			$result_msg_contatos = " SELECT clientes.nombre_cliente, facturas.numero_factura, facturas.fecha_factura, clientes.telefono_cliente, facturas.total_venta, sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year
 FROM detalle_factura,facturas, clientes, products
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura)  <= year(curdate())
 AND clientes.id_cliente = facturas.id_cliente 
and products.id_producto = detalle_factura.id_producto
 group by  facturas.numero_factura order by facturas.numero_factura, year;
";
			$resultado_msg_contatos = mysqli_query($conectar , $result_msg_contatos);
			$total_msg_contatos = mysqli_num_rows($resultado_msg_contatos);
			
		?>
		<div class="container theme-showcase" role="main">
			 
			 
			<div class="row espaco">
				<div >					
				 
			 <center>		<a href="../SGP2/archivosExcel/GenerarExcel.php"><button type='button' class='btn btn-sm btn-primary'>Generar Excel</button></a></center>

				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
							
								<th class="text-center">Id</th>
								<th class="text-center">Nombres</th>
								<th class="text-center">Matricula</th>
								<th class="text-center">Bs</th>
						        <th class="text-center">Kg</th>
								<th class="text-center">Insertado</th>
								 
							</tr>
						</thead>
						<tbody>
							<?php while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){?>
								<tr>
									<td class="text-center"><?php echo $row_msg_contatos["numero_factura"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["nombre_cliente"]; ?></td>
									 <td class="text-center"><?php echo $row_msg_contatos["telefono_cliente"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["total_venta"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["total"]; ?></td>
								 
									<td class="text-center"><?php echo date('d/m/Y ',strtotime($row_msg_contatos["fecha_factura"])); ?></td>
									<td class="text-center">								
										
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			
			<?php
				//Verificar pagina anterior e posterior
				$pagina_anterior = $pagina - 1;
				$pagina_posterior = $pagina + 1;
			?>
			<nav class="text-center">
				<ul class="pagination">
					<li>
						<?php 
							if($pagina_anterior != 0){
								?><a href="#?link=50&pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								</a><?php
							}else{
								?><span aria-hidden="true">&laquo;</span><?php
							}
						?>
					</li>
					<?php
						//presentar paginacion
						for($i = 1; $i < $num_pagina + 1; $i++){
							?>
								<li><a href="#?link=50&pagina=<?php echo $i; ?>">
									<?php echo $i; ?>
								</a></li>
							<?php
						}
					?>
					<li>
						<?php 
							if($pagina_posterior <= $num_pagina){
								?><a href="#?link=50&pagina=<?php echo $pagina_posterior; ?>" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a><?php
							}else{
								?><span aria-hidden="true">&raquo;</span><?php
							}
						?>
					</li>
				</ul>
			</nav>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

<!--Fin elementos contenedor-->
</div>
</div>
  </div>
</div>
<div class="panel-footer">
  <div class="container">
    
  </div>
</div>

</body>
</html>

				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
					
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/arte.js"></script>
  </body>
</html>




 