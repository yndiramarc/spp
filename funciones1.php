<?php
function fecha_actual(){
    /*Codigo simple "Hora,Dia,Año"
    --------------------------------
    Php - Code
    */
    //Variables
    $anios = date ("Y");
    $mesesitos = date ("m");
    $dias = date ("d");
    //Mesesitos
    if ($mesesitos == 1) {    $mesesitos = "Enero";    }
    if ($mesesitos == 2) {    $mesesitos = "Febrero";    }
    if ($mesesitos == 3) {    $mesesitos = "Marzo";    }
    if ($mesesitos == 4) {    $mesesitos = "Abril";    }
    if ($mesesitos == 5) {    $mesesitos = "Mayo";    }
    if ($mesesitos == 6) {    $mesesitos = "Junio";    }
    if ($mesesitos == 7) {    $mesesitos = "Julio";    }
    if ($mesesitos == 8) {    $mesesitos = "Agosto";    }
    if ($mesesitos == 9) {    $mesesitos = "Septiembre";    }
    if ($mesesitos == 10) {    $mesesitos = "Octubre";    }
    if ($mesesitos == 11) {    $mesesitos = "Noviembre";    }
    if ($mesesitos == 12) {    $mesesitos = "Diciembre";    }
    echo " ".$dias." de ".$mesesitos." de ".$anios;
}
///////////////////////////////////////////////////
//Convierte fecha de mysql a normal
////////////////////////////////////////////////////
function Fecha_To_Normal($fecha){
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
}
////////////////////////////////////////////////////
//Convierte fecha de normal a mysql
////////////////////////////////////////////////////
function Fecha_To_mysql($fecha){
	ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
    return $lafecha;
}
function ver_arreglo($arreglo,$parar=0){
	echo "<pre>";
	//print_r(convertArrayKeysToUtf8($arreglo));
	print_r($arreglo);
	echo "</pre>";
	if ($parar==1){
		die();
	}
}
/*
 * PERMITE CONECTARSE A UNA BD MYSQL
 */
function conectar() {
	//echo "paso1";
	$connx = mysql_connect(dbhost,dbuser);
	mysql_select_db(dbname,$connx);
	if (!$connx)
		$connx="false";		
	return $connx;
}
/*
 * PERMITE EJECUTAR UNA CONSULTA SQL
 */
function consultar($sql, $conexion){
	$resultado = mysql_query ($sql, $conexion) or die(mysql_error());
	return $resultado;
}
/*
 * RETORNA NUMERO DE FILAS OBTENIDAS DE UN RESULTADO
 */
function numresult($resultado) {
	$number = mysql_num_rows ($resultado);
	return $number;
}
/* UNICAS
* RETORNA UNA FILA CON EL ARRAY DE DATOS DE UNA CONSULTA MYSQL
* mysql_fetch_array($result)
*/
function dato_consulta($resultado){
	//echo "dato_consulta";
	$row = mysql_fetch_array($resultado);
	return $row;
}
/* UNICAS
* RETORNA UNA FILA CON EL ARRAY DE DATOS ASOCIATIVO DE UNA CONSULTA MYSQL
* mysql_fetch_assoc($result)
*/
function dato_consulta_assoc($result){
	$dato = mysql_fetch_assoc($result);
	return $dato;
}
/**CONSULTAS MULTIPLES EN ARREGLOS TODOS LSO REGISTROS**/
function datos_consultas_assoc($result){
	while ($fila = mysql_fetch_assoc($result)) { 
		$dato[] = $fila ; 
	}	
	return $dato;
}
/*
* RETORNA UN ARRAY ASOCIATIVO CON TODOS LOS DATOS DE UNA CONSULTA MYSQL
*/
function datos_consultas_array($result){
	while ($fila = mysql_fetch_assoc($result)) { 
		$dato[] = $fila ; 
	}	
	return $dato;
}
/*
* RETORNA UN ARRAY NUMERICO CON TODOS LOS DATOS DE UNA CONSULTA MYSQL
*/
function datos_consultas_row($result){
	while ($fila =mysql_fetch_row($result)) { 
		$dato[] = $fila ; 
	}	
	return $dato;
}
function datos_consultas_numeric($result){
	while ($fila =mysql_fetch_row($result)) { 
		$dato[] = $fila ; 
	}	
	return $dato;
}
/*
 * Ultimo valor de un registro
 */
