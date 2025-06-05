<?php
header('Content-Type: application/json');

require_once '../utils/validators.php';
require_once '../model/Vaga.php';
require_once '../model/Pessoa.php';
require_once '../model/Candidatura.php';

try {
    $vagaModel = new Vaga();
    $pessoaModel = new Pessoa();
    $candidaturaModel = new Candidatura();
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao conectar ao banco de dados']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    exit;
}

$requiredFields = ['id', 'id_vaga', 'id_pessoa'];
foreach ($requiredFields as $field) {
    if (!isset($data[$field]) || empty($data[$field])) {
        http_response_code(422);
        exit;
    }
}

if (
    !isValidUUID($data['id']) ||
    !isValidUUID($data['id_vaga']) ||
    !isValidUUID($data['id_pessoa'])
) {
    http_response_code(422);
    exit;
}

// Verificar se a vaga e a pessoa existem
if (!$vagaModel->exists($data['id_vaga']) || !$pessoaModel->exists($data['id_pessoa'])) {
    http_response_code(404);
    exit;
}

// Verificar se já existe a candidatura
if ($candidaturaModel->exists($data['id_pessoa'], $data['id_vaga'])) {
    http_response_code(422);
    exit;
}

try {
    $candidaturaModel->create($data);
    http_response_code(201);
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        http_response_code(422);
    } else {
        http_response_code(500);
    }
}
?>
