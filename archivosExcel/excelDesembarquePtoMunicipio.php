 
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
			<h4><i class='glyphicon glyphicon-search'></i> Descargar Archivos Excel</h4>
		</div>
		<div class="panel-body">
		
			
			
		 <?php
	 
	include_once('db.php');
 ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Desembarques</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
	<head>
	<body>
 
<div>

  <div>
    <div >
<div >
<!--Inicio elementos contenedor-->

		<?php
			//Verificar se esta sendo passado na URL a página atual, senão é atribuido a pagina
			$pagina=(isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
			
			//Selecionar todos os itens da tabela 
			$result_msg_contato = "SELECT sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year,
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
and products.id_producto = detalle_factura.id_producto group by year order by id_vendedor ";
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
			$result_msg_contatos = "SELECT * FROM detalle_factura,facturas, clientes, products, pto_base limit $inicio, $quantidade_pg";
			$resultado_msg_contatos = mysqli_query($conectar , $result_msg_contatos);
			$total_msg_contatos = mysqli_num_rows($resultado_msg_contatos);
			
		?>
		<div class="container theme-showcase" role="main">
			 
			 
			<div class="row espaco">
				<div >					
				 
					<a href="GenerarExcelPtoMunicipio.php"><button type='button' class='btn btn-sm btn-primary'>Generar Excel</button></a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
							
						  <th>Año</th>
                         <th>Total Kg</th> 
                         
                            <th>Andres</th>
                            <th>Arismendi</th>
                            <th>Benitez</th>
                            <th>Bermudez</th>
                            <th>Bolivar</th>
                            <th>Cajigal</th>
                            <th>CSA</th>
                        
                            <th>Mariño</th>
                            <th>Mejia</th>
                            <th>Montes</th>
                            <th>Ribero</th>
                            <th>Sucre</th>
                          <th>Valdez</th>
								 
							</tr>
						</thead>
						<tbody>
							<?php while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){?>
								<tr>
									<td class="text-center"><?php echo $row_msg_contatos["year"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["total"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Andres"]; ?></td>
									 <td class="text-center"><?php echo $row_msg_contatos["Arismendi"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Benitez"]; ?></td>
	                                <td class="text-center"><?php echo $row_msg_contatos["Bermudez"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Bolivar"]; ?></td>
									 <td class="text-center"><?php echo $row_msg_contatos["Cajigal"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["CSA"]; ?></td>

                                    <td class="text-center"><?php echo $row_msg_contatos["Mariño"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Mejia"]; ?></td>
									 <td class="text-center"><?php echo $row_msg_contatos["Montes"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Ribero"]; ?></td>
	                                <td class="text-center"><?php echo $row_msg_contatos["Sucre"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Valdez"]; ?></td>
								 
					 


									 





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
								?><a href="administrativo.php?link=50&pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
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
								<li><a href="administrativo.php?link=50&pagina=<?php echo $i; ?>">
									<?php echo $i; ?>
								</a></li>
							<?php
						}
					?>
					<li>
						<?php 
							if($pagina_posterior <= $num_pagina){
								?><a href="administrativo.php?link=50&pagina=<?php echo $pagina_posterior; ?>" aria-label="Next">
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



 