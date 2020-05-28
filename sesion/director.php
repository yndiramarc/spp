    <?php
    include("sesion_class.php");//incluimos el sesion_start que sta dentro de esta
    include("conexion.php");//inclui esta para lo del $url -No es necesario
    $sesion=new session_class();
     
     
    $cargo=$sesion->get("cargo"); //cargamos la variable cargo de login.php
    $usuario=$sesion->get("usuario");//Esto sirve para trabajar con el usuario en la pagina
    if ($cargo=='4') {  //y la condicional IF que es lo que le hace funcional al sistema 
      echo "Bienvenido Director";
    // aqui insertamos todo lo que queremos que aparesca en la WEB del DIRECTOR
    }else{
      echo "No eres Director y No tienes Permiso para ver esta pagina ";
      echo "<a href =".$url."login.php"."> REGRESAR </a>";
    }
    ?>