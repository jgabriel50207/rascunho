# Sistema de Vagas

## Descrição
Sistema simples para cadastro de pessoas, vagas e candidaturas com cálculo de distância e score.

## Como Rodar
1. Crie o banco de dados usando `database_setup.sql`.
2. Configure `db_conexao.php` com seus dados do MySQL.
3. Rode em um servidor local (XAMPP, WAMP, etc.).
4. Acesse `index.html` no navegador.

## APIs
- `POST /api/pessoas/index.php` – Cadastra pessoa
- `POST /api/vagas/criar_vaga.php` – Cadastra vaga
- `POST /api/candidaturas/index.php` – Registra candidatura
- `GET /api/vagas/index.php?id={id_vaga}` – Lista ranking da vaga
