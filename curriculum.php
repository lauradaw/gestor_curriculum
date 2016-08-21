<?php
			SESSION_START();
			include('datos.php');
	    	$pagina = 'Registro de Curriculums';
	    	$pagina_contenido = "curriculums";
	    	$css = 'registro.css';
	   		@$user = $_SESSION['user'];

	   		include('cabecera.php');

			while($row=mysqli_fetch_row($result_set)){
            	$is_admin = $row[5];
        	}

        	$ID = array();

        	@$result_set=mysqli_query($con,"SELECT * FROM menucurriculum") or die("Error al realizar la consulta");
			while($row=mysqli_fetch_row($result_set)){
				$ID[] = $row[0];
				$nom[] = utf8_encode($row[1]);
				$apellidos[] = utf8_encode($row[2]);
				$email[] = $row[3];
				$tel[] = $row[6];
				$foto[] = $row[8];
        	}

        	$longitud_db = count($ID);

        	@$result_set=mysqli_query($con,"SELECT * FROM comentarios") or die("Error al realizar la consulta");
			while($row=mysqli_fetch_row($result_set)){
				$idco[] = $row[0];
				$valoracion[] = $row[1];
				$entrevista[] = $row[2];
				$Redactor[] = $row[3];
        	}

		if(@$longitud_db < 1){
			echo '<script language="javascript">window.alert("No hay Curriculums para mostrar."); window.history.back();</script>';
		}
		else
		{

		if(@$is_admin < 2){
			echo '<script language="javascript">window.alert("No tienes permisos para visualizar esta página.\nLogueate como administrador para acceder a esta página."); window.location="entrar.php";</script>';
		}
		else
		{
			
		}
	?>

			<article id="cuerpo">
				<h1 class="titulo">Registro de Currículums</h1>
				<div class="contenido">
					<?php
					echo '<table id="t01" style="width:1300px">';

					for($i=0; $i < @$longitud_db; $i++){
						echo '<tr>
								<td><img src="img/usuarios/' . $foto[$i] . '" height="60px"></td>
								<td><strong>Nombre:</strong> ' . $nom[$i] . ' ' . $apellidos[$i] . ' </td>
								<td><strong>Email:</strong> <a href="mailto:' . $email[$i] . '" alt= "Enviar un mail a ' . $nom[$i] . '" title="Enviar un mail a ' . $nom[$i] . '">' . $email[$i] . '</a></td>
								<td><strong>Teléfono:</strong> ' . $tel[$i] . ' </td>
								<td><strong>Valoración:</strong> ' . @$valoracion[$i] . '</td>
								<td>
									<span id="menu_curriculum"><a href="ver_curriculum.php?id=' . $ID[$i] . '"><img src="img/ver.png" alt="Consultar este curriculum" title="Consultar este curriculum"></a></span>
									<span id="menu_curriculum"><a href=""><img src="img/editar.png" alt="Modificar este curriculum" title="Modificar este curriculum"></a></span>
									<span id="menu_curriculum"><a href=""><img src="img/eliminar.png" alt="Eliminar este curriculum" title="Eliminar este curriculum"></a></span>
								</td>
							  </tr>';
					}

					echo '</table>';
					?>
					<div style="margin-bottom: 120px">&nbsp;</div>
				</div>
			</article>
			<?php
		}
				include('pie.php');
			?>
		</div>
	</body>
</html>