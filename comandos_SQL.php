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
    $conn->close(); // Fecha a conexão com o banco de dados

    if ($usuario->num_rows > 0) { // Verifica se o usuário com o ID especificado foi encontrado
        return $usuario->fetch_assoc(); // Retorna os dados do usuário como um array associativo
    }

    return null; // Se nenhum usuário com o ID especificado for encontrado, retorna null
}


function atualizarUsuario($id, $usuario, $senha){
    $conn = conectarBanco();
    $sql = "update usuarios set usuario = ?, senha = ? where id = ?";
    $smt = $conn->prepare($sql);
    $smt->bind_param('ssi', $usuario, $senha, $id);

    if ($smt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso');</script>";
    } else {
        echo "<script>alert('ERRO AO ATUALIZAR');</script>" . mysqli_error($conn);
    }
}

function excluirUsuario($id){
    $conn = conectarBanco();
    $sql = "delete from usuarios where id = ?";
    $smt = $conn->prepare($sql);
    $smt->bind_param("i", $id);

    if ($smt->execute()) {
        echo "<script>alert('Usuario excluido');</script>";
    } else {
        echo "<script>alert('ERRO AO EXCLUIR');</script>";
    }
}
?>