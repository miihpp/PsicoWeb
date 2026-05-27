<?php
session_start();

// Importa as configurações do arquivo conexao.php
require "conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // variaveis com o html
    $email = trim($_POST['email_cliente']);
    $senha = $_POST['senha_cliente'];

    // monta a consulta SQL buscando pelo e-mail 
    $sql = "SELECT id, nome_cliente, senha_cliente FROM usuarios WHERE email_cliente = ?";
    
    $stmt = $con->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        // verifica se encontrou exatamente 1 usuário
        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            
            // compara a senha digitada com o Hash seguro armazenado no banco
            if (password_verify($senha, $usuario['senha_cliente'])) {
                
                // grava as informações nas variáveis globais de Sessão
                $_SESSION['id_usuario']   = $usuario['id'];
                $_SESSION['nome_usuario'] = $usuario['nome_cliente'];
                
                $stmt->close();
                $con->close();
                
                // Redireciona o usuário para a página inicial com sucesso!
                header("Location: painel.php");
                exit();
                
            } else {
                echo "<script>alert('Erro: Senha incorreta.'); window.history.back();</script>";
                exit();
            }
        } else {
            echo "<script>alert('Erro: E-mail não encontrado ou não cadastrado.'); window.history.back();</script>";
            exit();
        }
    } else {
        die("Erro no banco de dados: " . $con->error);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
    <link rel="stylesheet" href="login.css">
    <link rel="icon" href="img/LogoTCC.png" type="image/png">
    <title>Login</title>
</head>
<body>
      <div class="hero login-hero">
  <nav>
   <a href="index.html">
    <img src="img/LogoTCC.png" class="logo">
</a>
  </nav>
     <div class="container">
        <form action="login.php" method="POST">
            <h1>Login</h1>
            
            <div class="input-box">
                <input placeholder="Email" type="email" name="email_cliente" required>
                <i class="bx bxs-user"> </i>
            </div>
            
             <div class="input-box">
                <input placeholder="Password" type="password" name="senha_cliente" required>
                <i class="bx bxs-lock-alt"> </i>
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox">
                    Lembrar Senha
                </label>
                <a href="#">Esqueci a senha</a>
            </div>
            <button type="submit" class="Login">Login</button>

            <div class="register-link">
                <p>Não tem uma conta? <a href="CADASTRO.html">Junte-se a nós</a></p>
            </div>

        </form>
    </div>
</body>
</html>
</html>
