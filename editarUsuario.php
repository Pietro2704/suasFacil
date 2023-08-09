<?php
include_once "comandos_SQL.php"; // Chama o arquivo onde as funções com comandos sql foram estabelecidos

if (isset($_GET['id'])) { // Se o ID do usuário foi fornecido

    $id = $_GET['id']; // Variavel ID é o id passado pela URL
    $usuario = buscarUsuario($id); // Obter os dados do usuário pelo ID

    if (!$usuario) { // Se o usuário não existe

        echo "<script>alert('Usuário não encontrado.');</script>"; // exibe um alerta de erro
        exit(); // Encerra a execução do script

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Se o formulário foi enviado
        
        $usuario = $_POST["usuario"]; // Obtém o valor do campo 'usuario' do formulário
        $senha = $_POST["password"]; // Obtém o valor do campo 'password' do formulário
        
        atualizarUsuario($id, $usuario, $senha); // Atualizar os dados do usuário no banco de dados
        echo "<script>window.location = 'perfil.php';</script>"; // Redirecionar para a página de listagem de usuários
        exit(); // Encerra a execução do script
    }

}else{

    echo "<script>alert('ID do usuário não fornecido.');</script>"; // exibe um alerta de erro
    exit(); // Encerra a execução do script

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