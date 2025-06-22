<?php
session_start();
unset($_SESSION["usuario"]);
header("Location: Telas/tela_login.php"); // Redireciona para a tela de login
exit();
?>