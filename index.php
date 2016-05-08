	<?php
		//Iniciamos sesión.
		SESSION_START();
		//Incluimos el archivo datos.php que contiene los datos de conexión de la base de datos.
		include('datos.php');
		//declaramos la variable de sesión '$user' para guardar la sesión del usuario.
		$user = @$_SESSION['user'];
		//Realizamos una consulta a la base de datos para extraer los datos informativos que aparecen en la página.
		$result_set=mysqli_query($con, "SELECT * FROM datos Where categoria='Slogan'") or die("Error al realizar la consulta");
		while($row=mysqli_fetch_row($result_set)){
    	       $slogan = utf8_encode($row[2]);
    	}
    	//Realizamos una consulta a la base de datos para extraer los datos informativos que aparecen en la página.
    	$result_set=mysqli_query($con, "SELECT * FROM datos Where categoria='contenido'") or die("Error al realizar la consulta");
    	while($row=mysqli_fetch_row($result_set)){
    	    $contenido_slogan = utf8_encode($row[2]);
   	 	}
    	//Realizamos una consulta a la base de datos para extraer los datos informativos que aparecen en la página.	
    	$result_set=mysqli_query($con, "SELECT * FROM datos Where categoria='descripcion_tienda'") or die("Error al realizar la consulta");
    	while($row=mysqli_fetch_row($result_set)){
   	 	      $descripcion_tienda = utf8_encode($row[2]);
    	}
    	//Generamos una variable para cambiar los datos del tag <title></title>
		$pagina = "Inicio";
		//incluimos la cabecera en el php.
		include('cabecera.php');
		
		//Finalmente, llamamos a las variables dentro del html.
	?>
	<article id="cuerpo">
		<h1 class="dis"><?php echo $slogan; ?></h1>
		<h3 class="cont_slogan"><?php echo $contenido_slogan; ?></h3>
		<br />
		<div style="padding: 0px 52px; margin-bottom: 140px"><?php echo $descripcion_tienda ?></div>
	</article>
	<?php
		//Llamamos al pie.
		include('pie.php');
	?>
	</body>                                                                
</html>