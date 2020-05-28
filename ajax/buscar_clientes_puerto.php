 
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


	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_cliente=intval($_GET['id']);
		$query=mysqli_query($con, "select * from clientes where id_cliente='".$id_cliente."'");
		$count=mysqli_num_rows($query);

		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM clientes WHERE id_cliente='".$id_cliente."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar esta embarcacion. Existen desembarques vinculados a esta embarcacion. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('direccion_cliente');//Columnas de busqueda
		 $sTable = "clientes";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by id_cliente";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/

		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];



		$count_query0   = mysqli_query($con, "SELECT count(*) AS numrows0 FROM clientes");
		$row0= mysqli_fetch_array($count_query0);
		$numrows0 = $row0['numrows0'];




		$count_query1   = mysqli_query($con, "SELECT count(*) AS numrows1 FROM clientes  Where status_cliente='1'");
		$row1= mysqli_fetch_array($count_query1);
		$numrows1 = $row1['numrows1'];

	    $count_query2   = mysqli_query($con, "SELECT count(*) AS numrows2 FROM clientes  Where status_cliente='2'");
		$row2= mysqli_fetch_array($count_query2);
		$numrows2 = $row2['numrows2'];


        $count_query3   = mysqli_query($con, "SELECT count(*) AS numrows3 FROM clientes  Where status_cliente='3'");
		$row3= mysqli_fetch_array($count_query3);
		$numrows3 = $row3['numrows3'];


		$count_query4   = mysqli_query($con, "SELECT count(*) AS numrows4 FROM clientes  Where status_cliente='4'");
		$row4= mysqli_fetch_array($count_query4);
		$numrows4 = $row4['numrows4'];


        $count_query5   = mysqli_query($con, "SELECT count(*) AS numrows5 FROM clientes  Where status_cliente='0'");
        $row5= mysqli_fetch_array($count_query5);
        $numrows5 = $row5['numrows5'];



    
	
		$total_pages = ceil($numrows/$per_page);
		$reload = './perfil.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);

 


		//loop through fetched data
		if ($numrows>0){
			
			?>



 <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Embarcaciones
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                 
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Embarcaciones
                                    <span class="pull-right text-muted small"><em><?php echo 'Total registradas: ' . $numrows0; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Polivalentes
                                    <span class="pull-right text-muted small"><em><?php echo 'Total registradas: ' . $numrows2; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Cerqueras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total registradas: ' . $numrows3; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Costa Afuera
                                    <span class="pull-right text-muted small"><em><?php echo 'Total registradas: ' . $numrows4; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Palangreras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total registradas: ' . $numrows1; ?></em>
                                    </span>
                                </a>
                               
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Cañeras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total registradas: ' . $numrows5; ?></em>
                                    </span>
                                </a>


                            </div>
                            <!-- /.list-group -->
                            <a href="reportes_graficos/ejemplo1.php" class="btn btn-default btn-block">Grafico1</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
      </div>










  <?php
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
            require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

           


                $count_query6   = mysqli_query($con, "SELECT clientes.nombre_cliente, facturas.total_venta, facturas.numero_factura, detalle_factura.cantidad, 
                        SUM( detalle_factura.cantidad ) AS total1
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura
                        AND clientes.id_cliente = facturas.id_cliente");
                $row6= mysqli_fetch_array($count_query6);
                $total1 = $row6['total1'];



                $count_query7   = mysqli_query($con, "SELECT condiciones, SUM( detalle_factura.cantidad ) AS numrows7
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and condiciones=0
                        AND clientes.id_cliente = facturas.id_cliente ");
                $row7= mysqli_fetch_array($count_query7);
                $numrows7 = $row7['numrows7'];


                $count_query8   = mysqli_query($con, "SELECT condiciones, SUM( detalle_factura.cantidad ) AS numrows8
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and condiciones=1
                        AND clientes.id_cliente = facturas.id_cliente ");
                $row8= mysqli_fetch_array($count_query8);
                $numrows8 = $row8['numrows8'];



                $count_query9   = mysqli_query($con, "SELECT condiciones, SUM( detalle_factura.cantidad ) AS numrows9
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and condiciones=2
                        AND clientes.id_cliente = facturas.id_cliente ");
                $row9= mysqli_fetch_array($count_query9);
                $numrows9 = $row9['numrows9'];



                $count_query10   = mysqli_query($con, "SELECT condiciones, SUM( detalle_factura.cantidad ) AS numrows10
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and condiciones=3
                        AND clientes.id_cliente = facturas.id_cliente ");
                $row10= mysqli_fetch_array($count_query10);
                $numrows10 = $row10['numrows10'];



                $count_query11   = mysqli_query($con, "SELECT condiciones, SUM( detalle_factura.cantidad ) AS numrows11
                        FROM detalle_factura, facturas, clientes
                        WHERE facturas.numero_factura = detalle_factura.numero_factura and condiciones=4
                        AND clientes.id_cliente = facturas.id_cliente ");
                $row11= mysqli_fetch_array($count_query11);
                $numrows11 = $row11['numrows11'];






   
            ?>


 

 
<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Desembarques
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                 
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Desembarques
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $total1; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Polivalentes
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows9; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Cerqueras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows10; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Costa Afuera
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows11; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Palangreras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows8; ?></em>
                                    </span>
                                </a>
                               
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Cañeras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows7; ?></em>
                                    </span>
                                </a>


                            </div>
                            <!-- /.list-group -->
                            <a href="reportes_graficos/ejemplo.php" class="btn btn-default btn-block">Grafico</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
      </div>




<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Desembarques
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                 
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Desembarques
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $total1; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Polivalentes
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows9; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Cerqueras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows10; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Costa Afuera
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows11; ?></em>
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Palangreras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows8; ?></em>
                                    </span>
                                </a>
                               
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Cañeras
                                    <span class="pull-right text-muted small"><em><?php echo 'Total Kg: ' . $numrows7; ?></em>
                                    </span>
                                </a>


                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">Grafico</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
      </div>

















                        <!-- /.panel-body -->
                    </div>








































   </div>   </div>   </div>   


 

 



			<?php
		}
	}
?>