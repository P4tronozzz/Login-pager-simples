<?php 
include("conexao.php");

$aluno = "";
$telefone = "";
$cpf = "";

if (isset($_POST['enviar'])) {

    $aluno = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];

    $sql = "INSERT INTO alunos (nome, telefone, cpf)
            VALUES ('$aluno', '$telefone', '$cpf');";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success text-center'>Aluno cadastrado</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Erro no cadastramento: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <!-- Botão de Voltar para o Início -->
    <div class="mb-4">
        <a href="index.php" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Voltar para o Início
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0 fw-bold">
                <i class="bi bi-person-plus me-2"></i>Cadastro de Aluno
            </h4>
        </div>

        <div class="card-body p-4">
            <form method="POST" action="">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nome do Aluno</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="nome" class="form-control" placeholder="Digite o nome completo" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Telefone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="telefone" class="form-control" placeholder="(00) 00000-0000" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">CPF</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                        <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00" required>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" name="enviar" class="btn btn-success px-4">
                        <i class="bi bi-check-circle me-1"></i> Cadastrar
                    </button>

                    <button type="reset" class="btn btn-secondary px-3">
                        <i class="bi bi-eraser me-1"></i> Limpar
                    </button>

                    <a href="alunos.php" class="btn btn-primary px-3">
                        <i class="bi bi-people me-1"></i> Ver Alunos
                    </a>

                    <a href="mensalidade.php" class="btn btn-warning px-3">
                        <i class="bi bi-card-checklist me-1"></i> Mensalidades
                    </a>

                               
            <a href="fixa.php" class="btn btn-info text-white px-3">
                <i class="bi bi-journal-text me-1"></i> Fichas
            </a>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>