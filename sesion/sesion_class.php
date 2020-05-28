    ?>
        <?php
        class session_class{
            function __construct(){
                session_start();
            }
            public function set($nombre, $valor){
                $_SESSION[$nombre] = $valor;
            }
            public function get($nombre){
                if (isset ($_SESSION[$nombre])) {
                    return $_SESSION[$nombre];
                }else{
                    return "No existe la variable";
                }
            }
            public function borrar_variable($nombre){
                unset ($_SESSION[$nombre]);
            }
            public function borrar_variables_sesion(){
                $_SESSION = array();
            }
            public function borrarsesion(){
                borrar_variables_sesion();
                session_destroy();
            }
        }
    ?>