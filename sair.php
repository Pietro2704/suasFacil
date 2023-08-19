<?php
require_once "comandos_SQL.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $usuario = buscarUsuario($id);

    if (!$usuario) {

      die("usuario inexistente");
          
    }else{
        
      session_start();
      session_destroy();
      echo "<script>window.location = 'login.php';</script>";

    }
}
?>