function ultimo_registro($tabla){
	$conexion = conectar();
	$sql= "SELECT * FROM $tabla ORDER BY id DESC LIMIT 1";
	$resultado = @consultar($sql, $conexion);
	$dato = dato_consulta($resultado);	
	return $dato;  
}
/*
 * Contar cantidad de registros de una tabla segun un criterio
 * Parametros:
 *  - Tabla
 *  - Columna
 *  - Valor
 */
function contador_registros($tabla,$columna="",$valor=""){
	$conexion = conectar();
	$sql= "SELECT * FROM $tabla WHERE $columna = $valor";	
	$resultado = @consultar($sql, $conexion);
	$dato = numresult($resultado);
	return $dato;  
}
// LIBERA UN RESULTADO
function liberar($result) {
	if ($result) {
		mysql_free_result($result);
	}
}
//******************************************************************************
// FUNCIONES PARA CREACIÓN DE ELEMENTOS HTML
//******************************************************************************
/*
 * create_table($titulo="",$header="", $arreglo, $estilo="")
 * Permite crear una tabla html
 * @param {String} $titulo Titulo de la tabla
 * @param {String} $header Array con encabezados de columna
 * @param {Array} $arreglo Array con la tabla de datos
 * @param {String} $estilo Estilo de la tabla 
 */
function create_table_totales($titulo="",$header="", $arreglo, $estilo="",$total1="",$total2="",$tamano="600px"){
	//print_r($titulo);
	//echo "<br>";
	//print_r($header);
	//echo "<br>";
	//print_r($arreglo);
	//echo "<br>";
	//echo  count($arreglo);
	//echo "<br>";
	//print_r($arreglo);	
	$estilo = "style='border:1px solid; border-collapse: collapse; font-weight:bold; text-align:center;padding: 5px 5px 5px 5px;'";
	$estilo1 = "style='border:1px solid; border-collapse: collapse; padding: 5px 5px 5px 5px;'";
	$estilo2 = "style='border:1px solid; border-collapse: collapse; padding: 5px 5px 5px 5px;'";
	//CREAR TABLA
	//$tabla = @sprintf("<table id='tb_tabla' class='tb_tabla' width='95%' $estilo1 >\n");
	$tabla = @sprintf("<table id='tb_tabla' class='tb_tabla' width='$tamano' $estilo1 >\n");
	//FILA PARA IMPRIMIR EL TITULO
	if ($titulo!="") {
		$tabla.= sprintf("<tr id='tb_titulo' class='tb_titulo' $estilo >\n ");
		//$tabla.= sprintf("'%s'>\n",$estilo);
		$tabla.= sprintf("<td $estilo colspan=".count($header).">".$titulo."</td>\n");
		$tabla.=sprintf("</tr\n");    
	}
	//FILA PARA IMPRIMIR EL ENCABEZADO
	if ($header!="") {
		$tabla.= sprintf("<tr id='header' class='header' $estilo1 >\n");
		for ($j=0;$j<count($header);$j++) {
			//$tabla.= sprintf("<td $estilo> ".$header[$j]."</td>\n");
			$tabla.= sprintf("<td $estilo > ".$header[$j]."</td>\n");            
		}	
		$tabla.= sprintf("</tr>\n");
	}
	//FILA/COLUMNA PARA IMPRIMIR EL CONTENIDO DE LA TABLA
	for ($i=0;$i<count($arreglo);$i++) {
		$tabla.= sprintf("<tr >\n");
		for ($f=0;$f<count($arreglo[$i]);$f++) {
			$tabla.= sprintf("<td $estilo1 > ".$arreglo[$i][$f]." </td>\n");
		}
		$tabla.= sprintf("</tr>\n");
	}
        $tabla.= sprintf("<tr >\n");
            $tabla.= sprintf("<td $estilo1 ><b>Totales</b></td>\n");
			$tabla.= sprintf("<td $estilo1 ><b>".$total1."</b></td>\n");
            $tabla.= sprintf("<td $estilo1 ><b>".$total2."</b></td>\n");
		$tabla.= sprintf("</tr>\n");
	$tabla.= sprintf("</table>\n");
	echo $tabla;
}
/*
 * create_table($titulo="",$header="", $arreglo, $estilo="")
 * Permite crear una tabla html
 * @param {String} $titulo Titulo de la tabla
 * @param {String} $header Array con encabezados de columna
 * @param {Array} $arreglo Array con la tabla de datos
 * @param {String} $estilo Estilo de la tabla 
 */
