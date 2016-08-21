<?php
class conection{
	function conectar(){

		$host = "localhost";
		$usuario = "root";
		$password = "";
		$bd = "curriculums";

		$_titulo = "Curriculum";
   		$_email = 'curriculum@hotmail.com';

		$this->conexion=mysqli_connect($host,$usuario,$password,$bd);

		if(!$this->conexion){
			die('Error de conexión: ' . mysqli_connect_error() . '<br>');
			return 0;
		}

		mysqli_set_charset($this->conexion,"UTF8");	
	}

	function desconectar(){
		mysqli_close($this->conexion);
	}


	function ejecutar_consulta($consulta){
		$this->query = mysqli_query($this->conexion, $consulta);
		return $this->query;
	}
	
}
?>