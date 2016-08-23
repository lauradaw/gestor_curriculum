<?php
	//Iniciamos sesión
	SESSION_START();

	//Llamamos al archivo de conexión con la base de datos.
	include('conectar.php');
	//Llamamos al css
	$css = 'backoffice.css';

	//Indicamos el nombre de la página
	$pagina = "Eliminar Usuario";
	$_titulo = "Currículum";
	
	//Incluimos el archivo de funciones
	include('funciones_backoffice.php');

	//Llamamos a la función borrar.
	borrar();
?>		
