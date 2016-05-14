<?php
	SESSION_START();
	//Incluimos el archivo datos.php que contiene los datos de conexión de la base de datos.
	include('datos.php');
	//Variable para indicar el nombre de la página en el titulo.
	$pagina = 'Nuevo Currículum';
	//Llamamos al css de contacto.
	$css = 'contacto.css';

	if($_SESSION['user']){
		$user = $_SESSION['user'];
		
		if(empty($_SESSION['session'])){
			$_SESSION['session'] = "DatosPersonales";	
		}

		if(isset($_POST['refr'])){
			$_SESSION['session'] = empty($_SESSION['session']);
			header('location: #');
		}

		switch($_SESSION['session']){
			case "DatosPersonales":
				//Variable para indicar el nombre de la página en el titulo.
				$pagina = 'Datos Personales';
				include('cabecera.php');		
?>
				<style>
					#primero{
						background-color: #376bb1;
						color: white;
					}
					#segundo{
						background-color: white;
					}
					#tercero{
						background-color: white;
					}
					#cuarto{
						background-color: white;
					}
				</style>
				<article id="cuerpo">
					<form action="#" method="POST">
							<button style="width: 220px;" id="primero" name="step1">Datos Personales</button>
							<button style="width: 220px;" id="segundo" name="step2">Formación Reglada</button>
							<button style="width: 220px;" id="tercero" name="step3">Formación No Reglada</button>
							<button style="width: 220px;" id="cuarto" name="step4">Hobbbies</button>
							<button style="width: 220px;" id="refr" name="refr">Refrescar Sesion</button>
					</form>
					<h1 class="titulo"></h1>
					<div class="contenido">
<?php
				if(isset($_POST['step2'])){
					$_SESSION['session'] = "FormaciónReglada";
					header('location: #');
				}
				if(isset($_POST['step3'])){
					$_SESSION['session'] = "FormaciónNoReglada";
					header('location: #');
				}
				if(isset($_POST['step4'])){
					$_SESSION['session'] = "Hobbies";
					header('location: #');
				}
				//Se incluye el pie de página.
				include('pie.php');
				echo '		</div>
						</body>
					</html>';
			break;

			case "FormaciónReglada":
				//Variable para indicar el nombre de la página en el titulo.
				$pagina = 'Formación Reglada';
				include('cabecera.php');
?>
				<style>
					#primero{
						background-color: white;
					}
					#segundo{
						background-color: #376bb1;
						color: white;
					}
					#tercero{
						background-color: white;
					}
					#cuarto{
						background-color: white;
					}
				</style>
				<article id="cuerpo">
					<form action="#" method="POST">
							<button style="width: 220px;" id="primero" name="step1">Datos Personales</button>
							<button style="width: 220px;" id="segundo" name="step2">Formación Reglada</button>
							<button style="width: 220px;" id="tercero" name="step3">Formación No Reglada</button>
							<button style="width: 220px;" id="cuarto" name="step4">Hobbbies</button>
							<button style="width: 220px;" id="refr" name="refr">Refrescar Sesion</button>
					</form>
				
					<div class="contenido">
<?php
				if(isset($_POST['step1'])){
					$_SESSION['session'] = "DatosPersonales";
					header('location: #');
				}
				if(isset($_POST['step3'])){
					$_SESSION['session'] = "FormaciónNoReglada";
					header('location: #');
				}
				if(isset($_POST['step4'])){
					$_SESSION['session'] = "Hobbies";
					header('location: #');
				}
				//Se incluye el pie de página.
				include('pie.php');
				echo '		</div>
						</body>
					</html>';
			break;
			case "FormaciónNoReglada":
				//Variable para indicar el nombre de la página en el titulo.
				$pagina = 'Formación No Reglada';
				include('cabecera.php');
?>
				<style>
					#primero{
						background-color: white;
					}
					#segundo{
						background-color: white;
					}
					#tercero{
						background-color: #376bb1;
						color: white;
					}
					#cuarto{
						background-color: white;
					}
				</style>

				<article id="cuerpo">
					<form action="#" method="POST">
							<button style="width: 220px;" id="primero" name="step1">Datos Personales</button>
							<button style="width: 220px;" id="segundo" name="step2">Formación Reglada</button>
							<button style="width: 220px;" id="tercero" name="step3">Formación No Reglada</button>
							<button style="width: 220px;" id="cuarto" name="step4">Hobbbies</button>
							<button style="width: 220px;" id="refr" name="refr">Refrescar Sesion</button>
					</form>
					<div class="contenido">
						
<?php
					if(isset($_POST['step1'])){
						$_SESSION['session'] = "DatosPersonales";
						header('location: #');
					}
					if(isset($_POST['step2'])){
						$_SESSION['session'] = "FormaciónReglada";
						header('location: #');
					}
					if(isset($_POST['step4'])){
						$_SESSION['session'] = "Hobbies";
						header('location: #');
					}

					//Se incluye el pie de página.
					include('pie.php');
					echo '		</div>
							</body>
						</html>';
			break;
			case "Hobbies":
				//Variable para indicar el nombre de la página en el titulo.
				$pagina = 'Hobbies';
				include('cabecera.php');
?>
				<style>
					#primero{
						background-color: white;
					}
					#segundo{
						background-color: white;
					}
					#tercero{
						background-color: white;
					}
					#cuarto{
						background-color: #376bb1;
						color: white;
					}
				</style>

				<article id="cuerpo">
					<form action="#" method="POST">
							<button style="width: 220px;" id="primero" name="step1">Datos Personales</button>
							<button style="width: 220px;" id="segundo" name="step2">Formación Reglada</button>
							<button style="width: 220px;" id="tercero" name="step3">Formación No Reglada</button>
							<button style="width: 220px;" id="cuarto" name="step4">Hobbbies</button>
							<button style="width: 220px;" id="refr" name="refr">Refrescar Sesion</button>
					</form>
					<div class="contenido">

<?php
				if(isset($_POST['step1'])){
					$_SESSION['session'] = "DatosPersonales";
					header('location: #');
				}
				if(isset($_POST['step2'])){
					$_SESSION['session'] = "FormaciónReglada";
					header('location: #');
				}
				if(isset($_POST['step3'])){
					$_SESSION['session'] = "FormaciónNoReglada";
					header('location: #');
				}

				//Se incluye el pie de página.
				include('pie.php');
				echo '		</div>
						</body>
					</html>';	
	}


	}else{

		header('location: entrar.php');
	}
?>