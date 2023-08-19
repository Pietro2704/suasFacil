<?php
require_once "comandos_SQL.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $usuario = buscarUsuario($id);

    if (!$usuario) {

      die("usuario inexistente");
        
    }else{

      excluirUsuario($id);
      echo "<script>window.location = 'adm.php';</script>"; 

    }
}
?>