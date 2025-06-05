<?php
	// valida_login.php

	// entrando na pasta usuários, pois os arquivos não estão devidamente organizados. O certo era estar na pasta raiz
	require_once("../Trabalho CRUD/conecta.php");

	$usuario = $_POST["usuario"];
	$senha = $_POST["senha"];

	$sql = "SELECT * FROM login WHERE email = '$usuario' AND senha = '$senha' ";

	$resultado = mysqli_query($conn, $sql);

	session_start();

	if (mysqli_num_rows($resultado) > 0 ){
		$_SESSION["usuario"] = $usuario;
		header("location: Telas/menu.php");
	} else {
		$_SESSION["erro"] = "Usuário ou senha incorretos";
		header("location: Telas/tela_login.php");
	}
?>