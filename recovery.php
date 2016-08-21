<html>
	<head>
<?php
	//Iniciamos sesión.
	SESSION_START();

	//Incluimos el archivo datos.php con los datos de la base de datos.
	//Variable para indicar el nombre de la página en el titulo.
	$pagina = "Cambiar Contraseña";
	$_titulo = "Currículum";
	//Llamamos al css de registro.
	$css = 'registro2.css';

	include('conectar.php');
	include('funciones_backoffice.php');

	if(isset($_GET["codigo"]) && @empty($_SESSION['user']) && @is_null($_SESSION['user'])){

		$codigo = $_GET["codigo"];
		$sql = new conection();
		//Realizamos la conexión llamando a la función conectar().
		$conexion = $sql -> conectar();
		//Realizamos la consulta, en este caso, llamamos a todo el contenido de la tabla usuarios.
		$consulta = $sql->ejecutar_consulta("SELECT Email FROM recuperar WHERE Codigo = ".$_GET["codigo"]);

		if(!$consulta){
			die('Error al realizar la consulta');
			desconectar();
		}else{
			while($row = mysqli_fetch_array($consulta)){
				$mail_usuario = $row["Email"];

				if(isset($_POST["aceptar"])){

					$clave = $_POST['npass'];
					$clavec = $_POST['rnpass'];

					$cifrado = md5($clave);

					if(!empty($clave)){

						if(!preg_match('/[a-z]/',$clave) || !preg_match('/[A-Z]/',$clave) || !preg_match('/[0-9]/',$clave)){
							echo '<script language="javascript">alert("La contraseña introducida tiene que estar formada mínimo por 1 número, 1 letra miníscula y 1 letra mayúscula");</script>';
						}else{

							if($clave == $clavec){
								$sql = new conection();
								//Realizamos la conexión llamando a la función conectar().
								$conexion = $sql -> conectar();
								$consulta = $sql->ejecutar_consulta("UPDATE usuarios SET Password='$cifrado' WHERE Email ='$mail_usuario'");	

								if(!$consulta){
									die('Error al realizar la consulta');
									desconectar();
								}else{

									$sql = new conection();
									//Realizamos la conexión llamando a la función conectar().
									$conexion = $sql -> conectar();
									$consulta = $sql->ejecutar_consulta("DELETE FROM recuperar WHERE Codigo =$codigo");

									if(!$consulta){
										die('Error al realizar la consulta');
										desconectar();
									}else{
									
										echo '<script language="javascript">window.alert("¡¡Has cambiado la contraseña!!");window.location="index.php";</script>';
									}
								}
							}else{
								echo '<script language="javascript">alert("Las contraseñas no coinciden");</script>';
							}
						}
					}else{
						echo '<script language="javascript">alert("La contraseña no puede estar vacía");</script>';
					}
				}
			}
		}
		if(empty($mail_usuario)){
			header('location: 404.php');
		}
	}else{
		header('location: 404.php');
	}
?>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
<?php include('cabecera_backoffice.php'); ?>
	</head>
	<body>
		<div id="contenedor">
			<article id="cuerpo">
				<h1 class="titulo">Cambiar Contraseña:</h1>
				<div class="contenido">
					<form id="acceder" action="#" method="POST" ENCTYPE="multipart/form-data">
						<table>
							<tr>
								<td class="etiqueta">
									<label>Nueva Contraseña: * </label>
								</td>
								<td>
									<input type="password" name="npass" maxlength="50" placeholder="Introduce la contraseña">
								</td>
							</tr>
							<tr>
								<td class="etiqueta">
									<label>Repetir Contraseña: * </label>
								</td>
								<td>
									<input type="password" name="rnpass" maxlength="50" placeholder="Repite la contraseña">
								</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:left">
									<br />
									<button name="aceptar" type="submit" value="Enviardatos">Aceptar</button>
									<button name="enviar" type="reset" value="Enviardatos">Cancelar</button>
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

	backoffice_login();
	
?>
