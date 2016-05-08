<?php
	//Iniciamos sesión
	SESSION_START();
	//Incluimos el archivo de configuración de la conexión con la base de datos.
	include('datos.php');
	//Indicamos el nombre de la página que aparecerá en el title.
	$pagina = 'Usuarios Registrados';
	//Llamamos al css registro.css
	$css = 'registro.css';
	//Guardamos la sesión del usuario en una variable.
	@$user = $_SESSION['user'];
	//Realizamos una consulta en la base de datos para buscar el rango del usuario logueado.
	$result_set=mysqli_query($con,"SELECT * FROM usuarios Where Login='$user'") or die("Error al realizar la consulta");
	while($row=mysqli_fetch_row($result_set)){
        $is_admin = $row[4];
    }
    //Realizamos una consulta a la base de datos para solicitar todos los datos de la tabla usuarios en orden ascendente.
	$result_set=mysqli_query($con,"SELECT * FROM usuarios ORDER BY Login ASC") or die("Error al realizar la consulta");
	while($row=mysqli_fetch_row($result_set)){
		$login_user[] = $row[1];
		$email_user[] = $row[3];
        $is_admin_user[] = $row[4];
        $longitud_db = count($login_user);
    }
    //Comprobamos que el usuario logueado sea el administrador.
	if(@$is_admin < 2 || @$is_admin > 2){
		echo '<script language="javascript">window.alert("No tienes permisos para visualizar esta página.\nLogueate como administrador para acceder a esta página."); window.location="entrar.php";</script>';
	}
	//Llamamos a la cabecera.
	include('cabecera.php');
?>
	<article id="cuerpo">
		<h1 class="titulo">Registro de Usuarios</h1>
		<div class="contenido">
			<?php
				echo '<table id="t01" style="width:1100px">';
				echo '	<tr>';
				echo '		<th>Usuario</th>';
				echo '		<th>Email</th>';
				echo '		<th>Rango</th>';
				echo '		<th>Acciones</th>';
				echo '	</tr>';
				//Recorremos con un for la longitud del array formado por el número de usuarios registrados en la base de datos.
				for($i=0; $i < $longitud_db; $i++){
					echo '<tr>
							<td>'; 
					echo '		<span style="margin:15px;">' . $login_user[$i] . '</span>';
					echo '	</td>';
					echo '	<td>';//Mostrará el email y permitirá enviar un mensaje por correo electrónico.
					echo '		<a href="mailto:' . $email_user[$i] . '" alt="Enviar un mail a ' . utf8_encode($login_user[$i]) . '" title="Enviar un mail a ' . utf8_encode($login_user[$i]) . '">' . $email_user[$i] . '</a>';
					echo '	</td>
							<td>'; //Comprobamos según el número del tipo e indicamos en letras si es usuario, administrador o RRHH.
								if($is_admin_user[$i] == 2){
									echo 'Administrador';
								}
								if($is_admin_user[$i] == 3){
									echo 'Recursos Humanos';
								}
								if($is_admin_user[$i] == 1){
									echo 'Usuario';
								}
							//Enviamos por método GET el usuario a la página de editar y a la página de eliminar_usuarios.
					echo '	</td>
							<td>
								<span id="menu_curriculum">
									<a class="iconos" href="editar.php?editar=' . $login_user[$i] . '">
										<img src="img/editar.png">
									</a>
								</span>
								<span id="menu_curriculum" name="prueba">
									<a class="iconos" href="eliminar_usuarios.php?borrar=' . $login_user[$i] . '">
										<img src="img/eliminar.png">
									</a>
								</span>
							</td>
						</tr>';
					}
				echo '</table>';
					?>
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