<?php  require_once("../verefica_login.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Cadastro de Livro</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <div class="form-container">
    <h1>Cadastro de Livro</h1>
    <form action="../cadastro_livro.php" method="POST">

      <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
      </div>

      <div class="form-group">
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required>
      </div>

      <div class="form-group">
        <label for="genero">Gênero:</label>
        <select id="genero" name="genero" required>
          <?php
              require("../conecta.php");

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
        <input type="text" id="editora" name="editora" required>
      </div>

      <div class="form-group">
        <label for="ano_publicacao">Ano de Publicação:</label>
        <input type="number" id="ano" name="ano" required>
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

      <button type="submit" name="cadastrar">Enviar</button>
    </form>
  </div>
</body>

</html>