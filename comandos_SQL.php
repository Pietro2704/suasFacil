<?php
require_once "conexao.php";

function criarUsuario($newusername,$newpassword,$email){

    $conn = conectarBanco();
    $sql = "select * from usuarios where email = '$email'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0){

        echo "<script>alert('usuario ja cadastrado');</script>";

    }else{

        $sql = "insert into usuarios(usuario,senha,email) values('$newusername','$newpassword','$email' )";
        $resultado = $conn->query($sql);

        if($resultado){

        echo "<script>alert('Usuario criado com sucesso')</script>";
        echo "<script>window.location = 'login.php';</script>";

        }else{

        die("erro".mysql_connect_error());

        } 
    }
}

function autenticarUsuario($email,$password){

    $conn = conectarBanco();
    $sql = "select * from usuarios where email = '$email' and senha = '$password' ";
    $resultado = $conn->query($sql);
    
    if ($resultado->num_rows > 0) {
  
      $usuario = $resultado->fetch_assoc();

      session_start();
      $_SESSION['user_id'] = $usuario['id'];
      
      header('Location: perfil.php');
  
    }else{
  
      echo "<script>alert('Usuario ou senha incorretos');</script>";
  
    }
}

function buscarUsuario($id) {

    $conn = conectarBanco();
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $usuario = $conn->query($sql);
    
    if ($usuario->num_rows > 0) {
        return $usuario->fetch_assoc();
    }
    
    $conn->close();
    return null;
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

function getUsuarios(){

    $conn = conectarBanco();
    $sql = "select * from usuarios";
    $usuarios = $conn->query($sql);

    $conn->close();

    return $usuarios;
}

function esqueciSenha($username,$email){

    $conn = conectarBanco();
    $sql = "select * from usuarios where usuario = '$username' and email = '$email' ";
    $resultado = $conn->query($sql);
  
    if ($resultado->num_rows > 0) {
      
      $usuario = $resultado->fetch_assoc();
      session_start();
      $_SESSION['user_id'] = $usuario['id'];
      header('Location: redefinirSenha.php');
  
    }else{
      echo "<script>alert('Dados não encontrados');</script>";
    }
  
}
  
function redefinirSenha($newpassword,$usuario_id){

    $conn = conectarBanco();
    $sql = "update usuarios set senha = '$newpassword' where id = '$usuario_id'";
    $resultado = $conn->query($sql);
    
    if ($resultado) {
  
      session_destroy();
      echo "<script>alert('Dados atualizados com sucesso!!');</script>";
      echo "<script>window.location = 'login.php';</script>";
  
    }else{
  
      echo "<script>alert('Usuario ou senha incorretos');</script>";
  
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