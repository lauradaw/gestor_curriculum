<?php
	function session_clear(){
		$_SESSION['nombre'] = "";
		$_SESSION['apellidos'] = "";
		$_SESSION['nacimiento'] = "";
		$_SESSION['direccion'] = "";
		$_SESSION['tel'] = "";
		$_SESSION['nacionalidad'] = "";
		$_SESSION['foto'] = "";

		$_SESSION['session'] = empty($_SESSION['session']);
}

	function desplegar_botones(){
		echo '<form action="#" method="POST">
				<button type="submit" style="width: 220px;" id="primero" name="step1">Datos Personales</button>
				<button type="submit" style="width: 220px;" id="segundo" name="step2">Formación Reglada</button>
				<button type="submit" style="width: 220px;" id="tercero" name="step3">Formación No Reglada</button>
				<button type="submit" style="width: 220px;" id="cuarto" name="step4">Hobbbies</button>
				<button type="submit" style="width: 220px;" id="refr" name="refr">Refrescar Sesion</button>
			 </form>'
		;
	}

	function validar(){

		switch ($_SESSION['session']){
			case 1:

				if(is_null($_POST['nombre']) || is_null($_POST['apellidos']) || is_null($_POST['nacimiento']) || is_null($_POST['nacionalidad'])){
					$error ++;
					echo '¡Algunos campos no pueden estar vacíos!';
				}

				if(!preg_match("^[0-9]{4}/[0-1][0-9]/[0-3][0-9]$",$_POST['nacimiento'])){
					$error ++;
					echo '¡El formato de la fecha no es correcto!';
				}

				if($error == 0){
					$_SESSION['nombre'] = $_POST['nombre'];
					$_SESSION['apellidos'] = $_POST['apellidos'];
					$_SESSION['nacimiento'] = $_POST['nacimiento'];
					$_SESSION['direccion'] = $_POST['direccion'];
					$_SESSION['tel'] = $_POST['tel'];
					$_SESSION['nacionalidad'] = $_POST['nacionalidad'];
					$_SESSION['foto'] = $_POST['foto'];
				}
				
			break;

			case 2:


				if(is_null($_POST['categoria']) || is_null($_POST['estudio']) || is_null($_POST['descripcion']) || is_null($_POST['graduacion']) || is_null($_POST['fechatit'])){
					$error ++;
					echo '¡Los campos no pueden estar vacíos!';
				}

				if(!preg_match("^[0-9]{4}/[0-1][0-9]/[0-3][0-9]$",$_POST['fechatit'])){
					$error ++;
					echo '¡El formato de la fecha no es correcto!';
				}

				if($error == 0){
					$_SESSION['categoria'] = $_POST['categoria'];
					$_SESSION['estudio'] = $_POST['estudio'];
					$_SESSION['descripcion'] = $_POST['descripcion'];
					$_SESSION['graduacion'] = $_POST['graduacion'];
					$_SESSION['fechatit'] = $_POST['fechatit'];
				}
				
			break;

			case 3:

				$_SESSION['tituloFN'] = $_POST['tituloFN'];
				$_SESSION['descripcionFN'] = $_POST['descripcionFN'];
				$_SESSION['tipoFN'] = $_POST['tipoFN'];
				
			break;

			case 4:

				$_SESSION['NHobbie'] = $_POST['NHobbie'];
				$_SESSION['DHobbie'] = $_POST['DHobbie'];
				
			break;
		}

	}

?>