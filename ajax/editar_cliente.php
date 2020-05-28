<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if ($_POST['mod_estado']==""){
			$errors[] = "Selecciona";
		}  else if (
			!empty($_POST['mod_id']) && !empty($_POST['mod_nombre']) && $_POST['mod_estado']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["mod_telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["mod_email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_direccion"],ENT_QUOTES)));
		$estado=intval($_POST['mod_estado']);


		$eslora=mysqli_real_escape_string($con,(strip_tags($_POST["mod_eslora"],ENT_QUOTES)));
		$manga=mysqli_real_escape_string($con,(strip_tags($_POST["mod_manga"],ENT_QUOTES)));
		$puntal=mysqli_real_escape_string($con,(strip_tags($_POST["mod_puntal"],ENT_QUOTES)));
		$construccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_construccion"],ENT_QUOTES)));
 		$uab=mysqli_real_escape_string($con,(strip_tags($_POST["mod_uab"],ENT_QUOTES)));
        $capacidad_bodega=mysqli_real_escape_string($con,(strip_tags($_POST["mod_capacidad_bodega"],ENT_QUOTES)));



		
		$id_cliente=intval($_POST['mod_id']);
		$sql="UPDATE clientes SET nombre_cliente='".$nombre."', telefono_cliente='".$telefono."', email_cliente='".$email."', direccion_cliente='".$direccion."', status_cliente='".$estado."', eslora='".$eslora."', manga='".$manga."', puntal='".$puntal."', construccion='".$construccion."', uab='".$uab."', capacidad_bodega='".$capacidad_bodega."' WHERE id_cliente='".$id_cliente."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La embarcacion ha sido actualizada satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>