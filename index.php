<?php
	$_titulo = "Currículum";
	$pagina = "Inicio";
	//incluimos la cabecera en el php.
	include('cabecera.php');

	//Creamos un nuevo objeto sql.
	$sql = new conection();
	//Realizamos la conexión llamando a la función conectar().
	$conexion = $sql -> conectar();
	//Realizamos la consulta.
	$consulta = $sql->ejecutar_consulta("SELECT * FROM datos Where categoria='Slogan");
	
	//Comprobamos que la consulta se haya realizado correctamente.		
	if(!$consulta){
		die('Error al realizar la consulta');
		//llama a la función desconectar.
		desconectar();
	}else{
		while($row=mysqli_fetch_array($consulta)){
    		$slogan = utf8_encode($row['contenido']);
    	}
	}

	//Creamos un nuevo objeto sql.
	$sql = new conection();
	//Realizamos la conexión llamando a la función conectar().
	$conexion = $sql -> conectar();
	$consulta = $sql->ejecutar_consulta("SELECT * FROM datos Where categoria='contenido'");
	
	//Comprobamos que la consulta se haya realizado correctamente.		
	if(!$consulta){
		die('Error al realizar la consulta');
		//llama a la función desconectar.
		desconectar();
	}else{
		while($row=mysqli_fetch_array($consulta)){
    		$contenido_slogan = utf8_encode($row['contenido']);
    	}
	}

	//Creamos un nuevo objeto sql.
	$sql = new conection();
	//Realizamos la conexión llamando a la función conectar().
	$conexion = $sql -> conectar();
	$consulta = $sql->ejecutar_consulta("SELECT * FROM datos Where categoria='descripcion_tienda'");
	
	//Comprobamos que la consulta se haya realizado correctamente.		
	if(!$consulta){
		die('Error al realizar la consulta');
		//llama a la función desconectar.
		desconectar();
	}else{
		while($row=mysqli_fetch_array($consulta)){
    		$descripcion_tienda = utf8_encode($row['contenido']);
    	}
	}
	
	if(!empty($_SESSION['user']) && !empty($_SESSION['tipo'])){
	
		//Creamos un nuevo objeto sql.
		$sql = new conection();
		//Realizamos la conexión llamando a la función conectar().
		$conexion = $sql -> conectar();
		//Realizamos la consulta.
		$consulta = $sql->ejecutar_consulta("SELECT ID FROM usuarios WHERE Login='$user'");

		//Comprobamos que la consulta se haya realizado correctamente.		
		if(!$consulta){
			die('Error al realizar la consulta');
			//llama a la función desconectar.
			desconectar();
		}else{
			while($row=mysqli_fetch_array($consulta)){
    			$ID = utf8_encode($row['ID']);
    		}
		}

		//Creamos un nuevo objeto sql.
		$sql = new conection();
		//Realizamos la conexión llamando a la función conectar().
		$conexion = $sql -> conectar();
		//Realizamos la consulta.
		$consulta = $sql->ejecutar_consulta("SELECT * FROM curriculums WHERE ID=$ID");

		//Comprobamos que la consulta se haya realizado correctamente.		
		if(!$consulta){
			die('Error al realizar la consulta');
			//llama a la función desconectar.
			desconectar();
		}else{
			while($row=mysqli_fetch_array($consulta)){
    			$ID = utf8_encode($row['ID']);
    		}
		}
	}
	//Llamamos al pie.
	include('pie.php');
?>
	</body>                                                                
</html>