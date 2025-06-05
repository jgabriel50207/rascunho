<?php
header("Content-Type: application/json");
include_once("../db_conexao.php");

$stmt = $pdo->query("SELECT * FROM vagas");
$vagas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($vagas);
?>
