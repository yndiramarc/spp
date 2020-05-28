 
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
			$result_msg_contato = "SELECT pto_base.firstname,sum( detalle_factura.cantidad ) AS total, year(facturas.fecha_factura) AS year,

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
 FROM detalle_factura,facturas, clientes, products, pto_base
 WHERE facturas.numero_factura = detalle_factura.numero_factura and year(facturas.fecha_factura)  <= year(curdate())
 AND clientes.id_cliente = facturas.id_cliente  and facturas.id_vendedor=pto_base.user_id
and products.id_producto = detalle_factura.id_producto
 group by pto_base.firstname order by year";
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
				 
					<a href="GenerarExcelPtoBase.php"><button type='button' class='btn btn-sm btn-primary'>Generar Excel</button></a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
							
							 <th>Año</th>
                          <th>Pto Desembarque</th> 
                         <th>Total Kg</th> 
                        
                            <th>Ene</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Abr</th>
                            <th>May</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Ago</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dic</th>
								 
							</tr>
						</thead>
						<tbody>
							<?php while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){?>
								<tr>
									<td class="text-center"><?php echo $row_msg_contatos["year"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["firstname"]; ?></td>
									 <td class="text-center"><?php echo $row_msg_contatos["total"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Ene"]; ?></td>
	                                <td class="text-center"><?php echo $row_msg_contatos["Feb"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Mar"]; ?></td>
									 <td class="text-center"><?php echo $row_msg_contatos["Abr"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["May"]; ?></td>

                                    <td class="text-center"><?php echo $row_msg_contatos["Jun"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Jul"]; ?></td>
									 <td class="text-center"><?php echo $row_msg_contatos["Ago"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Sep"]; ?></td>
	                                <td class="text-center"><?php echo $row_msg_contatos["Oct"]; ?></td>
									<td class="text-center"><?php echo $row_msg_contatos["Nov"]; ?></td>
									 <td class="text-center"><?php echo $row_msg_contatos["Dic"]; ?></td>
					 


									 





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



 