<?php
	//Iniciamos la sesión
	SESSION_START();
	//Incluimos el archivo de conexión con la base de datos.
	include('conectar.php');
	include('funciones2.php');
?>

	<html>
		<head>
			<title><?php /*Llamamos al título de la página */echo $_titulo ?> || <?php echo $pagina ?></title>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
			<link rel="stylesheet" type="text/css" href="css/<?php echo $css ?>" media="screen" />
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
			<script type="text/javascript">
				$(document).ready(main);
					function main(){
						$("#siguiente").click(function(){
							var actual = $(".pagina_actual");
							if(actual.next().html() != null){
								actual.next().addClass("pagina_actual");
								actual.removeClass("pagina_actual");
							}
							/*if($("input[name=NHobbie]").val() == ""){
								$("input[name=NHobbie]").parent().parent().hide();
							}*/
						});
						$("#atras").click(function(){
							var actual = $(".pagina_actual");
							if(actual.prev().html() != null){
								actual.prev().addClass("pagina_actual");
								actual.removeClass("pagina_actual");
							}
						});
						$(".anadir").click(function(e){
							e.preventDefault();
							var contenidoFila = $(this).parents("tbody").children().first().html();
							var nuevaFila = $("<tr></tr>");
							nuevaFila.append(contenidoFila);
							$(this).parents("tr").parent().prepend(nuevaFila);
						});

					}
			</script>
			<style>
				.pagina{
					height: 50vh;
					display: none;
				}
				.pagina_actual {
					display: block;
				}
			</style>
		</head>
		<body>
			<section id="contenedor">
				<header>
					<img id="logo" src="img/logotipo.png">
					<nav id="navegacion">
						<ul id="menu">
							<li>
								<a href="index.php" alt="Página de Inicio" title="Página de Inicio"><img src="img/home.png"></a> 
							</li>
<?php
		//Dependiendo de si se está logueado o no, la cabecera será diferente.
		@$user = $_SESSION['user'];

        if(!empty($user)){

				echo 		'<li>
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
							</li>
							<li>
								<a href="cerrarsesion.php" alt="Cierre su sesión" title="Cierre su sesión">
									<img src="img/exit.png">
								</a>
							</li>
						</ul>
					</nav>'
				;
        }else{
            	echo 		'<li>
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
						</ul>
					</nav>'
				;

				//Se muestra el formulario de acceso a la página.
				echo '<section>
						<article id="carro">
							<p>
								<form id="acceder" action="#" method="POST">
									<span id="login">Usuario: 
										<input type="text" name="user" placeholder="Introduce usuario">
									</span>
									<span id="login">
										Contraseña: 
										<input type="password" name="passw" placeholder="Introduce contraseña">
									</span>
									<span id="login">
										<button name="enviar" type="submit" value="Enviardatos">Entrar</button>
									</span>
								</form>
							</p>
					 	</article>
					 </section>'
				;

				entrar();

        }
	?>
			</header>
			<div style="margin-bottom: 70px">&nbsp;</div>