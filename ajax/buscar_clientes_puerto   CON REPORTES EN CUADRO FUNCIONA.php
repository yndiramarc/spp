 
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INSOPESCA SUCRE</title>

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


    
	
		$total_pages = ceil($numrows/$per_page);
		$reload = './perfil.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);

 


		//loop through fetched data
		if ($numrows>0){
			
			?>



			 <div id="page-wrapper">
            <div class="row">
             
                <!-- /.col-lg-12 -->
           
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>  
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo 'Total registradas: ' . $numrows0; ?>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Embarcaciones</span>
                              
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>

 </div>
 
               <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>  
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo 'Total  registradas: ' . $numrows2; ?>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Embarcaciones Polivalente</span>
                              
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>

 </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>  
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo 'Total registradas: ' . $numrows3; ?>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Embarcaciones Cerqueras</span>
                              
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>

 </div>


           
     
     
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>  
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo 'Total registradas: ' . $numrows4; ?>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Embarcaciones Costa Afuera</span>
                              
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>

 </div>


                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>  
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo 'Total registradas: ' . $numrows1; ?>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Embarcaciones Palangreras</span>
                              
                                <div class="clearfix"></div>
                            </div>
                        </a>


                    </div>


   </div>   </div>   </div>   



			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>Id</th>
					<th>Nombre</th>
					<th>Matricula</th>
					<th>Propietario</th>
					<th>Puerto Desembarque</th>
					<th>Tipo Embarcacion</th>
					<th>Agregado</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_cliente=$row['id_cliente'];
						$nombre_cliente=$row['nombre_cliente'];
						$telefono_cliente=$row['telefono_cliente'];
						$email_cliente=$row['email_cliente'];
						$direccion_cliente=$row['direccion_cliente'];

					
						if ($direccion_cliente==0){$direccion="Cumana";}
						if ($direccion_cliente==1){$direccion="Guiria";}
						if ($direccion_cliente==2){$direccion="Carupano";}
						if ($direccion_cliente==3){$direccion="Santa Fe";}
						if ($direccion_cliente==4){$direccion="El Morro";}
				 	    if ($direccion_cliente==5){$direccion="Mariguitar";}



						$status_cliente=$row['status_cliente'];

					    if ($status_cliente==0){$estado="Cañera";}
						if ($status_cliente==1){$estado="Palangrero";}
						if ($status_cliente==2){$estado="Polivalente";}
						if ($status_cliente==3){$estado="Cerquera";}
						if ($status_cliente==4){$estado="Costa Afuera";}
						

						$date_added= date('d/m/Y', strtotime($row['date_added']));
						
					?>
					<input type="hidden" value="<?php echo $id_cliente;?>" id="id_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $nombre_cliente;?>" id="nombre_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $telefono_cliente;?>" id="telefono_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $email_cliente;?>" id="email_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $direccion_cliente;?>" id="direccion_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $status_cliente;?>" id="status_cliente<?php echo $id_cliente;?>">
					
					<tr>
						<td><?php echo $id_cliente; ?></td>
						<td><?php echo $nombre_cliente; ?></td>
						<td ><?php echo $telefono_cliente; ?></td>
						<td><?php echo $email_cliente;?></td>
						<td><?php echo $direccion;?></td>
						<td><?php echo $estado;?></td>
						<td><?php echo $date_added;?></td>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar cliente' onclick="obtener_datos('<?php echo $id_cliente;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Borrar cliente' onclick="eliminar('<?php echo $id_cliente; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>

 </div>


			<?php
		}
	}
?>