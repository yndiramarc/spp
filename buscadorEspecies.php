 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>


<body width="616" height="47">
<form action="buscar.php" method="post">
Buscar: <input name="palabra">
<input type="submit" id="buscador" value="Buscar">
</form>
<p>



 <?php


/*Establece la conexion MySQL*/
$conexion = mysqli_connect("localhost","root","","simple_invoice");
$buscador=intval($_REQUEST['buscador']);
if ($_POST['buscador'])
{
// Tomamos el valor ingresado
$buscar = $_POST['palabra'];

// Si está vacío, lo informamos, sino realizamos la búsqueda
if(empty($buscar))
{
echo "No se ha ingresado una cadena a buscar";
}else{

/*Cadenas SQL que se van a ejecutar*/
$sql = "SELECT * FROM detalle_factura where numero_factura='$buscar';";
$sql .= "SELECT SUM( cantidad ) as resultado
FROM detalle_factura where numero_factura='$buscar'
GROUP BY numero_factura";

if( $conexion->multi_query($sql) )
{
 do
{
   /* obtiene el resultado de la consulta*/
        if ($result = $conexion->store_result())
        {
          /*Obtiene los nombres de los campos*/
          $campos = $result->fetch_fields();
            echo '<table> <tr>';
            for($i = 0; $i < count($campos); $i++)
            {
            /*Muestra los nombres de los campos*/
              echo '<td>'.$campos[$i]->name.'</td>';
            }
            echo '<tr>';
           
          /*Lee un registro mientras no sea el final*/
          while ($fila = $result->fetch_row())
            {
                echo '<tr>';
             for($i = 0; $i < count($campos); $i++)
              {
               /*Muestra el contenido de los campos */
               echo '<td>'.$fila[$i].'</td>';  
             }
             echo '</tr>';
            }
            echo '</table>';
            /*cierra la conexion*/
            $result->close();
        }
    } while ($conexion->next_result()); /*Vuelve al ciclo miestras haya otro resultado*/
}}}
?> 