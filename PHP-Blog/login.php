<?php 

//Iniciar sesion y la conexion an DB

require_once 'includes/conexion.php';

//Recoger los datos del formularios

if (isset($_POST)) {
	$email = trim($_POST['email']);	
	$password = $_POST['password'];

}
//Consulta a la BD si coinciden email y password

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$login = mysqli_query($db, $sql);

if ($login && mysqli_num_rows($login) == 1) {
	$usuario = mysqli_fetch_assoc($login);
	
	//Comprobar la contraseña, 
	$verify = password_verify($password, $usuario['password']);	
	
	//Utilizar una sesion para guardar los datos del usuario logueado
	if ($verify) {
		$_SESSION['usuario'] = $usuario;
		
		if(isset($_SESSION['error_login'])){
			unset($_SESSION['error_login']);
		}

	}else{
		//Si algo falla enviar una sesion con el fallo
		$_SESSION['error_login'] = "Login incorrecto!!";
	}
	
}else{
		$_SESSION['error_login'] = "Login incorrecto!!";

}


//Redirigir al index.php 

header('Location: index.php');

 ?>