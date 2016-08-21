<?php
	//Iniciamos sesión.
	SESSION_START();
	//Llamamos al archivo de conexión con la base de datos datos.php.
	include('conectar.php');
	//Llamamos al css registro.css
	$css = 'backoffice.css';

	$pagina = "Editar Perfil de " . $_SESSION['user'];
	$_titulo = "Currículum";

	$sesion = $_SESSION['user'];

?>

<html>
	<?php include('cabecera_backoffice2.php');?>
	<body>
		<section id="contenedor">
			<?php include('backoffice_menu.php');?>
			<article id="cuerpo_laterial">


<?php

		//Validamos que los invitados no tengan acceso así como validamos que nadie más que el administrador pueda entrar.
		if(empty($_SESSION['user']) || $_SESSION['tipo'] < 2 || $_SESSION['tipo'] > 3){
			//Envia a la página de error.
			header("Location: 404.php");
		//Si la condición anterior no se cumple... 
		}else{

			//Si pulsamos el botón de finalizar, no hacemos ningún cambio, y redirigimos a la página de usuarios
			if(isset($_POST['finalizar'])){
				header('location: backoffice.php');
			}

			$sql = new conection();
			$conexion = $sql -> conectar();
			$consulta = $sql -> ejecutar_consulta("SELECT * from usuarios WHERE Login='$sesion'");

			
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
				}
			}

			//Si pulsamos el botón de guardar, realizaremos los cambios si no hay errores de validación
			if(isset($_POST['guardar'])){
				if($sesion == 'admin'){
					$nuevo_user = $nombre;
				}else{
					$nuevo_user = $_POST['user_name'];
				}
				$nuevo_email = $_POST['mail'];
				
				$old_pass = md5($_POST['old_pass']);
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

					if($old_pass != $passw){
						echo '<script language="javascript">alert("Tu contraseña actual no es correcta");</script>';
						//se van contabilizando los errores.
						$error ++;
					}
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

					if($nuevo_user != $sesion){
						$consulta = $sql->ejecutar_consulta("UPDATE usuarios SET Login='$nuevo_user' WHERE Login='$sesion'");
					}
					
					if($nuevo_email != $email){
						$consulta = $sql->ejecutar_consulta("UPDATE usuarios SET Email='$nuevo_email' WHERE Login='$sesion'");
					}

					if($passmd5 != $passw){
						$consulta = $sql->ejecutar_consulta("UPDATE usuarios SET Password='$passmd5' WHERE Login='$sesion'");
					}
        			
        			//Si hay error en la consulta...
        			if(!$consulta){
						die('Error al realizar la consulta');
						//llama a la función desconectar.
						desconectar();
						//Si no hay errores...
					}else{
						echo '<script language="javascript">window.alert("¡¡Los datos se han modificado!!"); window.location="backoffice.php";</script>';
        			}
        			//Si se han contabilizado errores o ha cambiado el valor de $verificar...
				}else{
					echo '<script language="javascript">window.alert("¡¡Error al modificar los datos!!"); window.location="#";</script>';
				}
			}
		}
	
?>

				<article id="cuerpo">
					<h1 class="titulo">Editar la cuenta del usuario <?php echo $sesion ?></h1>
					<div class="contenido">
						<form id="editardatos" action="#" method="POST" ENCTYPE="multipart/form-data">
							<table style="margin: -10px 30px" id="acceder">
								<tr>
									<td>
										<label>Usuario: </label>
									</td>
									<td>
<?php
										if($sesion == 'admin'){
											echo '<label>' . $sesion . '</label>';
										}else{
											echo '<input class="campo7" type="text" name="user_name"  maxlength="30" size="25" value="' . utf8_encode($sesion) . '">';
										}
											
?>									
									</td>
								</tr>
								<tr>
									<td>
										<label>Email: </label>
									</td>
									<td>
										<input class="campo8" type="text" name="mail"  maxlength="50" size="25" value="<?php echo $email ?>">
									</td>
								</tr>
								<tr>
									<td>
										<label>Contraseña Anterior: </label>
									</td>
									<td>
										<input maxlength="30" size="25" class="campo11" type="password" name="old_pass">
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
									<td>
										<label>Rango: </label>
									</td>
									<td>
<?php
										$tipo = $_SESSION['tipo'];
										if($tipo == 2){
											echo '<label>Administrador</label>';
										}else if($tipo == 3){
											echo '<label>RRHH</label>';
										}else{
											echo '<label>Usuario</label>';
										}
?>
									</td>
								</tr>
								<tr>
									<td colspan="2"  style="text-align:left">
										<br />
										<p>*Si no se desea cambiar la contraseña, deja los espacios en blanco.</p>
										<br />
										<button name="guardar" type="submit" value="Enviardatos" alt="Guardar los datos del usuario" title="Guardar los datos del usuario">Actualizar</button>
										<button name="finalizar" type="submit" value="Enviardatos" style="margin-top:-10px" alt="Salir sin guardar los datos" title="Salir sin guardar los datos">Salir</button>
										<input type="hidden" name="editar" value="<?php echo $usuario_recibido ?>">
									</td>
								</tr>
							</table>	  
						</form>
					</div>
				</article>
			</article>
			<footer id="pie">
			</footer>
		</section>
	</body>
</html>