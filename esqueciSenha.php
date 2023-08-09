<?php 
require_once "conexao.php"; // Chama o arquivo onde a função de conexao ao banco foi estabelecida
require_once "api.php"; // Chama o arquivo onde a função de obter hora atual foi estabelecida
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Esqueci Senha</title>
</head>
<body>
  <div class= "container">
    <div class= "row justify-content-center">

      <div class= "col-md-6">
        <h1 class= "mt-5 mb-2">Redefinição de senha:</h1>
        <div class="relogio"  >
          <div id="hora" class= "mb-4"><?php echo obterHoraAtual(); ?></div>
        </div>
        <form action="esqueciSenha.php" method=POST>

          <div class= "form-group">
            <label for="username">Usuario</label>
            <input type= "text" class="form-control" name="username" id='username' required> 
          </div>

          <div class= "form-group">
            <label for="email">E-mail</label>
            <input type= "email" class="form-control" name="email" id='email' required> 
          </div>

          <button type="submit" name="submit" class="btn btn-primary mb-2 form-control">Logar</button>
          
        </form>
      </div>
    </div>
  </div>
</body>
</html>

<?php

function esqueciSenha($username,$email){

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


if(isset($_POST["submit"])){ // Quando 'submit' for clicado

  $username = $_POST ["username"]; // Obtém o valor do campo 'newusername' do formulário
  $email = $_POST["email"]; // Obtém o valor do campo 'email' do formulário

  esqueciSenha($username,$email);

}
?>