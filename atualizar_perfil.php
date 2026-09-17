<?php
session_start();
header('Content-Type: application/json');
require "conexao.php";

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'error' => 'Não autenticado']);
    exit();
}

$usuario_id = $_SESSION['id_usuario'];
$input = json_decode(file_get_contents('php://input'), true);

// Valida dados obrigatórios
if (empty($input['nome']) || empty($input['email'])) {
    echo json_encode(['success' => false, 'error' => 'Nome e email são obrigatórios']);
    exit();
}

// Trata campos opcionais para evitar erros de tipo no banco de dados
$nome = $input['nome'];
$email = $input['email'];
$data_nascimento = !empty($input['data_nascimento']) ? $input['data_nascimento'] : null;
$telefone = isset($input['telefone']) ? $input['telefone'] : '';
$genero = isset($input['genero']) ? $input['genero'] : '';
$profissao = isset($input['profissao']) ? $input['profissao'] : '';
$endereco = isset($input['endereco']) ? $input['endereco'] : '';
$psicologo = isset($input['psicologo']) ? $input['psicologo'] : '';
$proxima_sessao = !empty($input['proxima_sessao']) ? $input['proxima_sessao'] : null;
$objetivos = isset($input['objetivos']) ? $input['objetivos'] : '';

// Atualiza os campos de uma vez
$sql = "UPDATE usuarios SET 
            nome_cliente = ?,
            email_cliente = ?,
            datanascimento_cliente = ?,
            telefone = ?,
            genero = ?,
            profissao = ?,
            endereco = ?,
            psicologo = ?,
            proxima_sessao = ?,
            objetivos = ?
        WHERE id = ?";

$stmt = $con->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Erro na preparação: ' . $con->error]);
    exit();
}

// Vincula as variáveis tratadas
$stmt->bind_param("ssssssssssi",
    $nome,
    $email,
    $data_nascimento,
    $telefone,
    $genero,
    $profissao,
    $endereco,
    $psicologo,
    $proxima_sessao,
    $objetivos,
    $usuario_id
);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Perfil atualizado com sucesso!']);
} else {
    echo json_encode(['success' => false, 'error' => 'Erro ao atualizar: ' . $stmt->error]);
}

$stmt->close();
$con->close();
?>