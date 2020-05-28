 <?php
include("config.php");
$c= new Buscador;
$c->Conectar();
$q = $_GET['q'];
if ($q==null) {
    print '';    
}else{
$c->Buscar($q);    
}
?> 