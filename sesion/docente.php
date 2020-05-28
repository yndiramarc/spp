    <?php
    include("sesion_class.php");
    include("conexion.php");
    $sesion=new session_class();
     
    $cargo=$sesion->get("cargo");
    if ($cargo=='3') {//solo cambias el numero del cargo de docentes lo puse 3 en la BD
      echo "Bienvenido Profesor";
    //Insertamos todo el contenido que queremos que apresca al logearnos en la web de DOCENTE
    }else{
      echo "No eres Docente y No tienes Permiso para ver esta pagina ";
      echo "<a href =".$url."login.php"."> REGRESAR </a>";
     
    }
    ?>