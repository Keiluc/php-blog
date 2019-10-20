
<?php 


	/*

	if (isset($_POST['nombre'])) {
	}else{
		$nombre = false;
		///ES IGUAL A DECIR =
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
	}*/



if(isset($_POST)){
	
	//CONEXION A LA BASE DE DATOS E INICIAR SESSION
	require_once 'includes/conexion.php';

	
	//RECOGER LOS VALORES DEL FORMULARIO DE REGISTRO	
	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre'])  : false;
	$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos'])  : false;
	$email  = isset($_POST ['email']) ? mysqli_real_escape_string($db, trim($_POST ['email']))  : false;
	$password  = isset($_POST ['password']) ? mysqli_real_escape_string($db, $_POST ['password']) : false;
		/*si existe password dentro de Post ?entonces es = a pasword :si NO es = a false*/

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

//validar password

	if (!empty($password)){
		$password_validado = true;
	}else{
		$password_validado = false;
		$errores ['password'] = "La password esta vacia";
	}


	$guardar_usuario = false;
	if (count($errores) == 0) {
		$guardar_usuario = true;

	//CIFRAR LA CONTASEÑA

		$password_segura = password_hash($password, PASSWORD_BCRYPT, ['coast =>4']);
/*
		var_dump($password);
		var_dump($password_segura);
		var_dump(password_verify($password, $password_segura));
		die();
*/

	//INSERTAR USUARIO EN LA TABLA DE USUARIOS DE LA BBDD

		$sql = "INSERT INTO usuarios VALUES (null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
		$guardar = mysqli_query($db, $sql);

	

		if (!empty($guardar)) {
			$_SESSION['completado'] = 'El registro se ha completado con exito';
		}else{
			$_SESSION ['errores'] ['general'] = 'Fallo al guardar el usuario';
		}



	}else{
		$_SESSION['errores'] = $errores;
	}
	
	header('Location: index.php');
?>
