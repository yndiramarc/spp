    <?php
        require_once("sesion_class.php");
        
        $sesion = new sesion();
        $usuario = $sesion->get("usuario"); 
        if( $usuario == false )
        {   
            header("Location: login.php");
        }
        else 
        {
            $usuario = $sesion->get("usuario"); 
            $sesion->borrarsesion();    
            header("location: login.php");
        }
    ?>