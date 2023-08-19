<?php 
require_once "conexao.php"; // Chama o arquivo onde a função de conexao ao banco foi estabelecida
require_once "comandos_SQL.php"; // Chama o arquivo onde as funções com comandos sql foram estabelecidos
require_once "api.php"; // Chama o arquivo onde a função de obter hora atual foi estabelecida

session_start(); // Inicia a sessão

if (!isset($_SESSION['user_id'])) { // Caso o usuário não esteja autenticado
    
    header('Location: login.php'); // Redireciona para o login
    exit(); // Encerra a execução do script

}

$user_id = $_SESSION['user_id']; // Obtém o ID do usuário logado a partir da sessão
$usuarioLogado = buscarUsuario($user_id); // Busca as informações do usuário logado usando a função buscarUsuario 

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
    <title>Redefinir Senha</title>
</head>
<body>
  <div class= "container">
    <div class= "row justify-content-center">

      <div class= "col-md-6">
        <h1 class= "mt-5 mb-2">Alteração de senha:</h1>
        <div class="relogio"  >
          <div id="hora" class= "mb-4"><?php echo obterHoraAtual(); ?></div>
        </div>
        <form action="redefinirSenha.php" method=POST>

        <div class="form-group">
            <label for="password">Nova Senha</label>
            <input type= "password" class="form-control" name="newpassword" id= "password" minlength="8" required> 
          </div>

          <div class="form-group">
            <label for="confirm_password">Confirmar Senha</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
          </div>

          <button type="submit" name="submit" class="btn btn-primary mb-2 form-control">Confirmar</button>
          
        </form>
      </div>
    </div>
  </div>
</body>
</html>

<?php




if(isset($_POST["submit"])){ // Quando 'submit' for clicado

  $usuario_id = $usuarioLogado['id'];

  $newpassword = $_POST ["newpassword"]; // Obtém o valor do campo 'newpassword' do formulário
  $confirm_password = $_POST["confirm_password"]; // Obtém o valor do campo 'confirm_password' do formulário
  
  if ($newpassword !== $confirm_password) { // Se senha e confirmação de senha não coincidem

    echo "<script>alert('A senha e a confirmação de senha não coincidem. Por favor, tente novamente.');</script>"; // exibe mensagem de erro
    exit(); // Encerra a execução do script

  }

  redefinirSenha($newpassword,$usuario_id); // Atualiza senha

}
?>