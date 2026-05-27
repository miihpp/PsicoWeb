<?php 
require "conexao.php"; 

// Verifica se a conexão foi estabelecida
if (!isset($con) || $con->connect_error) {
    die("Erro de conexão com o banco de dados");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //variaveis com o html
    $nome = trim($_POST['nome_cliente']);
    $email = trim($_POST['email_cliente']);
    $senha = $_POST['senha_cliente'];
    $confirma_senha = $_POST['confirma_senha_cliente'];
    
    // Tratamento para evitar erro se o usuário não preencher a data
    $data_nascimento = !empty($_POST['datanascimento_cliente']) ? $_POST['datanascimento_cliente'] : '2000-01-01';

    // Validações
    $erros = [];
    
    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "E-mail válido é obrigatório";
    }
    
    if ($senha !== $confirma_senha) {
        $erros[] = "A senha e a confirmação de senha não coincidem.";
    }
    
    if (strlen($senha) !== 8) {
        $erros[] = "A senha precisa ter exatamente 8 caracteres.";
    }
    
    // Se houver erros, exibe e para
    if (!empty($erros)) {
        echo "<div style='color: red; text-align: center; margin-top: 20px;'>";
        echo "<h3>Erros no cadastro:</h3>";
        echo "<ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul>";
        echo "<a href='javascript:history.back()'>Voltar e corrigir</a>";
        echo "</div>";
        exit();
    }
    //coloca o hash p criptografar a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    //declara a variavel sql{a table usuarios} enquanto insere as informações no banco
    $sql = "INSERT INTO usuarios (nome_cliente, senha_cliente, email_cliente, datanascimento_cliente) 
            VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssss", $nome, $senha_hash, $email, $data_nascimento);
        
        if ($stmt->execute()) {
            $stmt->close();
            $con->close();
            //redireciona p loging
            header("Location: login.php"); 
            exit();
        } else {
            if ($con->errno == 1062) {
                echo "<script>alert('Erro: Este e-mail já está cadastrado.'); window.location.href='javascript:history.back()';</script>";
            } else {
                echo "Erro no banco de dados: " . $stmt->error;
            }
        }
    } else {
        echo "Erro ao preparar o banco de dados: " . $con->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
    <link rel="stylesheet" href="cadastro.css">
    <link class="logo" rel="icon" href="img/LogoTCC.png" type="image/png">
    <title>Cadastro</title>
</head>
<body>
  <div class="hero login-hero">
  <nav>
   <a href="index.html">
    <img src="img/LogoTCC.png" class="logo">
   </a>
  </nav>
     <div class="container">
        <form action="cadastro.php" method="POST">
            <h1>Crie sua conta</h1>
            
            <div class="input-box">
                <input placeholder="Nome" type="text" name="nome_cliente" required>
                <i class="bx bxs-user"> </i>
            </div>
            
             <div class="input-box">
                <input placeholder="E-mail" type="email" name="email_cliente" required>
                <i class="bx bx-envelope"></i>
            </div>
            
            <div class="input-box"> 
                <input placeholder="Senha" type="password" name="senha_cliente" minlength="8" maxlength="8" required>
                <i class="bx bx-lock"></i>
            </div>

            <div class="input-box"> 
                <input placeholder="Confirmar Senha" type="password" name="confirma_senha_cliente" minlength="8" maxlength="8" required>
                <i class="bx bx-lock"></i>
            </div>
            
             <div class="input-box">
                <input placeholder="Date de nascimento" type="date" name="datanascimento_cliente">
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox">
                    Remember password
                </label>
            </div>
            <button type="submit" class="Login">Criar conta</button>

        </form>
    </div>
</div> 
</body>
</html>