<?php 
require_once "conexao.php";
require_once "comandos_SQL.php";
require_once "api.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    
    header('Location: login.php');
    exit();

}

$user_id = $_SESSION['user_id'];
$usuarioLogado = buscarUsuario($user_id);

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




if(isset($_POST["submit"])){

  $usuario_id = $usuarioLogado['id'];

  $newpassword = $_POST ["newpassword"];
  $confirm_password = $_POST["confirm_password"];
  
  if ($newpassword !== $confirm_password) {

    echo "<script>alert('A senha e a confirmação de senha não coincidem. Por favor, tente novamente.');</script>";
    exit();

  }

  redefinirSenha($newpassword,$usuario_id);

}
?>