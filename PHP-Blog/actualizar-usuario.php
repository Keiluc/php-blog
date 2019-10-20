<?php  
if(isset($_POST)){
	
	//CONEXION A LA BASE DE DATOS E INICIAR SESSION
	require_once 'includes/conexion.php';

	
	//RECOGER LOS VALORES DEL FORMULARIO DE ACTUALIZACION	
	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre'])  : false;
	$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos'])  : false;
	$email  = isset($_POST ['email']) ? mysqli_real_escape_string($db, trim($_POST ['email']))  : false;
	}
	
	// Array de errores
	$errores = array();

	//VALIDAR LOS DATOS ANTES DE GUARDARLOS EN LA BASE DE DATOS


//validar nombre
	if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
		$nombre_validado = true;
	}else{
		$nombre_validado = false;
		$errores ['nombre'] = "El nombre no es valido";
	}
//validar apellidos

	if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
		$apellidos_validado = true;
	}else{
		$apellidos_validado = false;
		$errores ['apellidos'] = "Los apellidos no son valido";
	}

//validar email

	if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
		$email_validado = true;
	}else{
		$email_validado = false;
		$errores ['email'] = "El email no es valido";
	}

	$guardar_usuario = false;
		
	if (count($errores) == 0) {
		$usuario = $_SESSION['usuario'];
		$guardar_usuario = true;


	//COMPROBAR SI EL EMAIL YA EXISTE
	$sql = "SELECT id, email FROM usuarios WHERE email = '$email';";
	$isset_email = mysqli_query($db, $sql);
	$isset_user = mysqli_fetch_assoc($isset_email);

	if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
		//ACTUALIZAR USUARIO EN LA TABLA DE USUARIOS DE LA BBDD

			$usuario = $_SESSION['usuario'];
			$sql = "UPDATE usuarios SET ".
			 		"nombre = '$nombre', ". 
			 		"apellido = '$apellidos',".
			 		"email = '$email' ".
				 	"WHERE id = ".$usuario['id'];
			$guardar = mysqli_query($db, $sql);

		

			if (!empty($guardar)) {
				$_SESSION['usuario']['nombre'] = $nombre;
				$_SESSION['usuario']['apellido'] = $apellidos;
				$_SESSION['usuario']['email'] = $email;

				$_SESSION['completado'] = 'Tus datos se han actualizado con exito';
			}else{
				$_SESSION ['errores'] ['general'] = 'Fallo al actualizar tus datos';
			}
		}else{
			$_SESSION ['errores'] ['general'] = 'El usuario ya existe';
		}


	}else{
		$_SESSION['errores'] = $errores;
	}
	
	header('Location: mis-datos.php');
?>
