<?php
	//Iniciamos sesión.
	SESSION_START();
	//Llamamos al archivo de conexión con la base de datos datos.php.
	include('datos.php');
	//Llamamos al css registro.css
	$css = 'registro.css';
	
	$pagina = "Editar";
	include('cabecera.php');

	//Si hay sesión guardamos los datos en variables
	if(!is_null($_SESSION['user'])){
		$user = $_SESSION['user'];
		//Consulta para guardar los datos del usuario en variables
		$consulta = "SELECT * FROM usuarios WHERE Login='$user'";
		$result_set = mysqli_query($con, $consulta) or die("Error en la consulta");
		while($row = mysqli_fetch_row($result_set)){
			$email_antiguo = $row[3];
		}

		//Si pulsamos el botón de finalizar, no hacemos ningún cambio, y redirigimos a la página de usuarios
		if(isset($_POST['finalizar'])){
			header('location: index.php');
		}
		//Si pulsamos el botón de guardar, realizaremos los cambios si no hay errores de validación
		if(isset($_POST['guardar'])){
			$nuevo_email = $_POST['mail'];
			$nuevo_password = $_POST['pass_new1'];
			$nuevo_password_rep = $_POST['pass_new2'];
			$error = 0;
					
        	//Comprobamos que no haya campos vacíos.
			if(empty($nuevo_email)){
				echo '<script language="javascript">alert("El email no puede estar vacío");</script>';
				$error ++;
			}
					
			//Si no está vacío el campo de password, validaremos si es correcto
			if(!$nuevo_password == ''){
				//Comprobamos que las contraseñas coinciden.
				if(!$nuevo_password == $nuevo_password_rep){
					echo '<script language="javascript">alert("Las contraseñas no coinciden");</script>';
					$error ++;
				}else{
					//Comprobamos que el formato de la contraseña sea el correcto.
					if(!preg_match('/[a-z]/',$nuevo_password) || !preg_match('/[A-Z]/',$nuevo_password) || !preg_match('/[0-9]/',$nuevo_password)){
						echo '<script language="javascript">alert("La contraseña introducida tiene que estar formada mínimo por 1 número, 1 letra miníscula y 1 letra mayúscula");</script>';
						$error ++;
					}
				}
			}
			//Comprobamos que el formato del email sea el correcto.
			if(!preg_match('^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})^',$nuevo_email)){
				echo '<script language="javascript">alert("El email no contiene un formato válido");</script>';
				$error ++;
			}	

			//Hacemos una consulta a la base de datos solicitando todos los emails registrados y los almacenamos en variables.
			$result_set=mysqli_query($con, "SELECT * FROM usuarios") or die("Error al realizar la consulta");
			while($row=mysqli_fetch_row($result_set)){
	            $emails[] = $row[3];
        	}
        					
        	//Se comprueba que el email que se va a registrar no existe ya dentro de la base de datos.
        	if($nuevo_email != $email_antiguo){
	        	if(in_array($nuevo_email, $emails)){
	        		echo '<script language="javascript">alert("¡El email ya existe, introduce otro!");</script>';
	        		$error ++;
	        	}
	        }
        			
        	if($error < 1){
        		//Realizamos los cambios en la base de datos
        		$actualizar_email = "UPDATE usuarios SET Email='" . $nuevo_email ."' WHERE Login='" . $user . "'";

        		//Realizaremos los cambios de password, sólo si se introdujeron los datos
        		if(!$nuevo_password == ''){
        			$actualizar_password = "UPDATE usuarios SET Password='" . md5($nuevo_password) ."' WHERE Login='" . $user . "'";
        			$result_passw = $con -> query($actualizar_password) or die("Error al actualizar");
        		}

        		//Ejecutamos las consultas de actualización
        		$result_email = $con -> query($actualizar_email) or die("Error al actualizar");
        		echo '<script language="javascript">alert("Se ha realizado los cambios correctamente"); window.location="perfil.php";</script>';
        	}else{
        			echo '<script language="javascript">alert("No se realizaron los cambios. Vuelve a intentarlo")</script>';
        	}
		}
	}
?>
					<!-- Mostramos el formulario -->
					<article id="cuerpo">
						<h1 class="titulo">Perfil de <?php echo $user ?></h1>
						<div class="contenido">
							<form id="editardatos" action="#" method="POST" ENCTYPE="multipart/form-data">
								<table style="margin: -10px 30px" id="acceder">
									<tr>
										<td>
											<label>Usuario: </label>
										</td>
										<td>
											<?php echo utf8_encode($user) ?>
										</td>
									</tr>
									<tr>
										<td>
											<label>Email: </label>
										</td>
										<td>
											<input class="campo8" type="text" name="mail"  maxlength="50" size="25" value="<?php echo $email_antiguo ?>">
										</td>
									</tr>
									<tr>
										<td>
											<label>Nueva Contraseña: </label>
										</td>
										<td>
											<input maxlength="30" size="25" class="campo11" type="password" name="pass_new1">
										</td>
									</tr>
									<tr>
										<td>
											<label class="rep">Repita la Nueva Contraseña: </label>
										</td>
										<td>
											<input maxlength="30" size="25" class="campo12" type="password" name="pass_new2"><br>
										</td>
									</tr>
									<tr>
										<td colspan="2"  style="text-align:left">
											<br />
											<p>*Si no se desea cambiar la contraseña, deja los espacios en blanco.</p>
											<br />
											<button name="guardar" type="submit" value="Enviardatos" alt="Guardar los datos del usuario" title="Guardar los datos del usuario">Actualizar</button>
											<button name="finalizar" type="submit" value="Enviardatos" style="margin-top:-10px" alt="Salir sin guardar los datos" title="Salir sin guardar los datos">Salir</button>
										</td>
									</tr>
								</table>	  
							</form>
						<div style="margin-bottom: 120px">&nbsp;</div>
						</div>
					</article>
<?php
	//Llamamos al pie de página.
	include('pie.php');
?>
		</div>
	</body>
</html>