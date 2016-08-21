<?php
	//Iniciamos sesión
	SESSION_START();

	//Llamamos al archivo de conexión con la base de datos datos.php.
	include('conectar.php');
	//Llamamos al css registro.css
	$css = 'backoffice.css';

	$pagina = "Eliminar Usuario";
	$_titulo = "Currículum";
	//metemos en una variable el parámetro get recibido de la página usuarios.php
	$identificador = $_GET['borrar'];

	//Si existe la variable de usuario, realizar consultas
	if(is_null($identificador) || empty($identificador)){
		header("Location: usuarios.php");
	}

	//Validamos que los invitados no tengan acceso así como validamos que nadie más que el administrador pueda entrar.
	if(empty($_SESSION['user']) || $_SESSION['tipo'] < 2 || $_SESSION['tipo'] > 2){
		//Envia a la página de error.
		header("Location: 404.php");
	//Si la condición anterior no se cumple... 
	}else{

		$sql = new conection();
		$conexion = $sql -> conectar();
		$consulta = $sql -> ejecutar_consulta("DELETE FROM usuarios WHERE ID =$identificador");
		
		//Si hay error en la consulta...
		if(!$consulta){
			die('Error al realizar la consulta');
			//llama a la función desconectar.
			desconectar();
		//Si no hay error...
		}else{
			echo '<script language="javascript">window.alert("¡¡Usuario Eliminado!!"); window.location="usuarios.php";</script>';
		}
	}
?>		
