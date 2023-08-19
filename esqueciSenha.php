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



if(isset($_POST["submit"])){

  $username = $_POST ["username"];
  $email = $_POST["email"];

  esqueciSenha($username,$email);

}
?>