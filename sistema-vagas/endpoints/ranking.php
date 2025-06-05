<?php
header('Content-Type: application/json');

require_once '../utils/validators.php';
require_once '../model/Vaga.php';
require_once '../model/Candidatura.php';

try {
    $vagaModel = new Vaga();
    $candidaturaModel = new Candidatura();
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao conectar ao banco de dados']);
    exit;
}

// Matriz de distâncias
$distancias = [
    'A' => ['A' => 0,  'B' => 4,  'C' => 8,  'D' => 12, 'E' => 16, 'F' => 20],
    'B' => ['A' => 4,  'B' => 0,  'C' => 5,  'D' => 9,  'E' => 13, 'F' => 17],
    'C' => ['A' => 8,  'B' => 5,  'C' => 0,  'D' => 6,  'E' => 10, 'F' => 14],
    'D' => ['A' => 12, 'B' => 9,  'C' => 6,  'D' => 0,  'E' => 5,  'F' => 9],
    'E' => ['A' => 16, 'B' => 13, 'C' => 10, 'D' => 5,  'E' => 0,  'F' => 4],
    'F' => ['A' => 20, 'B' => 17, 'C' => 14, 'D' => 9,  'E' => 4,  'F' => 0],
];

function calcularScore($nivelVaga, $nivelPessoa, $localVaga, $localPessoa, $distancias) {
    $n = 100 - 25 * abs($nivelVaga - $nivelPessoa);
    $distancia = $distancias[$localVaga][$localPessoa];

    if ($distancia <= 5) {
        $d = 100;
    } elseif ($distancia <= 10) {
        $d = 75;
    } elseif ($distancia <= 15) {
        $d = 50;
    } elseif ($distancia <= 20) {
        $d = 25;
    } else {
        $d = 0;
    }

    $score = floor($n + $d);
    return $score;
}

// Validar ID da vaga
if (!isset($_GET['id']) || !isValidUUID($_GET['id'])) {
    http_response_code(400);
    exit;
}

$idVaga = $_GET['id'];

// Verificar se a vaga existe
$vaga = $vagaModel->get($idVaga);

if (!$vaga) {
    http_response_code(404);
    exit;
}

// Buscar candidatos
$candidatos = $candidaturaModel->getCandidatosByVaga($idVaga);

$resultado = [];

foreach ($candidatos as $candidato) {
    $score = calcularScore(
        $vaga['nivel'],
        $candidato['nivel'],
        $vaga['localizacao'],
        $candidato['localizacao'],
        $distancias
    );

    $resultado[] = [
        'id' => $candidato['id'],
        'nome' => $candidato['nome'],
        'profissao' => $candidato['profissao'],
        'score' => $score
    ];
}

// Ordenar decrescente
usort($resultado, function ($a, $b) {
    return $b['score'] <=> $a['score'];
});

// Retornar resultado
http_response_code(200);
echo json_encode($resultado);
?>