function create_table_pescadores($titulo="",$header="", $arreglo, $estilo="",$total1="",$tamano="600px"){
	//print_r($titulo);
	//echo "<br>";
	//print_r($header);
	//echo "<br>";
	//print_r($arreglo);
	//echo "<br>";
	//echo  count($arreglo);
	//echo "<br>";
	//print_r($arreglo);	
	$estilo = "style='border:1px solid; border-collapse: collapse; font-weight:bold; text-align:center;padding: 5px 5px 5px 5px;'";
	$estilo1 = "style='border:1px solid; border-collapse: collapse; padding: 5px 5px 5px 5px;'";
	$estilo2 = "style='border:1px solid; border-collapse: collapse; padding: 5px 5px 5px 5px;'";
	//CREAR TABLA
	//$tabla = @sprintf("<table id='tb_tabla' class='tb_tabla' width='95%' $estilo1 >\n");
	$tabla = @sprintf("<table id='tb_tabla' class='tb_tabla' width='$tamano' $estilo1 >\n");
	//FILA PARA IMPRIMIR EL TITULO
	if ($titulo!="") {
		$tabla.= sprintf("<tr id='tb_titulo' class='tb_titulo' $estilo >\n ");
		//$tabla.= sprintf("'%s'>\n",$estilo);
		$tabla.= sprintf("<td $estilo colspan=".count($header).">".$titulo."</td>\n");
		$tabla.=sprintf("</tr\n");    
	}
	//FILA PARA IMPRIMIR EL ENCABEZADO
	if ($header!="") {
		$tabla.= sprintf("<tr id='header' class='header' $estilo1 >\n");
		for ($j=0;$j<count($header);$j++) {
			//$tabla.= sprintf("<td $estilo> ".$header[$j]."</td>\n");
			$tabla.= sprintf("<td $estilo > ".$header[$j]."</td>\n");            
		}	
		$tabla.= sprintf("</tr>\n");
	}
	//FILA/COLUMNA PARA IMPRIMIR EL CONTENIDO DE LA TABLA
	for ($i=0;$i<count($arreglo);$i++) {
		$tabla.= sprintf("<tr >\n");
		for ($f=0;$f<count($arreglo[$i]);$f++) {
			$tabla.= sprintf("<td $estilo1 > ".$arreglo[$i][$f]." </td>\n");
		}
		$tabla.= sprintf("</tr>\n");
	}
        $tabla.= sprintf("<tr >\n");
            $tabla.= sprintf("<td $estilo1 ><b>Totales</b></td>\n");
			$tabla.= sprintf("<td $estilo1 ><b>".$total1."</b></td>\n");
		$tabla.= sprintf("</tr>\n");
	$tabla.= sprintf("</table>\n");
	echo $tabla;
}
/*
 * create_table($titulo="",$header="", $arreglo, $estilo="")
 * Permite crear una tabla html
 * @param {String} $titulo Titulo de la tabla
 * @param {String} $header Array con encabezados de columna
 * @param {Array} $arreglo Array con la tabla de datos
 * @param {String} $estilo Estilo de la tabla 
 */
