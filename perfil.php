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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Todos usuarios</title>
</head>
<body>
  <div class="container mt-4">
    <h1>Seja bem-vindo</h1>
    <div class="relogio">
      <div id="hora" class= "mb-4"><?php echo obterHoraAtual(); ?></div>
    </div>

    <table class="table table-bordered mt-3">
      <thead class="thead-dark">

        <tr>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Senha</th>
          <th>Ações</th>
        </tr>

      </thead>  

      <tbody>
        <tr>
          <td><?php echo $usuarioLogado['usuario'] ?></td>
          <td><?php echo $usuarioLogado['email'] ?></td>
          <td><?php echo $usuarioLogado['senha'] ?></td>
          <td>
            <a class="btn btn-primary" href="editarUsuario.php?id=<?php echo $usuarioLogado['id'] ?>">Editar</a>
            <a class="btn btn-danger" href="sair.php?id=<?php echo $usuarioLogado['id'] ?>">LogOut</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>