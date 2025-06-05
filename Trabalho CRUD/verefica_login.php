<?php
session_start();
if(!isset($_SESSION["usuario"])){
   header("Location: tela_login.php");
}

?>