<?php
require_once("../Trabalho CRUD/verefica_login.php");

if (!isset($_POST["cadastrar"]) ){
		header("location: cadastro_livro.html");	// redirecionada para a página de cadastro
	} 

$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$genero = $_POST["genero"];
$editora = $_POST["editora"];
$ano = $_POST["ano"];
$indicacao = $_POST["indicacao"];
$erros = [];


if (empty($titulo) ){
    $erros[] = "Preencha o <b>titulo</b>";	// adicionando a mensagem de erro ao array
}
if (empty($autor) ){
    $erros[] = "Preencha o <b>autor</b>";	// adicionando a mensagem de erro ao array
}
if (empty($genero) ){
    $erros[] = "Preencha o <b>genero</b>";	// adicionando a mensagem de erro ao array
}
if (empty($editora) ){
    $erros[] = "Preencha o <b>editora</b>";	// adicionando a mensagem de erro ao array
}
if (empty($ano) ){
    $erros[] = "Preencha o <b>ano</b>";	// adicionando a mensagem de erro ao array
}
if (empty($indicacao) ){
    $erros[] = "Preencha o <b>indicacao</b>";	// adicionando a mensagem de erro ao array
}
if($indicacao == "adultos")
    $indicacao = "Para Adultos";

if($indicacao == "todas_idades")
    $indicacao = "Para todas as idades";

if($indicacao == "criancas")
    $indicacao = "Para as crianças";
if (count($erros) == 0){

    require_once("../Trabalho CRUD/conecta.php");

    if ($conn){
        $id_livro = $_POST["id_livro"];

        if (isset($id_livro) && !empty($id_livro))
            // consulta sql que atualiza o registro
            echo $sql = "UPDATE livro SET titulo = '$titulo', autor = '$autor', genero = '$genero', editora = '$editora', ano = '$ano', indicacao = '$indicacao' WHERE id = $id_livro";

        else
            // consulta sql que insere o registro
            $sql = "INSERT INTO livro (titulo, autor, genero, editora, ano, indicacao) VALUES ('$titulo', '$autor', '$genero', '$editora', '$ano', '$indicacao') ";


        if (mysqli_query($conn, $sql) ) {
            // para mostrar a mensagem de sucesso, será necessário uma variavel de sessão
            session_start();	// iniciando a sessão
                
            if (isset($id_livro) && !empty($id_livro))
                $_SESSION["msg_sucesso"] = "Livro atualizado com sucesso"; // armazena a mensagem de sucesso na variavel de sessão
            else
                $_SESSION["msg_sucesso"] = "Livro inserido com sucesso"; // armazena a mensagem de sucesso na variavel de sessão

            header("location: Telas/menu.php");	// faz um redirecionamento para outra página
                
            mysqli_close($conn);	// fecha a conexão com o banco de dados
            
        }else 
            echo ("Houve um erro ao tentar inserir <br> " . mysqli_error($conn) );
    }else
        die("Houve um erro ao conectar com o banco de dados");

        echo ("titulo: <b>$titulo</b><br>");
        echo ("autor: <b>$autor</b><br>");
        echo ("genero: <b>$genero</b><br>");
        echo ("editora: <b>$editora</b><br>");
        echo ("ano: <b>$ano</b><br>");
        echo ("indicacao: <b>$indicacao</b><br>");
    } else {
        // percorrendo o array para mostrar os erros de preenchimento noi formulário
        for ($i=0; $i < count($erros); $i++){
            echo ($erros[$i] . "<br>");	// exibindo cada erro armazenado no array
        }
    }

?>