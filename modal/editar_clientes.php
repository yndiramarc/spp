	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar Embarcacion</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_cliente" name="editar_cliente">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Embarcacion</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_nombre" name="mod_nombre"  required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>
			   <div class="form-group">
				<label for="mod_telefono" class="col-sm-3 control-label">Matricula</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_telefono" name="mod_telefono" required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="mod_email" class="col-sm-3 control-label">Propietario</label>
				<div class="col-sm-8">
				 <input type="text" class="form-control" id="mod_email" name="mod_email">
				</div>
			  </div>



			   <div class="form-group">
				<label for="mod_eslora" class="col-sm-3 control-label">Eslora</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="mod_eslora" name="mod_eslora" >
				  
				</div>
			  </div>



			  <div class="form-group">
				<label for="mod_manga" class="col-sm-3 control-label">Manga</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="mod_manga" name="mod_manga" >
				  
				</div>
			  </div>




  <div class="form-group">
				<label for="mod_puntal" class="col-sm-3 control-label">Puntal</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="mod_puntal" name="mod_puntal" >
				  
				</div>
			  </div>



			  <div class="form-group">
				<label for="mod_construccion" class="col-sm-3 control-label">Año Construccion</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="mod_construccion" name="mod_construccion" >
				  
				</div>
			  </div>




<div class="form-group">
				<label for="mod_uab" class="col-sm-3 control-label">UAB</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="mod_uab" name="mod_uab" >
				  
				</div>
			  </div>



			  <div class="form-group">
				<label for="mod_capacidad_bodega" class="col-sm-3 control-label">Capacidad de Bodega</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="mod_capacidad_bodega" name="mod_capacidad_bodega" >
				  
				</div>
			  </div>



			  

			  <div class="form-group">
				<label for="mod_direccion" class="col-sm-3 control-label">Puerto Desembarque</label>
				<div class="col-sm-8">
				  
				  <select class="form-control" id="mod_direccion" name="mod_direccion" required>
					<option value="">-- Selecciona estado --</option>
					<option value="0">Cumana</option>
					<option value="1" selected>Guiria</option>
					<option value="2" selected>Carupano</option>
					<option value="3">Santa Fe</option>
					<option value="4" selected>El Morro</option>
				  	<option value="4" selected>Mariguitar</option>

				  </select>

	  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="mod_estado" class="col-sm-3 control-label">Tipo Embarcacion</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_estado" name="mod_estado" required>
					<option value="">-- Selecciona estado --</option>
					<option value="0">Cañera</option>
					<option value="1" selected>Palangrera</option>
					<option value="2" selected>Polivalente</option>
					<option value="3">Cerquera</option>
					<option value="4" selected>Costa Afuera</option>
				  

				  </select>
				</div>
			  </div>
			 
			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>