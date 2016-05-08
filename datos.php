<?php

	//Datos de conexión a la base de datos:
	$localhost = "localhost";
	$usuario = "root";
	$password = "";
	$bd = "curriculums";

	$_titulo = "Curriculum";
   	$_email = 'curriculum@hotmail.com';
   
	//Conexion a la bd:
	$con=mysqli_connect($localhost,$usuario,$password,$bd) or die("No se ha podido conectar con la base de datos.");
?>