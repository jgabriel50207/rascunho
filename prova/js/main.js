// Cadastrar pessoa
function cadastrarPessoa() {
    const nome = document.getElementById("nome").value;
    const email = document.getElementById("email").value;

    fetch("api/pessoas/index.php", {
        method: "POST",
        body: JSON.stringify({ nome, email }),
        headers: { "Content-Type": "application/json" }
    })
    .then(res => res.json())
    .then(data => alert(data.message || data.error));
}

// Cadastrar vaga
function cadastrarVaga() {
    const titulo = document.getElementById("titulo").value;
    const descricao = document.getElementById("descricao").value;

    fetch("api/vagas/criar_vaga.php", {
        method: "POST",
        body: JSON.stringify({ titulo, descricao }),
        headers: { "Content-Type": "application/json" }
    })
    .then(res => res.json())
    .then(data => alert(data.message || data.error));
}

// Registrar candidatura
function registrarCandidatura() {
    const id_pessoa = document.getElementById("id_pessoa").value;
    const id_vaga = document.getElementById("id_vaga").value;

    fetch("api/candidaturas/index.php", {
        method: "POST",
        body: JSON.stringify({ id_pessoa, id_vaga }),
        headers: { "Content-Type": "application/json" }
    })
    .then(res => res.json())
    .then(data => alert(data.message || data.error));
}
