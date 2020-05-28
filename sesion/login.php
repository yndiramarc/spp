    <?php
        require_once("sesion_class.php");
      include("conexion.php");
     
        $sesion = new session_class();
        
        if( isset($_POST["iniciar"]) )
        {
            
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
        $cargo    = $_POST['cargo'];
            
            if(validarUsuario($usuario,$password,$cargo) == true){          
                
          
          $sesion->set("usuario",$usuario);
              $sesion->set("cargo",$cargo);

                
          if ($cargo=='4') {
            header("location: director.php");//index del director
     
          }
          if ($cargo=='3') {//index de los docente
            header("location: docente.php");
     
          }
          if ($cargo=='2') {//index de estudiantes
            header("location: estudiante.php");
     
          }
                
            }
            else 
            {
                echo "<div class='row-fluid'>"."<div class='col-md-4 col-md-offset-4'>";
          echo "<p class='error'>"."Estimado Usuario "."<br>"."<stron>"."Verifica tu nombre de usuario, contrase&ntilde;a y el Cargo"."</strong>"."</p>";
          echo "</div>"."</div";
            }
        }
        
        function validarUsuario($usuario, $password, $cargo)
        {
            $conexion = new mysqli("localhost","root","","simple_invoice");
            $consulta = "SELECT contrasenia FROM login_admin WHERE nick = '$usuario' AND cargo='$cargo';";
            
            $result = $conexion->query($consulta);
            
            if($result->num_rows > 0)
            {
                $fila = $result->fetch_assoc();
                if( strcmp($password,$fila["contrasenia"]) == 0 )
                    return true;                        
                else                    
                    return false;
            }
            else
                    return false;
        }
     
    ?>
    <!DOCTYPE html>
    <html lang="es">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>::PANEL ADMINISTRATIVO::</title>
     
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
     <!-- Bootstrap -->
      </head>
      <body>
     
      
        </tr>
      </tbody>
    </table>
    <div class="row-fluid">
        <div class="col-md-4 col-md-offset-4">
        <table class="table table-striped table-bordered table-condensed table-hover">
      
      <thead>
        <tr>
          <th colspan="2" class="ingreso"><H2>INGRESO SOLO ADMINISTRADORES</H2></th>
        </tr>
      </thead>
        <tbody>
          <form name="frmLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                
                    <tr>
                      <td><label for="exampleInputEmail1">C&oacute;digo de Usuario:</label></td>
                       <td>   <input type="text" class="form-control" id="exampleInputEmail1" name="usuario" placeholder="Ej. 5232120"/ autofocus></td>
                    </tr> 
                </div>
                   <div class="form-group">
                   <tr>
                         <td> <label for="exampleInputPassword1">Contrase&ntilde;a:</label></td>
                          <td><input type="password" class="form-control" id="exampleInputPassword1" name="password"/></td>
                  </tr>
                  <tr>
                         <td> <label for="exampleInputPassword1">Cargo:</label></td>
                          <td><select name="cargo" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="4">Director</option>
                            <option value="3">Docente</option>
                            <option value="2">Estudiante</option>                       
                          </td>
                  </tr>
                 </div>
                 <tr>
                 <td><a href="http://localhost/colegio/index.php"><button class="btn btn-success btn-lg"type="button">REGRESAR</button></a></td>
                  <td ><input type="submit" class="btn btn-primary btn-lg"name ="iniciar" value="INGRESAR"/> </td>
                  </tr>
            </form>
          </tbody>   
          </div>
    </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
      
      </body>
    </html>