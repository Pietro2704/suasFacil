<?php
require_once "conexao.php"; // Chama o arquivo onde a função de conexao ao banco foi estabelecida


function getUsuarios(){ // Função para pegar todos os valores da tabela

    $conn = conectarBanco(); // Conecta ao banco
    $sql = "select * from usuarios"; // Comando de consulta
    $usuarios = $conn->query($sql); // Executa o comando de consulta

    $conn->close(); // Fecha a conexão com o banco de dados

    return $usuarios; // Retorna o resultado da consulta
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
?>