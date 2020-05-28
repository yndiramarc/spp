 
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>


 



<?php

  session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
    exit;
        }
  
  /* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
  $usuario=$_SESSION['firstname'];
  $active_facturas="";
  $active_productos="";
  $active_clientes="";
  $active_usuarios="";  
  $active_arte="";
  $active_reporte="active"; 
  $title="SGP | Reportes";

  
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
  <?php
  include("navbar.php");
  ?>
  
    <div class="container">
  <div class="panel panel-info">
    <div class="panel-heading">
        <div class="btn-group pull-right">
         <a  href="reportes.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Desembarques</a>
            </div>
            <div class="btn-group pull-right">
            <a  href="reporte_embarcaciones.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Embarcaciones</a>
            </div>
            <div class="btn-group pull-right">
            <a  href="reporte_artes.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Artes de Pesca</a>
            </div>
            <div class="btn-group pull-right">
            <a  href="reporte_especies.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Especies</a>
            </div>
            <div class="btn-group pull-right">
            <a  href="reporte_ptoBase.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Puertos Bases</a>
            </div>
 <div class="btn-group pull-right">
            <a  href="indicadores2.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Indicadores de Gestion</a>
            </div>
      <h4><i class='glyphicon glyphicon-file'></i> Reportes Especies</h4>
    </div>
    <div class="panel-body">
    
    <?php
require_once("reportes_graficos/conexion/conexion.php");
?>



<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <style type="text/css">
${demo.css}
    </style>
    






 

     <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Especies Grafica
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="list-group">





<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT  facturas.total_venta, facturas.fecha_factura, detalle_factura.numero_factura, sum(detalle_factura.cantidad) as cantidad
  , GROUP_CONCAT( products.codigo_producto, '..',   
  products.nombre_producto, '..', detalle_factura.cantidad SEPARATOR '__') AS products FROM facturas 
INNER JOIN detalle_factura ON detalle_factura.numero_factura = facturas.id_factura INNER JOIN products 
ON products.id_producto = detalle_factura.id_producto GROUP BY facturas.id_factura ORDER BY facturas.id_factura;");







$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
 
    <br>
     <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr class='text-center'>
          <th>Número</th>
          <th>Fecha</th>
          <th>Desembarques</th>
           <th>Total kg</th>
          <th>Total Bs</th>
          
    
        </tr>
      </thead>
      <tbody>
        <?php foreach($ventas as $facturas){ ?>
        <tr>
          <td><?php echo $facturas->numero_factura ?></td>
          <td><?php echo $facturas->fecha_factura ?></td>
          <td>
            <table class="table table-bordered">
              <thead>
                <tr class='text-center'>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Cantidad kg</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php foreach(explode("__", $facturas->products) as $productosConcatenados){ 
                $producto = explode("..", $productosConcatenados)
                ?>
                <tr>
                  <td><?php echo $producto[0] ?></td>
                  <td><?php echo $producto[1] ?></td>
                  <td><?php echo $producto[2] ?></td>
               
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </td>
            <td><?php echo $facturas->cantidad ?></td>
           <td><?php echo $facturas->total_venta ?></td>
         
         </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php include_once "foot.php" ?>