<?php
	$pagina = "Administrador";
	$banner = "Página de administración";
	include("datos.php");
	include("cabecera.php");

	$con = mysqli_connect($localhost, $usuario, $password, $bd) or die("Error al conectar con la base de datos");
	$consulta = "SELECT * FROM mantenimiento";
	$result_set = mysqli_query($con, $consulta) or die("Error al realizar la consulta");
	while($row = mysqli_fetch_array($result_set)){
		$mantenimiento = $row[2];
	}

	echo '<div id="contenedor">';
	include("menu.php");

		echo '<div id="contenedor_inicio">
				<h1>Ajustes de la web:</h1>';


	if(isset($_POST['contador'])){
		$sql = mysqli_query ($con, "TRUNCATE TABLE contador");
		echo '<script>alert("Se ha puesto a cero el contador de visitas")</script>';
	}

	if(isset($_POST['mantenimiento'])){
		if($mantenimiento == FALSE){
			$sql = mysqli_query ($con, "UPDATE mantenimiento SET mantenimiento='1'");
			echo '<script>alert("La web está actualmente en mantenimiento")</script>';
			$mantenimiento = 1;
		}
		else
		{
			$sql = mysqli_query ($con, "UPDATE mantenimiento SET mantenimiento='0'");
			echo '<script>alert("La web ya no está en modo de mantenimiento")</script>';
			$mantenimiento = 0;
		}
	}

	if($mantenimiento == FALSE){
		echo '<form action="#" method="POST"><input type="submit" name="mantenimiento" value="Poner en Mantenimiento" style="width: auto"></form>';
	}

	else{
		echo'<form action="#" method="POST"><input type="submit" name="mantenimiento" value="Salir de mantenimiento" style="width: auto"></form>';
	}

	echo'<form action="#" method="POST"><input type="submit" name="contador" value="borrar contador de visitas" style="width: auto"></form>';
				
	echo '</div></div></div>';
		
	include('pie.php');
?>