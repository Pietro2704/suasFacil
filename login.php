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
    <title>Login</title>
</head>
<body>
  <div class= "container">
    <div class= "row justify-content-center">

      <div class= "col-md-6">
        <h1 class= "mt-5 mb-2"><a href="adm.php" class="text-reset text-decoration-none">login</a></h1>
        <div class="relogio">
          <div id="hora" class= "mb-4"><?php echo obterHoraAtual(); ?></div>
        </div>
        <form action="login.php" method=POST>

          <div class="form-group">
            <label for="username">Email</label>
            <input type= "text" class="form-control" name="email" id="email" required> 
          </div>

          <div class="form-group">
            <label for="password">senha</label>
            <input type= "password" class="form-control" name="password" id="password" required> 
          </div>

          <button type="submit" name="submit" class="btn btn-primary mb-4 form-control">Entrar</button>
          
        </form>
        <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="d-flex justify-content-around">
                    <a href="index.php">Não possui conta?</a>
                    <a href="esqueciSenha.php">Esqueci minha senha</a>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<?php

if(isset($_POST["submit"])){

  $email = $_POST["email"];
  $password = $_POST["password"];

  autenticarUsuario($email,$password);

}

?>