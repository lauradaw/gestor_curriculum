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
    //Consulta para saber el tipo de usuario
	$consulta = "SELECT * from usuarios WHERE Login='$user'";
	$result_set = mysqli_query($con, $consulta) or die('Error en la consulta');
	while($row = mysqli_fetch_row($result_set)){
		@$is_admin = $row[4];
	}
    //Generamos una variable para cambiar los datos del tag <title></title>
	$pagina = "Inicio";
	//incluimos la cabecera en el php.
	include('cabecera.php');

	//Si tipo de usuario es mayor que 1 o el usuario es un visitante
	if(@$is_admin > 1 || is_null($user)){
		//Llamamos a las variables de la pag		
		echo '<article id="cuerpo">
				<h1 class="dis">' .  $slogan . '</h1>
				<h3 class="cont_slogan">' . $contenido_slogan . '</h3>
				<br />
				<div style="padding: 0px 52px; margin-bottom: 140px">' . $descripcion_tienda . '</div>
			</article>';
	}else{
		//Sino, realizará una consulta a la vista curriculums solicitando en un array todos los usuarios que tienen curriculums creados
		$consulta = "SELECT * FROM curriculums";
		$result_set = mysqli_query($con, $consulta) or die("Error en la consulta");
		while($row = mysqli_fetch_row($result_set)){
			$USERS[] = $row[1];
		}
		//Comprobará en ese array si existe el usuario logueado, si existe mostrará otra cosa.
		if(in_array($user, $USERS)){

			echo '<article id="cuerpo">
					<h1 class="dis">' . $slogan . '</h1>
					<h3 class="cont_slogan"></h3>
					<br /> 
					<div style="padding: 0px 52px; margin-bottom: 140px"></div>
				</article>';
		}else{

			//Si no hay currículum creado, mostrará lo siguiente más un botón para crear tu curriculum.		
			echo '<article id="cuerpo">
				<h1 class="dis">' .  $slogan . '</h1>
				<form action="nuevo_curriculum.php" method="POST">
					<span id="login"><button name="enviar" style="width: 250px; padding: 2px; position: fixed; margin-top: -70;" type="submit" value="Enviardatos">Nuevo Curriculum</button></span>
				</form>
				<h3 class="cont_slogan">' . $contenido_slogan . '</h3>
				<br />
				<div style="padding: 0px 52px; margin-bottom: 140px">' . $descripcion_tienda . '</div>
				</article>';
		}
	}
	//Llamamos al pie.
	include('pie.php');
?>
	</body>                                                                
</html>