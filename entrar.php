<?php
	//Iniciamos sesión.
	SESSION_START();
	//Incluimos el archivo datos.php con los datos de la base de datos.
	include('datos.php');
	//Variable para indicar el nombre de la página en el titulo.
	$pagina = "Inicia sesión";
	//Llamamos al css de registro.
	$css = 'registro.css';

	//guardamos en una variable el valor del botón del formulario.
	@$enviar = $_REQUEST['enviar'];
	//Contador para ir acumulando los errores.
	$error = 0;

	//Si se ha pulsado el botón enviar.
    if(isset($enviar)){
    	//Se guardan en variables los valores introducidos en los campos del formulario.
    	$user = $_REQUEST['user'];
		$pass = $_REQUEST['passw'];

		//Si el usuario o la contraseña están vacíos, mostrar 'No pueden haber campos vacíos'
		if(empty($user) || empty($pass)){
			echo '<script language="javascript">alert("No pueden haber campos vacíos");</script>';
		//Sino, realiza una consulta a la base de datos solicitando todo lo que hay dentro de la tabla usuarios y guarda en arrays.'
		}else{
			$result_set=mysqli_query($con, "SELECT * FROM usuarios") or die("Error al realizar la consulta");
			while($row=mysqli_fetch_row($result_set)){
            	$users[] = $row[1];
        	}

        	//Si el usuario introducido no existe en el array $users, mostrar 'El usuario introducido no existe'.
        	if(!in_array($user, $users)){
        		echo '<script language="javascript">alert("¡El usuario introducido no existe!");</script>';
        	}else{
        		//Realizamos una consulta a la base de datos solicitando todos los datos del usuario introducido.
       			$result_set=mysqli_query($con, "SELECT * FROM usuarios WHERE Login='$user'") or die("Error al realizar la consulta");
				while($row=mysqli_fetch_row($result_set)){
            		$nombre = $row[1];
            		$password = $row[2];
            		$email= $row[3];
            		$tipo = $row[4];
        		}
        		//Validamos la contraseña y guardamos en variables de sesión los datos del usuario.
        		if(md5($pass) == $password){
        			$_SESSION['user'] = $user;
            		$_SESSION['email'] = $email;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['tipo'] = $tipo;
                    $_SESSION['registro'] = "Último acceso: " . date('d') . " de " . date('M') . " del " . date('Y') . " a las " . date('H:i:s');
           			header("Location: index.php");
        		
           		//Sino, se muestra que la contraseña introducida no es correcta.
        		}else{
        			echo '<script language="javascript">alert("¡La contraseña introducida no es correcta!");</script>';
        		}
        	}
		}
	}
	include('cabecera.php');

?>
	<article id="cuerpo">
		<h1 class="titulo">Accede a nuestra web</h1>
		<div class="contenido">
			<form id="acceder" action="#" method="POST" ENCTYPE="multipart/form-data">
				<table>
					<tr>
						<td>
							<label>Login / Nickname: * </label>
						</td>
						<td>
							<input type="text" name="user" maxlength="50" size="25" placeholder="Introduce tu usuario">
						</td>
					</tr>
					<tr>
						<td>
							<label>Contraseña: * </label>
						</td>
						<td>
							<input type="password" name="passw" maxlength="50" size="25" placeholder="Introduce tu contraseña">
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:left">
							<br />
							<button name="enviar" type="submit" value="Enviardatos">Aceptar</button>
							<button name="enviar" type="reset" value="Enviardatos">Borrar</button>
						</td>
					</tr>
				</table>
			</form>
	</article>
	<div style="margin-top: -30px">
<?php
		include('pie.php');
?>
	</div>
	</body>
</html>