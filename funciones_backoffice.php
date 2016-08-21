<?php
	function backoffice_login(){
		if(!empty($_SESSION['user'])){
			header("Location: 404.php");
		}else{
			//Si se ha pulsado el botón enviar.
    		if(isset($_POST['enviar'])){
    			//Se guardan en variables los valores introducidos en los campos del formulario.
    			$user = $_POST['user'];
				$pass = $_POST['passw'];

				$clave = md5($pass);

				//Si el usuario o la contraseña están vacíos, mostrar 'No pueden haber campos vacíos'
				if(empty($user) || empty($pass)){
					echo '<script language="javascript">alert("No pueden haber campos vacíos");</script>';
					//Sino, realiza una consulta a la base de datos solicitando todo lo que hay dentro de la tabla usuarios y guarda en arrays.'
				}else{
					$sql = new conection();
					$conexion = $sql -> conectar();
					$consulta = $sql->ejecutar_consulta("SELECT * FROM usuarios WHERE Login='$user'");
				
        			if(!$consulta){
						die('Error al realizar la consulta');
						desconectar();
					}else{
						while($row=mysqli_fetch_array($consulta)){
							$tipo = $row['Tipo'];
							$contra = $row['Password'];

							if($clave == $contra){
								$_SESSION['user'] = $user;
                    			$_SESSION['tipo'] = $tipo;
                    			$_SESSION['registro'] = 'El ' . date('d') . " de " . date('M') . " del " . date('Y') . " a las " . date('H:i:s') . ' h';

                    			if($tipo == 2 || $tipo == 3){
									header("Location: backoffice.php");
								}else{
									header("Location: index.php");
								}

							}else{
								echo '<script language="javascript">alert("Los datos introcidos no son correctos, revísalos.");</script>';
							}
						}
					}
				}
			}
		}
	}
	function backoffice_menu(){
		$tipo = $_SESSION['tipo'];

		if($tipo == 2){
			return include('menu_admin.php');
		}else if($tipo == 3){
			return include('menu_RRHH.php');
		}else{
			return "";
		}
	}
	function cargar_rango(){
		$tipo = $_SESSION['tipo'];
		if($tipo == 2){
			return 'Administrador';
		}else if($tipo == 3){
			return 'RRHH';
		}else{
			return 'Usuario';
		}
	}
	function cargar_saludo(){
		$usuario = $_SESSION['user'];
		$fecha = $_SESSION['registro'];

		echo '<h1>¡Bienvenido, ' . $usuario . '!</h1><br>';
		echo '<p>Rango: ' . cargar_rango() . '</p>';
		echo '<p>Te has logueado: <br>' . $fecha . '.</p>';
	}

	function nuevo_user(){
		//Validamos que los invitados no tengan acceso así como validamos que nadie más que el administrador pueda entrar.
		if(empty($_SESSION['user']) || $_SESSION['tipo'] < 2 || $_SESSION['tipo'] > 2){
			//Envia a la página de error.
			header("Location: 404.php");
		//Si la condición anterior no se cumple... 
		}else{
			//Si pulsamos el botón de finalizar, no hacemos ningún cambio y volveremos a la página de inicio.
			if(isset($_POST['finalizar'])){
				header('location: backoffice.php');
			}
			//Si pulsamos el botón de guardar...
			if(isset($_POST['guardar'])){
				//Se almacenan los datos del formulario en variables php.
				$nuevo_user = $_POST['user_name'];
				$nuevo_email = $_POST['mail'];
				$nuevo_tipo = $_POST['tipo'];
				$nuevo_password = $_POST['pass_new1'];
				$nuevo_password_rep = $_POST['pass_new2'];

				//Creamos dos variables más para la verificación de errores y datos ya almacenados en la base de datos.
				$verificar = 0;
				$error = 0;

				//Comprobamos que el campo usuario, el email y la contraseña no estén vacíos.
				if(empty($nuevo_user) || empty($nuevo_email) || empty($nuevo_password)){
					echo '<script language="javascript">alert("No pueden haber campos vacíos");</script>';
					//se van contabilizando los errores.
					$error ++;
				}

				//Comprobamos que el formato del email sea el correcto.
				if(!empty($nuevo_email)){
					if(!preg_match('^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})^',$nuevo_email)){
						echo '<script language="javascript">alert("El email no contiene un formato válido");</script>';
						//se van contabilizando los errores.
						$error ++;
					}
				}

				//Si no está vacío el campo de password, validaremos si es correcto.
				if(!empty($nuevo_password)){
					//Comprobamos que las contraseñas coinciden.
					if($nuevo_password != $nuevo_password_rep){
						echo '<script language="javascript">alert("Las contraseñas no coinciden");</script>';
						//se van contabilizando los errores.
						$error ++;
					}
						//Comprobamos que el formato de la contraseña sea el correcto.
					if(!preg_match('/[a-z]/',$nuevo_password) || !preg_match('/[A-Z]/',$nuevo_password) || !preg_match('/[0-9]/',$nuevo_password)){
						echo '<script language="javascript">alert("La contraseña introducida tiene que estar formada mínimo por 1 número, 1 letra miníscula y 1 letra mayúscula");</script>';
						//se van contabilizando los errores.
						$error ++;
					}
				}

				//Creamos un nuevo objeto sql.
				$sql = new conection();
				//Realizamos la conexión llamando a la función conectar().
				$conexion = $sql -> conectar();
				//Realizamos la consulta, en este caso, llamamos a todo el contenido de la tabla usuarios.
				$consulta = $sql->ejecutar_consulta("SELECT * FROM usuarios");

				//Si hay error en la consulta...
				if(!$consulta){
						die('Error al realizar la consulta');
						//llama a la función desconectar.
						desconectar();
				//Si no hay error...
				}else{
					//Verificamos que el nuevo usuario y el nuevo email, nó estén ya registrados dentro de la base de datos.
					while($row=mysqli_fetch_object($consulta)){
						if($row->Login == $nuevo_user){
							//Si encuentra coincidencias, cambia el valor de la variable.
							$verificar = 1;
							echo '<script language="javascript">alert("El usuario introducido ya está registrado");</script>';
						}
						if($row->Email == $nuevo_email){
							//Si encuentra coincidencias, cambia el valor de la variable.
							$verificar = 1;
							echo '<script language="javascript">alert("El email introducido ya está registrado");</script>';
						}
					}

					//Si no hay errores y si no ha cambiado el valor de verificar.
					if($error == 0 && $verificar == 0){
						//Realizamos un nueva consulta para crear el nuevo usuario.
						$consulta = $sql->ejecutar_consulta("INSERT INTO usuarios (ID, Login, Password, Email, Tipo) VALUES ('','" . $nuevo_user . "','" . md5($nuevo_password) . "','" . $nuevo_email . "','" . $nuevo_tipo . "')");
        			
        				//Si hay error en la consulta...
        				if(!$consulta){
							die('Error al realizar la consulta');
							//llama a la función desconectar.
							desconectar();
						//Si no hay errores...
						}else{

							echo '<script language="javascript">window.alert("¡¡Usuario creado correctamente!!"); window.location="#";</script>';

        				}
        			//Si se han contabilizado errores o ha cambiado el valor de $verificar...
					}else{
						echo '<script language="javascript">window.alert("¡¡No se ha podido crear el usuario!!"); window.location="#";</script>';
					}
				}
			}
		}
	}

	function nueva_categoria(){
		//Validamos que los invitados no tengan acceso así como validamos que nadie más que el administrador pueda entrar.
		if(empty($_SESSION['user']) || $_SESSION['tipo'] < 2 || $_SESSION['tipo'] > 2){
			//Envia a la página de error.
			header("Location: 404.php");
		//Si la condición anterior no se cumple... 
		}else{
			//Si pulsamos el botón de finalizar, no hacemos ningún cambio y volveremos a la página de inicio.
			if(isset($_POST['finalizar'])){
				header('location: backoffice.php');
			}
			//Si pulsamos el botón de guardar...
			if(isset($_POST['guardar'])){
				//Se almacenan los datos del formulario en variables php.
				$categoria = mb_convert_encoding(mb_convert_case($_POST['categoria'], MB_CASE_TITLE), "UTF-8"); 

				//Creamos dos variables más para la verificación de errores y datos ya almacenados en la base de datos.
				$validar = 0;
				$error = 0;

				//Comprobamos que el campo usuario, el email y la contraseña no estén vacíos.
				if(empty($categoria) || is_null($categoria)){
					echo '<script language="javascript">alert("No pueden haber campos vacíos");</script>';
					//se van contabilizando los errores.
					$error ++;
				}

				if(preg_match('/\s/',$categoria)){
				 	echo '<script language="javascript">alert("No pueden haber espacios en blanco");</script>';
					//se van contabilizando los errores.
					$error ++;
				 }


				//Creamos un nuevo objeto sql.
				$sql = new conection();
				//Realizamos la conexión llamando a la función conectar().
				$conexion = $sql -> conectar();
				//Realizamos la consulta, en este caso, llamamos a todo el contenido de la tabla usuarios.
				$consulta = $sql->ejecutar_consulta("SELECT NombreCategoria FROM categorias WHERE NombreCategoria='$categoria'");

				//Si hay error en la consulta...
				if(!$consulta){
						die('Error al realizar la consulta');
						//llama a la función desconectar.
						desconectar();
				//Si no hay error...
				}else{
					//Verificamos que la nueva categoria, no esté ya registrada dentro de la base de datos.
					while($row=mysqli_fetch_array($consulta)){
						$nombre = $row['NombreCategoria'];
					}

					if(empty($nombre)){
						$validar = 0;
					}else{
						$validar = 1;
						echo '<script language="javascript">window.alert("¡¡La categoría ya existe, introduce otra!!");</script>';
					}

					//Si no hay errores y si no ha cambiado el valor de verificar.
					if($error == 0 && $validar == 0){
						//Realizamos un nueva consulta para crear el nuevo usuario.
						$consulta = $sql->ejecutar_consulta("INSERT INTO categorias (IdCategorias, NombreCategoria) VALUES ('','"  . $categoria . "')");
        			
        				//Si hay error en la consulta...
        				if(!$consulta){
							die('Error al realizar la consulta');
							//llama a la función desconectar.
							desconectar();
						//Si no hay errores...
						}else{

							echo '<script language="javascript">window.alert("¡¡Categoría creada correctamente!!"); window.location="#";</script>';

        				}
        			//Si se han contabilizado errores o ha cambiado el valor de $verificar...
					}else{
						echo '<script language="javascript">window.alert("¡¡No se ha podido crear la categoría!!"); window.location="#";</script>';
					}
				}
			}
		}
	}

	function listar_usuarios(){
		//Validamos que los invitados no tengan acceso así como validamos que nadie más que el administrador pueda entrar.
		if(empty($_SESSION['user']) || $_SESSION['tipo'] < 2 || $_SESSION['tipo'] > 2){
			//Envia a la página de error.
			header("Location: 404.php");
		//Si la condición anterior no se cumple... 
		}else{
			$sql = new conection();
			$conexion = $sql -> conectar();
			$consulta = $sql -> ejecutar_consulta("SELECT * FROM usuarios ORDER BY Login ASC");

			if(!$consulta){
				die('Error al realizar la consulta');
				desconectar();
			}else{
				while($row=mysqli_fetch_array($consulta)){
					$ID = $row['ID'];
					$usuario = $row['Login'];
					$email = $row['Email'];
					$tipo = $row['Tipo'];

					echo '<tr>
							<td>'; 
					echo 		'<span style="margin:15px;">' . $usuario . '</span>';
					echo 	'</td>';
					echo 	'<td>';//Mostrará el email y permitirá enviar un mensaje por correo electrónico.
					echo 		'<a href="mailto:' . $email . '" alt="Enviar un mail a ' . utf8_encode($usuario) . '" title="Enviar un mail a ' . utf8_encode($usuario) . '">' . $email . '</a>';
					echo 	'</td>
							<td>'; //Comprobamos según el número del tipo e indicamos en letras si es usuario, administrador o RRHH.
								switch($tipo){
									case 1:
										echo "Usuario";
									break;
									case 2:
										echo "Administrador";
									break;
									case 3: 
										echo "RRHH";
									break;
									default:
										echo "Rango Incorrecto";
									break;
								}
							//Enviamos por método GET el usuario a la página de editar y a la página de eliminar_usuarios.
					echo 	'</td>';
					echo    '<td>';
					echo    	'<span id="menu_curriculum">
									<a class="iconos" href="editar.php?editar=' . $usuario . '">
										<img src="img/editar.png">
									</a>
								</span>
								<span id="menu_curriculum" name="prueba">
									<a class="iconos" href="eliminar_usuarios.php?borrar=' . $ID . '">
										<img src="img/eliminar.png">
									</a>
								</span>
							</td>
						</tr>';
				}
			}
		}
	}

	function listar_categorias(){
		//Validamos que los invitados no tengan acceso así como validamos que nadie más que el administrador pueda entrar.
		if(empty($_SESSION['user']) || $_SESSION['tipo'] < 2 || $_SESSION['tipo'] > 2){
			//Envia a la página de error.
			header("Location: 404.php");
		//Si la condición anterior no se cumple... 
		}else{
			$sql = new conection();
			$conexion = $sql -> conectar();
			$consulta = $sql -> ejecutar_consulta("SELECT * FROM categorias ORDER BY NombreCategoria ASC");

			if(!$consulta){
				die('Error al realizar la consulta');
				desconectar();
			}else{
				while($row=mysqli_fetch_array($consulta)){
					$Categoria = $row['NombreCategoria'];

					echo '<tr>
							<td>'; 
					echo 		'<span style="margin:15px;">' . $Categoria . '</span>';
					echo 	'</td>
						 </tr>';
				}
			}
		}
	}

	function editar_usuario(){
		//Validamos que los invitados no tengan acceso así como validamos que nadie más que el administrador pueda entrar.
		if(empty($_SESSION['user']) || $_SESSION['tipo'] < 2 || $_SESSION['tipo'] > 2){
			//Envia a la página de error.
			header("Location: 404.php");
		//Si la condición anterior no se cumple... 
		}else{

			//Si pulsamos el botón de finalizar, no hacemos ningún cambio, y redirigimos a la página de usuarios
			if(isset($_POST['finalizar'])){
				header('location: usuarios.php');
			}

			$sql = new conection();
			$conexion = $sql -> conectar();
			$consulta = $sql -> ejecutar_consulta("SELECT * from usuarios WHERE Login='$usuario_recibido'");

			
			//Si hay error en la consulta...
			if(!$consulta){
				die('Error al realizar la consulta');
				//llama a la función desconectar.
				desconectar();
			//Si no hay error...
			}else{
				while($row = mysqli_fetch_array($consulta)){
					$nombre = $row['Login'];
					$passw = $row['Password'];
					$email = $row['Email'];
					$tipo = $row['Tipo'];
				}
			}

			//Si pulsamos el botón de guardar, realizaremos los cambios si no hay errores de validación
			if(isset($_POST['guardar'])){
				$nuevo_user = $_POST['user_name'];
				$nuevo_email = $_POST['mail'];
				$nuevo_tipo = $_POST['tipo'];
				$nuevo_password = $_POST['pass_new1'];
				$nuevo_password_rep = $_POST['pass_new2'];

				$passmd5 = md5($nuevo_password);
				
				//Creamos dos variables más para la verificación de errores y datos ya almacenados en la base de datos.
				$verificar = 0;
				$verificar2 = 0;
				$error = 0;

				//Comprobamos que el campo usuario, el email.
				if(empty($nuevo_user) || empty($nuevo_email)){
					echo '<script language="javascript">alert("No pueden haber campos vacíos");</script>';
					//se van contabilizando los errores.
					$error ++;
				}

				//Comprobamos que el formato del email sea el correcto.
				if(!empty($nuevo_email)){
					if(!preg_match('^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})^',$nuevo_email)){
						echo '<script language="javascript">alert("El email no contiene un formato válido");</script>';
						//se van contabilizando los errores.
						$error ++;
					}
				}

				//Si no está vacío el campo de password, validaremos si es correcto.
				if(!empty($nuevo_password)){
					//Comprobamos que las contraseñas coinciden.
					if($nuevo_password != $nuevo_password_rep){
						echo '<script language="javascript">alert("Las contraseñas no coinciden");</script>';
						//se van contabilizando los errores.
						$error ++;
					}
					//Comprobamos que el formato de la contraseña sea el correcto.
					if(!preg_match('/[a-z]/',$nuevo_password) || !preg_match('/[A-Z]/',$nuevo_password) || !preg_match('/[0-9]/',$nuevo_password)){
						echo '<script language="javascript">alert("La contraseña introducida tiene que estar formada mínimo por 1 número, 1 letra miníscula y 1 letra mayúscula");</script>';
						//se van contabilizando los errores.
						$error ++;
					}
				}

				$consulta = $sql -> ejecutar_consulta("SELECT * from usuarios");

				//Si hay error en la consulta...
				if(!$consulta){
					die('Error al realizar la consulta');
					//llama a la función desconectar.
					desconectar();
				//Si no hay error...
				}else{

					//Verificamos que el nuevo usuario y el nuevo email, nó estén ya registrados dentro de la base de datos.
					while($row=mysqli_fetch_object($consulta)){
						if($row->Login == $nuevo_user){

							if($nombre == $nuevo_user){
								$verificar = 0;
							}else{
								echo '<script language="javascript">alert("El usuario introducido ya está registrado");</script>';
								//Si encuentra coincidencias, cambia el valor de la variable.
								$verificar = 1;
							}
						}
						if($row->Email == $nuevo_email){

							if($email == $nuevo_email){
								$verificar2 = 0;
							}else{
								echo '<script language="javascript">alert("El email introducido ya está registrado");</script>';
								//Si encuentra coincidencias, cambia el valor de la variable.
								$verificar2 = 1;
							}
						}
					}
				}

				//Si no hay errores y si no ha cambiado el valor de verificar.
				if($error == 0 && $verificar == 0 && $verificar2 == 0){

					if($nuevo_user != $usuario_recibido){
						$consulta = $sql->ejecutar_consulta("UPDATE usuarios SET Login='$nuevo_user' WHERE Login='$usuario_recibido'");
					}
					
					if($nuevo_email != $email){
						$consulta = $sql->ejecutar_consulta("UPDATE usuarios SET Email='$nuevo_email' WHERE Login='$usuario_recibido'");
					}

					if($passmd5 != $passw){
						$consulta = $sql->ejecutar_consulta("UPDATE usuarios SET Password='$passmd5' WHERE Login='$usuario_recibido'");
					}

					if($nuevo_tipo != $tipo){
						$consulta = $sql->ejecutar_consulta("UPDATE usuarios SET Tipo='$nuevo_tipo' WHERE Login='$usuario_recibido'");
					}
        			
        			//Si hay error en la consulta...
        			if(!$consulta){
						die('Error al realizar la consulta');
						//llama a la función desconectar.
						desconectar();
						//Si no hay errores...
					}else{
						echo '<script language="javascript">window.alert("¡¡Los datos se han modificado!!"); window.location="usuarios.php";</script>';
        			}
        			//Si se han contabilizado errores o ha cambiado el valor de $verificar...
				}else{
					echo '<script language="javascript">window.alert("¡¡Error al modificar los datos!!"); window.location="#";</script>';
				}
			}
		}
	}

	function generar_codigo(){
		//Generamos el código aleatório que nos servirá de validador. 
		$num1 = rand(1, 9);
		$num2 = rand(0, 9);
		$num3 = rand(0, 9);
		$num4 = rand(0, 9);
		$num5 = rand(0, 9);
		$num6 = rand(0, 9);

		//Combinamos los números aleatórios obtenidos.
		$codigo = $num1 . $num2 . $num3 . $num4 . $num5 . $num6;

		return $codigo;
	}

	function email($s_email){

		$codigo = generar_codigo();

		$email_subject = "Solicitud de contraseña";
		$email_message = "Has solicitado recuperar la contraseña, tu código de validación es: " . $codigo;
		$email_from = "laura.garcia.brao@gmail.com";

		// Ahora se envía el e-mail usando la función mail() de PHP
		$headers = 'De: '. $email_from."\r\n". 'Responder: '.$email_from."\r\n" .'X-Mailer: PHP/' . phpversion();
		
		/*if(mail($s_email, $email_subject, $email_message, $headers)){
			echo '<script language="javascript">window.alert("Se ha enviado un email al correo ' . $s_email . '");</script>';
		}else{
			echo '<script language="javascript">window.alert("No se pudo enviar el email");</script>';
		} */
	}


?>