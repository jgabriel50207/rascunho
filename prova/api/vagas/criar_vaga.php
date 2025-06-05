<?php
header("Content-Type: application/json");
include_once("../db_conexao.php");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["titulo"]) && isset($data["descricao"])) {
    $titulo = $data["titulo"];
    $descricao = $data["descricao"];

    $stmt = $pdo->prepare("INSERT INTO vagas (titulo, descricao) VALUES (?, ?)");
    $stmt->execute([$titulo, $descricao]);

    echo json_encode(["message" => "Vaga cadastrada com sucesso!"]);
} else {
    echo json_encode(["error" => "Dados incompletos."]);
}
?>
