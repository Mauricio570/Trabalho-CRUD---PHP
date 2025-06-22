<?php
	// excluir.php

	$id = $_GET["id"];	// recuperando o paremtro da url

	require_once("../Trabalho CRUD/conecta.php");  

	$sql = "DELETE FROM livro WHERE id = $id";

	if (mysqli_query($conn, $sql) ){
		if (mysqli_affected_rows($conn) == 1){
			session_start();
			$_SESSION["msg_sucesso"] = "Livro excluído com sucesso";
		}
	} else {
		echo ("Houve um erro ao excluir o registro");
	}
	
	header("location: Telas/menu.php");

?>