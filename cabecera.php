<?php
	//Incluimos el archivo datos.php que contiene los datos de conexión de la base de datos.
	include('datos.php');
?>

	<html>
		<head>
			<title><?php /*Llamamos al título de la página */echo $_titulo ?> || <?php echo $pagina ?></title>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
			<link rel="stylesheet" type="text/css" href="css/<?php echo @$css ?>" media="screen" />

			<style>
				#primero:hover{
					cursor: pointer;
					background-color: #376bb1;
					color: white;
					transition: .1s;
					-webkit -transition: .1s;
				}
				#segundo:hover{
					cursor: pointer;
					background-color: #376bb1;
					color: white;
					transition: .1s;
					-webkit -transition: .1s;
				}
				#tercero:hover{
					cursor: pointer;
					background-color: #376bb1;
					color: white;
					transition: .1s;
					-webkit -transition: .1s;
				}
				#cuarto:hover{
					cursor: pointer;
					background-color: #376bb1;
					color: white;
					transition: .1s;
					-webkit -transition: .1s;
				}
			</style>
		</head>
		<body>

			<?php
				//Declaramos las variables de sesión $time y $user
				$time = @$_SESSION['registro'];
				$user = @$_SESSION['user'];

				//Realizamos una consulta para cargar los datos del usuario que acaba de iniciar sesión.
				$result_set=mysqli_query($con, "SELECT * FROM usuarios Where Login='$user'") or die("Error al realizar la consulta");
				while($row=mysqli_fetch_row($result_set)){
					$email_db = utf8_decode($row[3]);
					$nombre = utf8_decode($row[1]);
					$nombre_db = utf8_decode($row[1]);
            		$is_admin = $row[4];
        		}

			?>
			<section id="contenedor">
				<header>
					<img id="logo" src="img/logotipo.png">
					<nav id="navegacion">
						<ul id="menu">
							<li>
								<a href="index.php" alt="Página de Inicio" title="Página de Inicio"><img src="img/home.png"></a> 
							</li>
						<?php
						//Según si hay usuario o no, o el tipo de usuario se mostrará una cosa u otra.
							if (is_null($user)){
						?>
								<li>
									<a href="entrar.php" alt="Inicia sesión" title="Inicia sesión">
										<img src="img/locked.png">
									</a>
								</li>
								<li>
									<a href="registro.php" alt="Registrate en nuestra web" title="Registrate en nuestra web">
										<img src="img/registro.png">
									</a>
								</li>
								<li>
										<a href="contacto.php" alt="Contacte con nosotros" title="Contacte con nosotros">
											<img src="img/mail.png">
										</a>
								</li>
						<?php
							}else{
								//1 = usuario, 2 = administrador, 3 = RRHH.
								if($is_admin == 2){
									echo '<li>
											<a href="perfil.php" alt="Edita tu perfil" title="Edita tu perfil">
												<img src="img/document.png">
											</a>
										 </li>
										 <li>
											<a href="usuarios.php"  alt="Gestiona los usuarios" title="Gestiona los usuarios">
												<img src="img/usuarios.png">
											</a>
										 </li>
										 <li>
											<a href="nuevo.php"  alt="Crea un nuevo usuario" title="Crea un nuevo usuario">
												<img src="img/nuser.png">
											</a>
										 </li>';

								}else if($is_admin == 3){
									echo '<li>
											<a href="perfil.php" alt="Edita tu perfil" title="Edita tu perfil">
												<img src="img/document.png">
											</a>
										 </li>
										 <li>
											<a href="curriculum.php"  alt="Registro de curriculums" title="Registro de curriculums">
												<img src="img/document.png">
											</a>
										 </li>';
								}else{
									echo '<li>
											<a href="perfil.php" alt="Edita tu perfil" title="Edita tu perfil">
												<img src="img/document.png">
											</a>
										 </li>
										<li>
											<a href="nuevo_curriculum.php" alt="Sube tu curriculum" title="Sube tu curriculum">
												<img src="img/document.png">
											</a>
										</li>
										<li>
											<a href="contacto.php" alt="Contacte con nosotros" title="Contacte con nosotros">
												<img src="img/mail.png">
											</a>
										</li>';
								}
							}
						?>
						<?php
							//Si se está logueado, aparecerá el icono para cerrar sesión.
							if (!is_null($user)){
								echo '<li>
										<a href="cerrarsesion.php" alt="Cierre su sesión" title="Cierre su sesión">
											<img src="img/exit.png">
										</a>
									 </li>';
							}
						?>
						</ul>
					</nav>
					<section>
						<?php
							//Si el usuario es un visitante, aparecerá un login para poder acceder a la web.
							if (is_null($user)){
								echo '<article id="carro">
										<p><form id="acceder" action="entrar.php" method="POST"><span id="login">Usuario: <input type="text" name="user" placeholder="Introduce usuario"></span><span id="login">Contraseña: <input type="password" name="passw" placeholder="Introduce contraseña"></span><span id="login"><button name="enviar" type="submit" value="Enviardatos">Entrar</button></span></form></p>
									 </article>';
							}
						?>
					</section>
				</header>
				<div style="margin-bottom: 70px">&nbsp;</div>