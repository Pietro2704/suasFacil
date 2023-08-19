<?php
require_once "comandos_SQL.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $usuario = buscarUsuario($id);

    if (!$usuario) {

        echo "<script>alert('Usuário não encontrado.');</script>";
        exit();

    }

}else{

    echo "<script>alert('ID do usuário não fornecido.');</script>";
    exit();

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-4">
        <h2>Editar Usuário</h2>
        <form method="POST">

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="usuario" 
                    id="nome" 
                    value="<?php echo $usuario['usuario']; ?>">
            </div>
            
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input 
                    minlength="8" 
                    type="text" 
                    class="form-control" 
                    name="password" 
                    id="password" 
                    value="<?php echo $usuario['senha']; ?>">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Salvar</button>

        </form>
    </div>
    
</body>
</html>
<?php 
if (isset($_POST['submit'])) {
        
    $usuario = $_POST["usuario"];
    $senha = $_POST["password"];
    
    atualizarUsuario($id, $usuario, $senha);
    
    echo "<script>window.location = 'perfil.php';</script>";
    exit();
}
?>