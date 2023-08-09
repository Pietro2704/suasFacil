<?php
include_once "comandos_SQL.php"; // Chama o arquivo onde as funções com comandos sql foram estabelecidos

if (isset($_GET['id'])) { // Se o ID do usuário foi fornecido

    $id = $_GET['id']; // Variavel ID é o id passado pela URL
    $usuario = buscarUsuario($id); // Obter os dados do usuário pelo ID

    if (!$usuario) { // Se o usuário não existe

      die("usuario inexistente"); // Encerra a execução do script e exibe a mensagem de erro 
          
    }else{ // Senão
        
      session_start(); // Inicia a sessão
      session_destroy(); // Destroi a sessão
      echo "<script>window.location = 'login.php';</script>"; // Redireciona para o login

    }
}
?>