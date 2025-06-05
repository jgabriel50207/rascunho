<?php
header("Content-Type: application/json");
include_once("../db_conexao.php");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["id_pessoa"]) && isset($data["id_vaga"])) {
    $id_pessoa = $data["id_pessoa"];
    $id_vaga = $data["id_vaga"];

    $stmt = $pdo->prepare("INSERT INTO candidaturas (id_pessoa, id_vaga) VALUES (?, ?)");
    $stmt->execute([$id_pessoa, $id_vaga]);

    echo json_encode(["message" => "Candidatura registrada com sucesso!"]);
} else {
    echo json_encode(["error" => "Dados incompletos."]);
}
?>
