<?php
	// conecta.php
	// arquivo responsável por fazer a conexão com o banco de dados
	// todos as páginas que usam banco de dados podem incluir esse arquivo
	$conn = mysqli_connect("127.0.0.1", "root", "", "livros");

	if (!$conn){
		die("Houve um erro ao conectar com o banco de dados");
	}
?>