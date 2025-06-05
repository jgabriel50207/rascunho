<?php
header("Content-Type: application/json");
include_once("../db_conexao.php");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["nome"]) && isset($data["email"])) {
    $nome = $data["nome"];
    $email = $data["email"];

    $stmt = $pdo->prepare("INSERT INTO pessoas (nome, email) VALUES (?, ?)");
    $stmt->execute([$nome, $email]);

    echo json_encode(["message" => "Pessoa cadastrada com sucesso!"]);
} else {
    echo json_encode(["error" => "Dados incompletos."]);
}
?>
