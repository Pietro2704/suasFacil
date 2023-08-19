<?php
require_once "conexao.php"; // Chama o arquivo onde a função de conexao ao banco foi estabelecida

function criarUsuario($newusername,$newpassword,$email){ // Função para o Cadastro precisa receber um usuario, senha e um email

    $conn = conectarBanco(); // Conecta ao banco
    $sql = "select * from usuarios where email = '$email'"; // Comando de consulta para verificar se usuário ja existe
    $resultado = $conn->query($sql); // Executa o comando de consulta

    if ($resultado->num_rows > 0){ // Se o Banco retornar alguma linha

        echo "<script>alert('usuario ja cadastrado');</script>"; // Alerta que usuario ja existe

    }else{ // Senão

        $sql = "insert into usuarios(usuario,senha,email) values('$newusername','$newpassword','$email' )"; // Comando de inserção
        $resultado = $conn->query($sql); // Executa o comando de inserção

        if($resultado){ // Se a inserção foi bem-sucedida

        echo "<script>alert('Usuario criado com sucesso')</script>"; // Alerta que usuario foi criado
        echo "<script>window.location = 'login.php';</script>"; // Redireciona para a página dos usuarios

        }else{ // Senão

        die("erro".mysql_connect_error()); // Encerra a execução do script e exibe a mensagem de erro

        } 
    }
}

function autenticarUsuario($email,$password){ // Função para o Login precisa receber um usuario e uma senha

    $conn = conectarBanco(); // Conecta ao banco
    $sql = "select * from usuarios where email = '$email' and senha = '$password' "; // Comando de consulta
    $resultado = $conn->query($sql); // Executa o comando de consulta
    
    if ($resultado->num_rows > 0) { // Se o Banco retornar alguma linha
  
      $usuario = $resultado->fetch_assoc(); // Obtém os dados do usuário

      session_start(); // Inicia uma sessão
      $_SESSION['user_id'] = $usuario['id']; // Define o ID do usuário na sessão
      
      header('Location: perfil.php'); // Redireciona para a página dos usuarios
  
    }else{ // Senão
  
      echo "<script>alert('Usuario ou senha incorretos');</script>"; // Alerta que não encontrou o usuario
  
    }
}

function buscarUsuario($id) { // Função para buscar um usuário específico pelo ID

    $conn = conectarBanco(); // Conecta ao banco
    $sql = "SELECT * FROM usuarios WHERE id = '$id'"; // Comando de consulta
    $usuario = $conn->query($sql); // Executa o comando de consulta
    
    if ($usuario->num_rows > 0) { // Se o usuário com o ID especificado foi encontrado
        return $usuario->fetch_assoc(); // Retorna os dados do usuário como um array associativo
    }
    
    $conn->close(); // Fecha a conexão com o banco de dados
    return null; // Se nenhum usuário com o ID especificado for encontrado, retorna null
}

function atualizarUsuario($id, $usuario, $senha){ // Função para atualizar um usuário específico

    $conn = conectarBanco(); // Conecta ao banco
    $sql = "update usuarios set usuario = ?, senha = ? where id = ?"; // Comando de atualização

    $smt = $conn->prepare($sql); // Prepara o comando para a execução
    $smt->bind_param('ssi', $usuario, $senha, $id); // Associa valores aos parâmetros na consulta SQL preparada

    if ($smt->execute()) {  // Se a atualização for bem-sucedida

        echo "<script>alert('Dados atualizados com sucesso');</script>"; // exibe um alerta de sucesso

    } else { // Senão

        echo "<script>alert('ERRO AO ATUALIZAR');</script>" . mysqli_error($conn); // exibe um alerta de erro

    }
}

function getUsuarios(){ // Função para pegar todos os valores da tabela

    $conn = conectarBanco(); // Conecta ao banco
    $sql = "select * from usuarios"; // Comando de consulta
    $usuarios = $conn->query($sql); // Executa o comando de consulta

    $conn->close(); // Fecha a conexão com o banco de dados

    return $usuarios; // Retorna o resultado da consulta
}

function esqueciSenha($username,$email){ // Função de esqueci senha precisa receber um usuario e um email

    $conn = conectarBanco(); // Conecta ao banco
    $sql = "select * from usuarios where usuario = '$username' and email = '$email' "; // Comando de consulta
    $resultado = $conn->query($sql); // Executa o comando de consulta
  
    if ($resultado->num_rows > 0) { // Se o Banco retornar alguma linha
      
      $usuario = $resultado->fetch_assoc(); // Obtém os dados do usuário
      session_start(); // Inicia uma sessão
      $_SESSION['user_id'] = $usuario['id']; // Define o ID do usuário na sessão
      header('Location: redefinirSenha.php'); // Redireciona para a página de redefinição de senha
  
    }else{
      echo "<script>alert('Dados não encontrados');</script>";
    }
  
}
  
function redefinirSenha($newpassword,$usuario_id){ // Função para redefinir senha precisa de uma senha e um id de usuario

    $conn = conectarBanco(); // Conecta ao banco
    $sql = "update usuarios set senha = '$newpassword' where id = '$usuario_id'"; // Comando de atualização
    $resultado = $conn->query($sql); // Executa o comando 
    
    if ($resultado) { // Se o Banco retornar alguma linha
  
      session_destroy();
      echo "<script>alert('Dados atualizados com sucesso!!');</script>"; // exibe um alerta de sucesso
      echo "<script>window.location = 'login.php';</script>"; // Redireciona para o login
  
    }else{ // Senão
  
      echo "<script>alert('Usuario ou senha incorretos');</script>"; // Alerta que não encontrou o usuario
  
    }
  
}

function excluirUsuario($id){ // Função para excluir um usuário específico

    $conn = conectarBanco(); // Conecta ao banco
    $sql = "delete from usuarios where id = ?"; // Comando para deletar

    $smt = $conn->prepare($sql); // Prepara o comando para a execução
    $smt->bind_param("i", $id); // Associa valores aos parâmetros na consulta SQL preparada

    if ($smt->execute()) { // Se a atualização for bem-sucedida

        echo "<script>alert('Usuario excluido');</script>"; // exibe um alerta de sucesso

    } else {

        echo "<script>alert('ERRO AO EXCLUIR');</script>"; // exibe um alerta de erro
        
    }
}

function Truncate(){
    
    $conn = conectarBanco(); 
    $sql = "TRUNCATE TABLE usuarios;"; 
    $resultado = $conn->query($sql);  

    if ($resultado) {
        echo "<script>alert('Usuários APAGADOS!!');</script>";
        echo "<script>window.location = 'adm.php';</script>"; 
    } else {
        echo "<script>alert('Ocorreu um erro ao apagar os usuários.');</script>";
    }
}



?>