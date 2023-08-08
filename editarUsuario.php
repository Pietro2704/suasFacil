<?php
include_once "comandos_SQL.php";

if (isset($_GET['id'])) { // Se o ID do usuário foi fornecido

    $id = $_GET['id'];
    $usuario = buscarUsuario($id); // Obter os dados do usuário pelo ID

    if (!$usuario) { // Verificar se o usuário existe

        echo "Usuário não encontrado.";
        exit();

    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Se o formulário foi enviado
        
        $usuario = $_POST["usuario"]; // Obter os dados do formulário
        $senha = $_POST["password"]; //$email = $_POST["email"];
        
        atualizarUsuario($id, $usuario, $senha); // Atualizar os dados do usuário no banco de dados
        echo "<script>window.location = 'perfil.php';</script>"; // Redirecionar para a página de listagem de usuários
        exit();
    }

}else{

    echo "ID do usuário não fornecido.";
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

            <button type="submit" class="btn btn-primary">Salvar</button>

        </form>
    </div>
    
</body>
</html>