<?php

function conectarBanco(){ // Função que conecta ao Banco

  $dbServer = "localhost"; // Servidor
  $dbUser = "root"; // Usuário
  $dbPassword = ""; // Senha
  $dbName = "suasfacil"; // Banco

  $conn = new mysqli($dbServer,$dbUser,$dbPassword,$dbName); // Classe 'Mysqli' recebe os 4 parametros de conexão

  if($conn->connect_error){ // Se der erro na conexao
    die("Conexão falhou" . $conn->connect_error); // Encerra a execução do script e exibe a mensagem de erro de conexão.
  }
  
  $conn->set_charset("utf8"); // Define o conjunto de caracteres (charset) da conexão para UTF-8.
  return $conn; // Retorna a conexão 
}

conectarBanco (); // Executa a função

?>