<html>
	<head>
<?php
	//Iniciamos sesión.
	SESSION_START();

	//Incluimos el archivo datos.php con los datos de la base de datos.
	//Variable para indicar el nombre de la página en el titulo.
	$pagina = "Recuperar contraseña";
	$_titulo = "Currículum";
	//Llamamos al css de registro.
	$css = 'registro2.css';

	include('conectar.php');
	include('funciones_backoffice.php');
?>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
<?php include('cabecera_backoffice.php'); ?>
	</head>
	<body>
		<div id="contenedor">
			<article id="cuerpo">
				<h1 class="titulo">Recuperar Contraseña:</h1>
				<div class="contenido">
					<form id="acceder" action="#" method="POST" ENCTYPE="multipart/form-data">
						<table>
							<tr>
								<td class="etiqueta">
									<label>Correo Electrónico: * </label>
								</td>
								<td>
									<input type="text" name="mail" maxlength="50" placeholder="Introduce el email vinculado a tu cuenta">
								</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:left">
									<br />
									<button name="guardar" type="submit" value="Enviardatos">Solicitar</button>
									<button name="cancelar" type="submit" value="Enviardatos">Cancelar</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</article>
		</div>
	</body>
</html>

<?php

	//Validamos que los invitados no tengan acceso así como validamos que nadie más que el administrador pueda entrar.
	if(@$_SESSION['user']){
		//Envia a la página de error.
		header("Location: index.php");
		//Si la condición anterior no se cumple... 
	}else{
		//Si pulsamos el botón de finalizar, no hacemos ningún cambio y volveremos a la página de inicio.
		if(isset($_POST['cancelar'])){
			header("Location:".$_SERVER['HTTP_REFERER']);
		}
		//Si pulsamos el botón de guardar...
		if(isset($_POST['guardar'])){
			//Se almacenan los datos del formulario en variables php.
			$s_email = $_POST['mail'];
			$error = 0;
			$validar = 0;
				
			//Comprobamos que el formato del email sea el correcto.
			if(!empty($s_email)){
				if(!preg_match('^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})^',$s_email)){
					echo '<script language="javascript">window.alert("¡¡El email no contiene un formato válido!!");</script>';	
				}else{

					//Creamos un nuevo objeto sql.
					$sql = new conection();
					//Realizamos la conexión llamando a la función conectar().
					$conexion = $sql -> conectar();
					//Realizamos la consulta, en este caso, llamamos a todo el contenido de la tabla usuarios.
					$consulta = $sql->ejecutar_consulta("SELECT Email FROM recuperar WHERE Email ='$s_email'");
					

					if(!$consulta){
						die('Error al realizar la consulta');
						//llama a la función desconectar.
						desconectar();
						//Si no hay error...
					}else{

						while($row=mysqli_fetch_array($consulta)){
							$mail = $row['Email'];
						}

						if(!empty($mail)){
							$error = 1;
							echo '<script language="javascript">window.alert("¡¡Ya has solicitado un código, revisa tu bandeja de entrada!!");</script>';
						}else{
							$error = 0;
						}
					}

					//Creamos un nuevo objeto sql.
					$sql = new conection();
					//Realizamos la conexión llamando a la función conectar().
					$conexion = $sql -> conectar();
					//Realizamos la consulta, en este caso, llamamos a todo el contenido de la tabla usuarios.
					$consulta = $sql->ejecutar_consulta("SELECT Email FROM usuarios WHERE Email ='$s_email'");
					
					//Si hay error en la consulta...
					if(!$consulta){
						die('Error al realizar la consulta');
						//llama a la función desconectar.
						desconectar();
						//Si no hay error...
					}else{

						while($row=mysqli_fetch_array($consulta)){
							$Email = $row['Email'];
						}

						if(empty($Email)){
							$validar = 1;
							echo '<script language="javascript">window.alert("¡¡El email introducido no pertenece a ningún usuario, introduce otro!!");</script>';
						}else{
							$validar = 0;
						}
					}

					if($error == 0 && $validar == 0){
						$codigo = generar_codigo();

						email($s_email);

						//Parte 2 de la validación por email.

						//Creamos un nuevo objeto sql.
						$sql = new conection();
						//Realizamos la conexión llamando a la función conectar().
						$conexion = $sql -> conectar();
						//Realizamos la consulta, en este caso, llamamos a todo el contenido de la tabla usuarios.
						$consulta = $sql->ejecutar_consulta("INSERT INTO recuperar (Codigo, Fecha, Email) VALUES('" . $codigo . "',NOW(),'" . $s_email . "')");

						//Si hay error en la consulta...
						if(!$consulta){
							die('Error al realizar la consulta');
							//llama a la función desconectar.
							desconectar();
							//Si no hay error...
						}else{
							echo '<script language="javascript">window.alert("Código añadido con éxito");</script>';
						}
					}else{
						echo '<script language="javascript">window.alert("Error al enviar el email");</script>';
					}
				}
			}
		}
	}
?>
