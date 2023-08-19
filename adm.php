<?php
require_once "conexao.php"; 
require_once "comandos_SQL.php"; 
require_once "api.php"; 
$usuarios = getUsuarios();
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

  <div class="container">
    <p>Seja bem-vindo</p>
    <div class="relogio"  >
      <div id="hora" class= "mb-4"><?php echo obterHoraAtual(); ?></div>
    </div>
    <h2>Todos os Usuários:</h2>

    <table class="table table-bordered">
      <thead class="thead-dark">

        <tr>
          <th>Ação</th>
          <th>ID</th>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Senha</th>
        </tr>

      </thead>  

      <tbody>

        <?php
        foreach ($usuarios as $usuario):
        ?>

        <tr>
          <td>
            <a class="btn btn-secondary form-control" href="excluirUsuario.php?id=<?php echo $usuario['id'] ?>">
              <ion-icon name="trash-outline"></ion-icon> Excluir
            </a>
          </td>
          <td><?php echo $usuario['id'] ?></td>
          <td><?php echo $usuario['usuario'] ?></td>
          <td><?php echo $usuario['email'] ?></td>
          <td><?php echo $usuario['senha'] ?></td>
          
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    
    
    <form method="post">
      
      <a href="login.php" class="btn btn-primary">Voltar</a>

      <button type="submit" class="btn btn-danger" name="removeButton">Remover Todos</button>
      
    </form>
    
    
      

  </div>
</body>
</html>

<?php 
if(isset($_POST['removeButton'])){

  Truncate();
}
?>