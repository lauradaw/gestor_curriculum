<?php
	//Iniciamos sesión
	SESSION_START();
	//Incluimos el archivo con los datos de conexión
	include('datos.php');
	//Indicamos el título de la página
	$pagina = "Eliminar usuarios";
	//metemos la la sesión iniciada por el usuario en una variable
	$user = $_SESSION['user'];
	//metemos en una variable el parámetro get recibido de la página usuarios.php
	$usuario_ad = $_GET['borrar'];

		//Si no se ha recibido ningún parámetro, redireccionará a index.php
		if(!$usuario_ad){
			header('location: index.php');
		}
		//Realizamos una consulta para comprobar el tipo de usuario.
		$result_set=mysqli_query($con,"SELECT * FROM usuarios Where Login='" . $user . "'") or die("Error al realizar la consulta1");
		while($row=mysqli_fetch_row($result_set)){
    		$is_admin = $row[4];
    	}
    	//Realizamos otra consulta para saber qué ID tiene el usuario pasado por parámetro, será necesaria para eliminar las foreign key
    	$consulta_ID = "SELECT * FROM usuarios WHERE Login='" . $usuario_ad . "'";
    	$result_set = mysqli_query($con, $consulta_ID) or die("Error en la consulta2");
    	while($row = mysqli_fetch_row($result_set)){
    		$ID = $row[0];
    	}
    	//Ahora realizaremos consultas para acumular en arrays todas las ID de las tablas datospersonales, formacionreglada, formacionnoreglada, hobbies y comentarios.
    	$consulta_datosP = "SELECT * FROM datospersonales";
    	$result_set = mysqli_query($con, $consulta_datosP) or die("Error en la consulta3");
    	while($row = mysqli_fetch_row($result_set)){
    		$ID_dt[] = $row[0];
    	}

    	$consulta_datosF = "SELECT * FROM formacionreglada";
    	$result_set = mysqli_query($con, $consulta_datosF) or die("Error en la consulta4");
    	while($row = mysqli_fetch_row($result_set)){
    		$ID_f[] = $row[0];
    	}

    	$consulta_datosFN = "SELECT * FROM formacionnoreglada";
    	$result_set = mysqli_query($con, $consulta_datosFN) or die("Error en la consulta4");
    	while($row = mysqli_fetch_row($result_set)){
    		$ID_fn[] = $row[0];
    	}

    	$consulta_hobbies = "SELECT * FROM hobbies";
    	$result_set = mysqli_query($con, $consulta_hobbies) or die("Error en la consulta5");
    	while($row = mysqli_fetch_row($result_set)){
    		$ID_h[] = $row[0];
    	}

    	$consulta_comentarios = "SELECT * FROM comentarios";
    	$result_set = mysqli_query($con, $consulta_comentarios) or die("Error en la consulta6");
    	while($row = mysqli_fetch_row($result_set)){
    		$ID_c[] = $row[0];
    	}

    	//Ahora nos aseguramos de que solo el administrador puede acceder a esta página.
		if(!$is_admin == 2){
			echo '<script language="javascript">window.alert("No tienes permisos para visualizar esta página.\nLogueate como administrador para acceder a esta página."); window.location="entrar.php";</script>';
		}else{
			//Como ya tenemos todas las ID acumuladas en arrays, simplemente, comprobamos si la ID del usuario a eliminar existe en ellas, si existe, hará un delete y así eliminaremos las claves foraneas y no tendremos problemas para eliminar al user.
			if(in_array($ID, @$ID_dt)){
				$consulta1 = "DELETE FROM datospersonales WHERE IDdatosPersonales='" . $ID . "'";

				if($con->query($consulta1) === TRUE){

				}else{
					echo '<script language="javascript">window.alert("¡Error al eliminar los datos personales!"); window.location="usuarios.php";</script>';
				}
			}
			if(in_array($ID, @$ID_f)){
				$consulta2 = "DELETE FROM formacionreglada WHERE IDFormacionReglada='" . $ID . "'";

				if($con->query($consulta2) === TRUE){

				}else{
					echo '<script language="javascript">window.alert("¡Error al eliminar la formación reglada!"); window.location="usuarios.php";</script>';
				}
			}
			if(in_array($ID, @$ID_fn)){
				$consulta3 = "DELETE FROM formacionnoreglada WHERE IdFormacionNoReglada='" . $ID . "'";

				if($con->query($consulta3) === TRUE){

				}else{
					echo '<script language="javascript">window.alert("¡Error al eliminar la formación no reglada!"); window.location="usuarios.php";</script>';
				}
			}
			if(in_array($ID, @$ID_h)){
				$consulta4 = "DELETE FROM hobbies WHERE IDHobbies='" . $ID . "'";

				if($con->query($consulta4) === TRUE){

				}else{
					echo '<script language="javascript">window.alert("¡Error al eliminar los hobbies!"); window.location="usuarios.php";</script>';
				}
			}
			if(in_array($ID, @$ID_c)){
				$consulta5 = "DELETE FROM comentarios WHERE IdComentarios='" . $ID . "'";

				if($con->query($consulta5) === TRUE){

				}else{
					echo '<script language="javascript">window.alert("¡Error al eliminar los comentarios!"); window.location="usuarios.php";</script>';
				}
			}
			//Si hubiese un error a la hora de eliminar las claves foraneas, el usuario no sería eliminado ya que siempre que hay error, redirecciona a usuarios.php
			//Si no existen datos en las claves foraneas o no ha habido errores al eliminarlas, se realizará una consulta delete para eliminar al usuario recibido por parámetro
			$consulta = "DELETE FROM usuarios WHERE Login='" . $usuario_ad . "'";
			if($con->query($consulta) === TRUE){
				//Si funciona te dice que ha funcionado y te redirecciona a usuarios.php
				echo '<script language="javascript">window.alert("¡Se ha eliminado el usuario ' . $usuario_ad . ' correctamente!"); window.location="usuarios.php";</script>';
			}else{
				//Sino, te salta error y te reedirecciona a usuarios.php (el usuario no será eliminado).
				echo '<script language="javascript">window.alert("¡Error al eliminar el usuario!"); window.location="usuarios.php";</script>';
			}
			
			//cerramos la conexión 
			mysqli_close($con);
		}
?>		
	</body>                                                          
</html>