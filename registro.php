<?php
	//Incluimos el archivo datos.php que contiene los datos de conexión de la base de datos.
	include('datos.php');
	//Variable para indicar el nombre de la página en el titulo.
	$pagina = 'Registrate en nuestra web';
	//Llamamos al css de contacto.
	$css = 'contacto.css';
	//Recopilamos en variables los datos del formulario.
	@$user = $_REQUEST['user'];
	@$pass = $_REQUEST['passw'];
	@$pass_md5 = md5($pass);
	@$repass = $_REQUEST['repassw'];
	@$email = $_REQUEST['mail'];
	@$nombre = $_REQUEST['nombre'];
	@$acepto = $_REQUEST['acepto'];
	@$enviar = $_REQUEST['enviar'];
	$error = 0;
	$tipo = 1;

	//Si se ha pulsado el botón.
	if(isset($enviar)){
		//Comprobamos que no haya campos vacíos
		if(empty($user) || empty($pass) || empty($repass) || empty($email) || empty($nombre) || is_null($acepto)){
			echo '<script language="javascript">alert("No pueden haber campos vacíos");</script>';
			$error ++;
		}else{
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
			//Comprobamos que el formato del email sea el correcto.
			if(!preg_match('^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})^',$email)){
				echo '<script language="javascript">alert("El email no contiene un formato válido");</script>';
				$error ++;
			}

			//Hacemos una consulta a la base de datos solicitando todas las ID, todos los nombres de usuario registrados y todos los emails registrados y los almacenamos en variables.
			$result_set=mysqli_query($con, "SELECT * FROM usuarios") or die("Error al realizar la consulta");
			while($row=mysqli_fetch_row($result_set)){
				$IDs[] = $row[0];
            	$users[] = $row[1];
            	$emails[] = $row[3];
        	}
        		//Contamos el total de IDs para saber cual será la siguiente.
        		$total_ID = count($IDs);
        		//Al total de IDS le sumamos 1 para que no repitan las IDS en la base de datos, esto lo hacemos porque el campo auto incremento no está activado.
        		$siguiente_ID = $total_ID + 1;

        	//Se comprueba que el usuario que se va a registrar no existe ya dentro de la base de datos.
        	if(in_array($user, $users)){
        		echo '<script language="javascript">alert("¡El usuario ya existe, introduce otro!");</script>';
        		$error ++;
        	}
        	//Se comprueba que el email que se va a registrar no existe ya dentro de la base de datos.
        	if(in_array($email, $emails)){
        		echo '<script language="javascript">alert("¡El email ya existe, introduce otro!");</script>';
        		$error ++;
        	}
        	//Si todas las condiciones de validación no se han cumplido, se creará un nuevo registro dentro de la base de datos.
        	if($error == 0){
        		$consulta = "INSERT INTO usuarios (ID, Login, Password, Email, Tipo) VALUES ('" . $siguiente_ID . "','" . $user . "','" . $pass_md5 . "','" . $email . "','" . $tipo . "')";
        		mysqli_query($con, $consulta) or die("Error al realizar la consulta"); 
				echo '<script language="javascript">window.alert("¡¡Usuario creado correctamente!!"); window.location="entrar.php";</script>';
				//En caso de que la consulta de error.
				if(!mysqli_query($con, $consulta)){
					echo '<script language="javascript">window.alert("¡¡Error al crear el usuario!!");</script>';
				}
        	}
		}
	}
		include('cabecera.php');
		?>

		<article id="cuerpo">
				<h1 class="titulo">Formulario de registro</h1>
				<div class="contenido">
				
		<form id="registrarse" action="#" method="POST" ENCTYPE="multipart/form-data">
				
				<table>
					<tr>
						<td>
							<label>Login / Nickname: * </label>
						</td>
						<td>
							<input class="campo1" type="text" name="user" maxlength="25" size="15">
						</td>
					</tr>
					<tr>
						<td>
							<label>Contraseña: * </label>
						</td>
						<td>
							<input class="campo2" type="password" name="passw" maxlength="25" size="15">
						</td>
					</tr>
					<tr>
						<td>
							<label>Repita la Contraseña: * </label>
						</td>
						<td>
							<input class="campo3" type="password" name="repassw" maxlength="25" size="15">
						</td>
					</tr>
					<tr>
						<td>
							<label>Email: * </label>
						</td>
						<td>
							<input class="campo4" type="text" name="mail">
						</td>
					</tr>
					<tr>
						<td>
							<label>Nombre: * </label>
						</td>
						<td>
							<input class="campo5" type="text" name="nombre" maxlength="25" size="15">
						</td>
					</tr>
				</table>
				<table class="tabla2">
					<tr>
						<td>
							<p class="grande">* Todos los campos son obligatorios</p>
						</td>
					</tr>
					<tr>
						<td>
							<br/>
							<input type="checkbox" class="campo" name ="acepto" value="acepto">
							<b class="acepto">Acepto los <a href="Condiciones.php"  target="_blank">Términos y Condiciones de Uso</a> de esta página web.</b>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:left">
							<br/>
							<button name="enviar" type="submit" value="Enviardatos">Aceptar</button>
							<button type="reset" value="Borrar información">Borrar</button>
						</td>
					</tr>
				</table>
			</form>
			</article>
			<div style="margin-top: -30px">
		<?php
				//Se incluye el pie de página.
				include('pie.php');
		?>
	</div>
	</body>
</html>