function create_table_prod_mensual($titulo="",$header="", $arreglo, $estilo="",$total1="",$total2="",$tamano="600px",$columnas=""){
	//print_r($titulo);
	//echo "<br>";
	//print_r($header);
	//echo "<br>";
	//print_r($arreglo);
	//echo "<br>";
	//echo  count($arreglo);
	//echo "<br>";
	//print_r($arreglo);	
	$estilo = "style='border:1px solid; border-collapse: collapse; font-weight:bold; text-align:center;padding: 5px 5px 5px 5px;'";
	$estilo1 = "style='border:1px solid; border-collapse: collapse; padding: 5px 5px 5px 5px;'";
	$estilo2 = "style='border:1px solid; border-collapse: collapse; padding: 5px 5px 5px 5px;'";
	//CREAR TABLA
	//$tabla = @sprintf("<table id='tb_tabla' class='tb_tabla' width='95%' $estilo1 >\n");
	$tabla = @sprintf("<table id='tb_tabla' class='tb_tabla' width='$tamano' $estilo1 >\n");
	//FILA PARA IMPRIMIR EL TITULO
	if ($titulo!="") {
		$tabla.= sprintf("<tr id='tb_titulo' class='tb_titulo' $estilo >\n ");
		//$tabla.= sprintf("'%s'>\n",$estilo);
		$tabla.= sprintf("<td $estilo colspan=".count($header).">".$titulo."</td>\n");
		$tabla.=sprintf("</tr\n");    
	}
	//FILA PARA IMPRIMIR EL ENCABEZADO
	if ($header!="") {
		$tabla.= sprintf("<tr id='header' class='header' $estilo1 >\n");
		for ($j=0;$j<count($header);$j++) {
			//$tabla.= sprintf("<td $estilo> ".$header[$j]."</td>\n");
			$tabla.= sprintf("<td $estilo > ".$header[$j]."</td>\n");            
		}	
		$tabla.= sprintf("</tr>\n");
	}
	//FILA/COLUMNA PARA IMPRIMIR EL CONTENIDO DE LA TABLA
	for ($i=0;$i<count($arreglo);$i++) {
		$tabla.= sprintf("<tr >\n");
		for ($f=0;$f<count($arreglo[$i]);$f++) {
			$tabla.= sprintf("<td $estilo1 > ".$arreglo[$i][$f]." </td>\n");
		}
		$tabla.= sprintf("</tr>\n");
	}
        $tabla.= sprintf("<tr >\n");
            if ($columnas!=""){
                $tabla.= sprintf("<td $estilo1 colspan='$columnas' >&nbsp;</td>\n");
            }
            //$tabla.= sprintf("<td $estilo1 >&nbsp;</td>\n");
            //$tabla.= sprintf("<td $estilo1 >&nbsp;</td>\n");
            //$tabla.= sprintf("<td $estilo1 >&nbsp;</td>\n");
            //$tabla.= sprintf("<td $estilo1 >&nbsp;</td>\n");
            $tabla.= sprintf("<td $estilo1 ><b>Totales</b></td>\n");
			$tabla.= sprintf("<td $estilo1 ><b>".$total1."</b></td>\n");
            $tabla.= sprintf("<td $estilo1 ><b>".$total2."</b></td>\n");
		$tabla.= sprintf("</tr>\n");
	$tabla.= sprintf("</table>\n");
	echo $tabla;
}
/*
 *
 *
 *
 *
 *
 *
 * create_table($titulo="",$header="", $arreglo, $estilo="")
 * Permite crear una tabla html
 * @param {String} $titulo Titulo de la tabla
 * @param {String} $header Array con encabezados de columna
 * @param {Array} $arreglo Array con la tabla de datos
 * @param {String} $estilo Estilo de la tabla 
 */
