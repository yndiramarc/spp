<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['nombre'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$estado=mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
		$date_added=date("Y-m-d");

        $eslora=mysqli_real_escape_string($con,(strip_tags($_POST["eslora"],ENT_QUOTES)));
		$manga=mysqli_real_escape_string($con,(strip_tags($_POST["manga"],ENT_QUOTES)));
		$puntal=mysqli_real_escape_string($con,(strip_tags($_POST["puntal"],ENT_QUOTES)));
		$construccion=mysqli_real_escape_string($con,(strip_tags($_POST["construccion"],ENT_QUOTES)));
		$uab=mysqli_real_escape_string($con,(strip_tags($_POST["uab"],ENT_QUOTES)));
		$capacidad_bodega=mysqli_real_escape_string($con,(strip_tags($_POST["capacidad_bodega"],ENT_QUOTES)));







		$sql="INSERT INTO clientes (nombre_cliente, telefono_cliente, email_cliente, direccion_cliente, status_cliente, date_added, eslora, manga, puntal, construccion, uab, capacidad_bodega) VALUES ('$nombre','$telefono','$email','$direccion','$estado','$date_added','$eslora','$manga','$puntal','$construccion','$uab','$capacidad_bodega')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Cliente ha sido ingresado satisfactoriamente.";
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