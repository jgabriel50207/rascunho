<?php
// model/Pessoa.php

require_once __DIR__ . '/../config/database.php';

class Pessoa {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO pessoas (id, nome, profissao, localizacao, nivel) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['id'],
            $data['nome'],
            $data['profissao'],
            strtoupper($data['localizacao']),
            $data['nivel']
        ]);
    }

    public function exists($id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM pessoas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }
}
?>
s