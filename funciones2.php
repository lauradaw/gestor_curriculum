<?php
//Funcion para acceder a la página.
	function entrar(){
		//Si se ha pulsado el botón enviar.
    	if(isset($_POST['enviar'])){
    		//Se guardan en variables los valores introducidos en los campos del formulario.
    		$user = $_POST['user'];
			$pass = $_POST['passw'];

			//pasamos a md5 la contraseña
			$md5 = md5($pass);

			//Contador para ir acumulando los errores.
			$error = 0;

			//Si el usuario o la contraseña están vacíos, mostrar 'No pueden haber campos vacíos'
			if(empty($user) || empty($pass)){
				echo '<script language="javascript">alert("No pueden haber campos vacíos");</script>';
				//Se contabilizan los errores.
				$error ++;
			}

			//Si no hay errores
			if($error == 0){

				//Creamos un nuevo objeto sql.
				$sql = new conection();
				//Realizamos la conexión llamando a la función conectar().
				$conexion = $sql -> conectar();
				//Realizamos la consulta.
				$consulta = $sql->ejecutar_consulta("SELECT * FROM usuarios WHERE Login='$user' AND Password='$md5'");
			
				//Comprobamos que la consulta se haya realizado correctamente.		
				if(!$consulta){
					die('Error al realizar la consulta');
					//llama a la función desconectar.
					desconectar();
				}else{

					//Creamos otra variable para acumular errores.
					$comprobar = 0;

					//Guardamos en variables los datos obtenidos en la consulta.
					while($row=mysqli_fetch_array($consulta)){
						$usuario = $row['Login'];
						$clave = $row['Password'];
						$tipo = $row['Tipo'];
						$email = $row['Email'];
					}

					//Validamos según la consulta devuelva una variable vacía o no.
					if(empty($usuario) || empty($clave)){
						$comprobar = 1;
						echo '<script language="javascript">window.alert("El usuario o la contraseña no son correctos");</script>';
					}else{
						$comprobar = 0;
					}

					//Si no hay errores.
					if($comprobar == 0){
						//Almacenamos en sesiones los datos obtenidos en la consulta.
						$_SESSION['user'] = $user;
            			$_SESSION['email'] = $email;
                    	$_SESSION['tipo'] = $tipo;
                   		$_SESSION['registro'] = "Último acceso: " . date('d') . " de " . date('M') . " del " . date('Y') . " a las " . date('H:i:s');
					}

					//Según el tipo de usuario, llevará al index o al backoffice.
					if($_SESSION['tipo'] == 2 || $_SESSION['tipo'] == 3){
                   		echo '<script language="javascript">window.location="backoffice.php";</script>';
                	}else{
                		echo '<script language="javascript">window.location="index.php";</script>';
                	}
				}
        	}
		}
	}
?>
