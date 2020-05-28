	<?php
		if (isset($title))
		{
	?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Sistema Gestion Pesquera</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      
    <li class="<?php echo $active_facturas;?>"><a href="desembarques.php"><i class='glyphicon glyphicon-list-alt'></i> Desembarques <span class="sr-only">(current)</span></a></li>
    <li class="<?php echo $active_productos;?>"><a href="especies.php"><i class='glyphicon glyphicon-th-list'></i> Especies</a></li>
		<li class="<?php echo $active_clientes;?>"><a href="embarcaciones.php"><i class='glyphicon glyphicon-screenshot'></i> Embarcaciones</a></li>
		<li class="<?php echo $active_usuarios;?>"><a href="ptoBase.php"><i  class='glyphicon glyphicon-globe'></i> Puertos Base</a></li>
		<li class="<?php echo $active_arte;?>"><a href="arte.php"><i  class='glyphicon glyphicon-object-align-left'></i> Arte de Pesca</a></li>
		<li class="<?php if(isset($active_perfil)){echo $active_perfil;}?>"><a href="reportes.php"><i  class='glyphicon glyphicon-duplicate'></i> Reportes</a></li>
          

        </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><label>Bienvenido(a): <?php echo $usuario; ?></label></li>
		<li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>

    </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<?php
		}
	?>