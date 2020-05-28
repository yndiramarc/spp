	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nueva Embarcacion</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Matricula</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="telefono" name="telefono" required pattern="\[A-Z]{4}\[-][0-9]{4}" title="Ingresa sólo formato correspondinete a la matricua con 4 letras guion (-) y 4 numeros (APNN-1122)" maxlength="9">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Propietario</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="email" name="email" >
				  
				</div>
			  </div>
			  


			  <div class="form-group">
				<label for="eslora" class="col-sm-3 control-label">Eslora</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="eslora" name="eslora" >
				  
				</div>
			  </div>



			  <div class="form-group">
				<label for="manga" class="col-sm-3 control-label">Manga</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="manga" name="manga" >
				  
				</div>
			  </div>




  <div class="form-group">
				<label for="puntal" class="col-sm-3 control-label">Puntal</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="puntal" name="puntal" >
				  
				</div>
			  </div>



			  <div class="form-group">
				<label for="construccion" class="col-sm-3 control-label">Año Construccion</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="construccion" name="construccion" >
				  
				</div>
			  </div>




<div class="form-group">
				<label for="uab" class="col-sm-3 control-label">UAB</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="uab" name="uab" >
				  
				</div>
			  </div>



			  <div class="form-group">
				<label for="capacidad_bodega" class="col-sm-3 control-label">Capacidad de Bodega</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="capacidad_bodega" name="capacidad_bodega" >
				  
				</div>
			  </div>









			  


			   <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Puerto Desembarque</label>
				<div class="col-sm-8">
				 <select class="form-control" id="direccion" name="direccion" required>
					

					<option value="">-- Selecciona puerto base --</option>
					<option value=0>Cuamana</option>
					<option value=1 selected>Guiria</option>
					<option value=2 selected>Carupano</option>
					<option value=3>Santa Fe</option>
					<option value=4 selected>El Morro</option>
					<option value=5>Mariguitar</option>
 

				  </select>
				</div>
	 		  </div>

 
 



		  
			  <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Tipo Embarcacion</label>
				<div class="col-sm-8">
				 <select class="form-control" id="estado" name="estado" required>
					<option value="">-- Selecciona tipo embarcacion --</option>
					
					<option value=0>Cañera</option>
					<option value=1 selected>Palangrera</option>
					<option value=2 selected>Polivalente</option>
					<option value=3>Cerquera</option>
				 	<option value=4>Costa Afuera</option>


				  </select>
				</div>
			  </div>
			 
			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>