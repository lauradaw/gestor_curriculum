<?php
	//Funcion para el registro de los visitantes.
	function registrarse(){
		//Si se ha pulsado el botón de enviar.
		if(isset($_POST['enviar'])){
			//Recopilamos en variables los datos del formulario.
			$user = $_POST['user'];
			$pass = $_POST['passw'];
			$pass_md5 = md5($pass);
			$repass = $_POST['repassw'];
			$email = $_POST['mail'];
			//Variable para la aceptacion de las normas
			@$acepto = $_POST['acepto'];

			//Variables de validacion
			$error = 0;
			$validar = 0;
			$comprobar = 0;
			$rango = 1;

			//Comprobamos que no haya campos vacíos.
			if(empty($user) || empty($pass) || empty($email)){
				echo '<script language="javascript">alert("No pueden haber campos vacíos");</script>';
				//Se contabiliza el error
				$error ++;
			}

			//Comprobamos que se han aceptado las normas
			if(is_null($acepto)){
				echo '<script language="javascript">alert("Debes aceptar las normas");</script>';
				//Se contabiliza el error
				$error ++;
			}

			if(!empty($email)){
				//Comprobamos que el formato del email sea el correcto.
				if(!preg_match('^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})^',$email)){
					echo '<script language="javascript">alert("El email no contiene un formato válido");</script>';
					$error ++;
				}
			}

			if(!empty($pass)){
				//Comprobamos que el formato de la contraseña sea el correcto.
				if(!preg_match('/[a-z]/',$pass) || !preg_match('/[A-Z]/',$pass) || !preg_match('/[0-9]/',$pass)){
					echo '<script language="javascript">alert("La contraseña introducida tiene que estar formada mínimo por 1 número, 1 letra miníscula y 1 letra mayúscula");</script>';
					$error ++;
				}

				//Comprobamos que el campo contraseña coincide con el de repetir contraseña.
				if(!$pass == $repass ){
					echo '<script language="javascript">alert("Las contraseñas que has introducido no coinciden");</script>';
					$error ++;
				}

			}
			//Creamos un nuevo objeto sql.
			$sql = new conection();
			//Realizamos la conexión llamando a la función conectar().
			$conexion = $sql -> conectar();
			//Realizamos la consulta a la base de datos.
			$consulta = $sql->ejecutar_consulta("SELECT Email FROM usuarios WHERE Email ='$email'");
				
			//Validamos que no haya errores en la consulta	
			if(!$consulta){
				die('Error al realizar la consulta');
				//llama a la función desconectar.
				desconectar();
				//Si no hay error...
			}else{
				//Buscamos en la base de datos si el email existe.
				while($row=mysqli_fetch_array($consulta)){
					$mail = $row['Email'];
				}

				//Validamos según la consulta devuelva una variable vacía o no
				if(!empty($mail)){
					$validar = 1;
					echo '<script language="javascript">window.alert("El email ya está registrado");</script>';
				}else{
					$validar = 0;
				}
			}

			//Creamos un nuevo objeto sql.
			$sql = new conection();
			//Realizamos la conexión llamando a la función conectar().
			$conexion = $sql -> conectar();
			//Realizamos la consulta.
			$consulta = $sql->ejecutar_consulta("SELECT Login FROM usuarios WHERE Login ='$user'");
			
			//Comprobamos que la consulta se haya realizado correctamente.		
			if(!$consulta){
				die('Error al realizar la consulta');
				//llama a la función desconectar.
				desconectar();
				//Si no hay error...
			}else{
				//Buscamos en la base de datos si el usuario ya existe.
				while($row=mysqli_fetch_array($consulta)){
					$usuario = $row['Login'];
				}

				//Validamos según la consulta devuelva una variable vacía o no.
				if(!empty($usuario)){
					$comprobar = 1;
					echo '<script language="javascript">window.alert("El usuario ya está registrado");</script>';
				}else{
					$comprobar = 0;
				}
			}

        	//Si todas las condiciones de validación no se han cumplido.
        	if($error == 0 && $comprobar == 0 && $validar == 0){

        		//Creamos un nuevo objeto sql.
				$sql = new conection();
				//Realizamos la conexión llamando a la función conectar().
				$conexion = $sql -> conectar();
				//Realizamos la consulta.
				$consulta = $sql->ejecutar_consulta("INSERT INTO usuarios (ID, Login, Password, Email, Tipo) VALUES ('','" . $user . "','" . $pass_md5 . "','" . $email . "','" . $rango . "')");
					
				//Comprobamos que la consulta se haya realizado correctamente.	
				if(!$consulta){
					die('Error al realizar la consulta');
					//llama a la función desconectar.
					desconectar();
					//Si no hay error...
				}else{
					echo '<script language="javascript">window.alert("¡¡Usuario creado correctamente!!"); window.location="entrar.php";</script>';
				}
        	}
		}
	}

	//Función para contactar con la empresa
	function Contactar(){
		//Comprobamos que la sesión de usuario esté vacía y que el tipo sea un usuario normal, no nos interesa este formulario si se es admin o recursos humanos.
		if(empty($_SESSION['user']) || $_SESSION['tipo'] == 1){

			//Si se ha pulsado el botón enviar.
	    	if(isset($_POST['enviar'])){
	    		//Declaramos una variable para los errores.
	    		$error = 0;

	    		//Comprobamos que no haya campos vacíos.
				if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['comments'])){
					//Se envia un mensaje de alerta.
					echo '<script language="javascript">window.alert("No pueden haber campos vacíos");</script>';
					//Se acumulan los errores.
					$error ++;
				}

				//Si hay email...
				if(!empty($_POST['email'])){
					//Se comprueba que el formato del email sea el correcto.
					if(!preg_match('^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})^',$_POST['email'])){
						echo '<script language="javascript">alert("El email no contiene un formato válido");</script>';
						//se van contabilizando los errores.
						$error ++;
					}
				}

				//Si hay comentarios
				if(!empty($_POST['comments'])){
					//Se comprueba de que al menos hayan 3 carácteres.
					if(strlen($_POST['comments']) < 3){
						echo '<script language="javascript">alert("El cuerpo del mensaje debe de contener al menos 3 carácteres");</script>';
						//se van contabilizando los errores.
						$error ++;
					}
				}

				//Si no hay errores
				if($error == 0){

					//Declaramos destinatario
					$email_to = "sweetsalin@hotmail.com";
					//Declaramos asunto
					$email_subject = "Contacto desde el sitio web";
		
					//Declaramos el cuerpo del mensaje.
					$email_message = "<html>
										<head>
											<title>Curriculum || Solicitud de contraseña</title>
										</head>
										<body>
											<img src='img/logotipo.png' style='text-align: center'>
											<h3>Detalles del formulario de contacto:</h3>
											<table>
												<tr>
													<td>
														Nombre: 
													</td>
													<td>
														" . $_POST['first_name'] . "
													</td>
												</tr>
												<tr>
													<td>
														Apellidos: 
													</td>
													<td>
														" . $_POST['last_name'] . "
													</td>
												</tr>
												<tr>
													<td>
														Email: 
													</td>
													<td>
														" . $_POST['email'] . "
													</td>
												</tr>
											</table>
											<table>
												<tr>
													<td>
														Mensaje: 
													</td>
												</tr>
												<tr>
													<td>
														" . $_POST['comments'] . "
													</td>
												</tr>
											</table>
										</body>
									</html>";
				
					//Declaramos los encabezados.
					$headers = "MIME-Version: 1.0\r\n"; 
					$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
					$headers .= 'From: Curriculum || Nuevo Mensaje de Contacto < ' . $_POST['email'] . ' > ' . "\r\n". 'Reply-To: ' . $_POST['email'] . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		
					//Generamos la función mail y validamos.
					if(mail($email_to, $email_subject, $email_message, $headers)){
						echo '<script language="javascript">window.alert("Su solicitud ha sido enviada correctamente, le responderemos con la máxima brevedad posible");</script>';
					}else{
						echo '<script language="javascript">window.alert("No se pudo enviar el email");</script>';
					} 
				}
			}
		}
	}
?>