function create_table($titulo="",$header="", $arreglo, $estilo="",$tamaño="100%"){
	$estilo = "style='border:1px solid; border-collapse: collapse; font-weight:bold; text-align:center;padding: 5px 5px 5px 5px;'";
	$estilo1 = "style='border:1px solid; border-collapse: collapse; padding: 5px 5px 5px 5px;'";
	$estilo2 = "style='border:1px solid; border-collapse: collapse; padding: 5px 5px 5px 5px;'";
	//CREAR TABLA
	//$tabla = @sprintf("<table id='tb_tabla' class='tb_tabla' width='95%' $estilo1 >\n");
	$tabla = @sprintf("<table id='tb_tabla' class='tb_tabla' width='$tamaño' $estilo1 >\n");
	//FILA PARA IMPRIMIR EL TITULO
	if ($titulo!="") {
		$tabla.= sprintf("<tr id='tb_titulo' class='tb_titulo' $estilo >\n ");
		//$tabla.= sprintf("'%s'>\n",$estilo);
		$tabla.= sprintf("<td $estilo colspan=".count($header).">".$titulo."</td>\n");
		$tabla.=sprintf("</tr\n");    
	}
	//FILA PARA IMPRIMIR EL ENCABEZADO
	if ($header!="") {
		$tabla.= sprintf("<tr id='header' class='header' $estilo1 >\n");
		for ($j=0;$j<count($header);$j++) {
			//$tabla.= sprintf("<td $estilo> ".$header[$j]."</td>\n");
			$tabla.= sprintf("<td $estilo > ".$header[$j]."</td>\n");            
		}	
		$tabla.= sprintf("</tr>\n");
	}
	//FILA/COLUMNA PARA IMPRIMIR EL CONTENIDO DE LA TABLA
	for ($i=0;$i<count($arreglo);$i++) {
		$tabla.= sprintf("<tr >\n");
		for ($f=0;$f<count($arreglo[$i]);$f++) {
			$tabla.= sprintf("<td $estilo1 > ".$arreglo[$i][$f]." </td>\n");
		}
		$tabla.= sprintf("</tr>\n");
	}
	$tabla.= sprintf("</table>\n");
    echo $tabla;
}
function create_table_fotos($titulo="",$header="", $arreglo, $estilo="",$tamaño="100%"){
	$estilo = "style='border:1px solid; border-collapse: collapse; font-weight:bold; text-align:center;padding: 5px 5px 5px 5px;'";
	$estilo1 = "style='border:1px solid; border-collapse: collapse; padding: 5px 5px 5px 5px;'";
	$estilo2 = "style='border:1px solid; border-collapse: collapse; padding: 5px 5px 5px 5px;'";
	//CREAR TABLA
	//$tabla = @sprintf("<table id='tb_tabla' class='tb_tabla' width='95%' $estilo1 >\n");
	$tabla = @sprintf("<table id='tb_tabla' class='tb_tabla' width='$tamaño' $estilo1 >\n");
	//FILA PARA IMPRIMIR EL TITULO
	if ($titulo!="") {
		$tabla.= sprintf("<tr id='tb_titulo' class='tb_titulo' $estilo >\n ");
		//$tabla.= sprintf("'%s'>\n",$estilo);
		$tabla.= sprintf("<td $estilo colspan=".count($header).">".$titulo."</td>\n");
		$tabla.=sprintf("</tr\n");    
	}
	//FILA PARA IMPRIMIR EL ENCABEZADO
	if ($header!="") {
		$tabla.= sprintf("<tr id='header' class='header' $estilo1 >\n");
		for ($j=0;$j<count($header);$j++) {
			//$tabla.= sprintf("<td $estilo> ".$header[$j]."</td>\n");
			$tabla.= sprintf("<td $estilo > ".$header[$j]."</td>\n");            
		}	
		$tabla.= sprintf("</tr>\n");
	}
	//FILA/COLUMNA PARA IMPRIMIR EL CONTENIDO DE LA TABLA
	for ($i=0;$i<count($arreglo);$i++) {
		$tabla.= sprintf("<tr >\n");
		for ($f=0;$f<count($arreglo[$i]);$f++) {
            if ($f==0) {
                $file = "fotos/".$arreglo[$i][$f].".jpg";
                if (file_exists($file)) {
                   // existe
                } else {
                    $file = "fotos/perfil.jpg";
                }
                $foto = "<img src='$file' style='width: 45px; height: 60px;'>";
                //$foto = "<img src='$file' style='width: 60px; height: 80px;'>";
                $tabla.= sprintf("<td $estilo1 > <center>".$foto." </center></td>\n");
            }else{
                $tabla.= sprintf("<td $estilo1 > ".$arreglo[$i][$f]." </td>\n");
            }
		}
		$tabla.= sprintf("</tr>\n");
	}
	$tabla.= sprintf("</table>\n");
    echo $tabla;
}

/*
 * Permite generar un valor (password) aleatorio
 */
function PwdAleatorio($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE){   
    $source = 'abcdefghijklmnopqrstuvwxyz';   
    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';   
    if($n==1) $source .= '1234567890';   
    if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';   
    if($length>0){   
        $rstr = "";   
        $source = str_split($source,1);  
        for($i=1; $i<=$length; $i++){  
            mt_srand((double)microtime() * 1000000);  
            $num = mt_rand(1,(count($source)-1));  
            $rstr .= $source[$num-1];  
        }  
    }  
    return $rstr;  
}
//******************************************************************************
//FUNCIONES PARA TRATAMIENTO DE VALORES NUMERICOS
//******************************************************************************
/*
 * Redondea un valor a dos decimales
 */
function redondear_dos_decimal($valor) {
    $float_redondeado=round($valor * 100) / 100;
    return $float_redondeado;
}
?>