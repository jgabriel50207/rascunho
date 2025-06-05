<?php
// model/Candidatura.php

require_once __DIR__ . '/../config/database.php';

class Candidatura {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO candidaturas (id, id_pessoa, id_vaga) VALUES (?, ?, ?)");
        $stmt->execute([
            $data['id'],
            $data['id_pessoa'],
            $data['id_vaga']
        ]);
    }

    public function exists($id_pessoa, $id_vaga) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM candidaturas WHERE id_pessoa = ? AND id_vaga = ?");
        $stmt->execute([$id_pessoa, $id_vaga]);
        return $stmt->fetchColumn() > 0;
    }

    public function getCandidatosByVaga($id_vaga) {
        $stmt = $this->db->prepare("
            SELECT p.id, p.nome, p.profissao, p.localizacao, p.nivel
            FROM candidaturas c
            INNER JOIN pessoas p ON c.id_pessoa = p.id
            WHERE c.id_vaga = ?
        ");
        $stmt->execute([$id_vaga]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
