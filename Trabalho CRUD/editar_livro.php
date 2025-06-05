<?php  require_once("../Trabalho CRUD/verefica_login.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
            $id_livro = isset($_GET["id"]) ? (int) $_GET["id"] : 0; // pegando o parametro de usuário que vem da url e faz a conversão para int

            require_once("../Trabalho CRUD/conecta.php");        

            // string da consulta responsável por recuperar o registro a ser editado
            // o ? será o parametro que será inserido na consulta
            $sql = "SELECT * FROM livro WHERE id = ?";

            // definindo e preparando a consulta parametrizada
            $stmt = $conn->prepare($sql);    

            // definindo os paramatros da consulta (cada ?) 
            // i - int
            // f - float
            // s - string
            $stmt->bind_param("i", $id_livro); 

            $stmt->execute();    // executando a consulta

            $resultado = $stmt->get_result();   // armazenando o resultado da consulta no result set

            //testando quantas linhas o result set retornou
            if ($resultado->num_rows == 1) {
                // encontrou o registro 
                $livro = $resultado->fetch_assoc();

                $titulo = $livro["titulo"];
                $autor = $livro["autor"];
                $genero = $livro["genero"];
                $editora = $livro["editora"];
                $ano = $livro["ano"];
                $indicacao = $livro["indicacao"];
            } else {
                // não encontrou nenhum registro
                header("location: Telas/menu.php");
            }
            
            $stmt->close(); // encerra a consulta
            $conn->close(); // fecha a conexão com o banco de dados
        ?>
        <h2>Editando livro</h2>
        <form action="cadastro_livro.php" method="POST">

        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value = "<?= $titulo ?>" required>
        </div>

        <div class="form-group">
            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" value = "<?= $autor ?>" required>
        </div>

        <div class="form-group">
            <label for="genero">Gênero:</label>
            <select id="genero" name="genero" required>
            <?php
                require("conecta.php");

                $sql = "SELECT * FROM generos";

                $resultado = mysqli_query($conn, $sql);

                // usando a sintaxe alternativa do php para não ficar concatenando strings...
                while ($row = mysqli_fetch_assoc($resultado) ):

            ?>

                <option value="<?= $row['genero']?>"><?= $row["genero"] ?></option>

            <?php
                endwhile;
            ?>
            </select>
        </div>

        <div class="form-group">
            <label for="editora">Editora:</label>
            <input type="text" id="editora" name="editora" value = "<?= $editora ?>" required>
        </div>

        <div class="form-group">
            <label for="ano_publicacao">Ano de Publicação:</label>
            <input type="number" id="ano" name="ano" value = "<?= $ano ?>" required>
        </div>


        <div class="form-group">
            <label>Indicação:</label>
            <div class="radio-group">
            <input type="radio" id="para_criancas" name="indicacao" value="criancas" required>
            <label for="para_criancas">Para crianças</label>

            <input type="radio" id="para_todas_idades" name="indicacao" value="todas_idades">
            <label for="para_todas_idades">Para todas as idades</label>

            <input type="radio" id="para_adultos" name="indicacao" value="adultos">
            <label for="para_adultos">Para adultos</label>
            </div>
        </div>
        <input type="hidden" name="id_livro" value="<?=  $id_livro ?>">

        <button type="submit" name="cadastrar">Enviar</button>
        </form>
    </div>
</body>
</html>