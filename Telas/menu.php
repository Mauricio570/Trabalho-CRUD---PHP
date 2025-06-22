<?php  require_once("../verefica_login.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Livros Cadastrados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 1000px;
            margin: 0 auto;
        }
        .alert {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: rgb(15, 65, 226);
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        @media screen and (max-width: 600px) {
            th, td {
                padding: 8px;
                font-size: 14px;
            }
        }
        /* Botões de ação já existentes */
        .btn {
            display: inline-block;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-edit {
            background-color: rgb(58, 235, 4);
            color: #212529;
        }
        .btn-edit:hover {
            background-color: rgb(58, 235, 4);
            color: #fff;
        }
        .btn-delete {
            background-color: rgb(228, 1, 24);
            color: #fff;
        }
        .btn-delete:hover {
            background-color: rgb(228, 1, 24);
        }
        /* Novo estilo para o botão "Cadastrar Novo Livro" */
        .btn-new {
            background-color: rgb(15, 65, 226);  /* Verde */
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 20px;
        }
        .btn-new:hover {
            background-color: rgb(15, 65, 226);
        }

        .btn-exit {
        background-color: rgb(228, 1, 24); /* Vermelho */
        color: #fff;
        padding: 10px 20px;
        font-size: 16px;
        margin-top: 20px;
        }
        .btn-exit:hover {
            background-color: rgb(200, 0, 20);
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Mensagem de sucesso -->
        <?php
            if (isset($_SESSION["msg_sucesso"])) :
        ?>
            <div class="alert">
                <?php echo ($_SESSION["msg_sucesso"]); ?>
            </div>
        <?php 
            unset($_SESSION["msg_sucesso"]);
            endif;
        ?>

<h2>Livros Cadastrados</h2>
<?php
            require_once("../conecta.php");
            
            if (!$conn){
                die("Houve um erro ao conectar com o banco de dados");
            }
            
            $sql = "SELECT id, titulo, autor, genero, editora, ano, indicacao FROM livro ORDER BY titulo ASC";
            $resultado = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($resultado) > 0) {
                echo ('<div class="table-responsive">
                <table>
                <thead>
                <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Genero</th>
                <th>Editora</th>
                <th>Ano</th>
                <th>Indicação</th>
                <th>Opções</th>
                </tr>
                </thead>
                <tbody>');
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo ("<tr>");
                    echo ("<td>" . htmlspecialchars($row["titulo"]) . "</td>");
                    echo ("<td>" . htmlspecialchars($row["autor"]) . "</td>");
                    echo ("<td>" . htmlspecialchars($row["genero"]) . "</td>");
                    echo ("<td>" . htmlspecialchars($row["editora"]) . "</td>");
                    echo ("<td>" . htmlspecialchars($row["ano"]) . "</td>");
                    echo ("<td>" . htmlspecialchars($row["indicacao"]) . "</td>");
                    echo ("<td><a class='btn btn-edit' href='../editar_livro.php?id=" . urlencode($row['id']) . "'>Editar</a> ");
                    echo ("<a class='btn btn-delete' href='../excluir.php?id=" . urlencode($row['id']) . "'>Excluir</a></td>");
                    echo ("</tr>");
                }
                echo ("</tbody></table></div>"); 
            } else {
                echo ("<h1>Não há nada para ser exibido</h1>");
            }
            ?>

<!-- Link para cadastrar novo livro -->
<a href="tela_cadastro.php" class="btn btn-new">Cadastrar Novo Livro</a>
<a href="../deslogar.php" class="btn btn-exit">Sair</a>
</div>

<script>
        setTimeout(function() {
            const alertas = document.querySelectorAll('.alert');
            alertas.forEach(alerta => {
                alerta.style.opacity = '0';
                setTimeout(() => alerta.style.display = 'none', 500);
            });
        }, 5000);
    </script>
</body>
</html>
