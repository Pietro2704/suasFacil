<?php 
require_once "conexao.php";
require_once "comandos_SQL.php";
require_once "api.php";
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
    <title>Cadastro</title>
</head>
<body>
  <div class= "container">
    <div class= "row justify-content-center">

      <div class= "col-md-6">
        <h1 class= "mt-5 mb-2">Cadastrar</h1>
        <div class="relogio"  >
          <div id="hora" class= "mb-4"><?php echo obterHoraAtual(); ?></div>
        </div>
        <form action= "index.php" method=POST>

          <div class= "form-group">
            <label for="username">Nome</label>
            <input type= "text" class="form-control" name="newusername" id='username'required> 
          </div>

          <div class= "form-group">
            <label for="email">E-mail</label>
            <input type= "email" class="form-control" name="email" id='email' required> 
          </div>

          <div class="form-group">
            <label for="password">senha</label>
            <input type= "password" class="form-control" name="newpassword" id= "password" minlength="8" required> 
          </div>

          <div class="form-group">
            <label for="confirm_password">Confirmar Senha</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
          </div>

          <button type="submit" name="submit" class="btn btn-primary mb-2 form-control">Cadastrar</button>
          
        </form>
        <a href="login.php">Já possui conta?</a>
      </div>
    </div>
  </div>
</body>
</html>

<?php

if(isset($_POST["submit"])){

  $newusername = $_POST ["newusername"];
  $email = $_POST["email"];

  $newpassword = $_POST ["newpassword"];
  $confirm_password = $_POST["confirm_password"];
  
  if ($newpassword !== $confirm_password) {

    echo "<script>alert('A senha e a confirmação de senha não coincidem. Por favor, tente novamente.');</script>";
    exit();

  }
  
  criarUsuario($newusername, $newpassword, $email);

}

?>