<?php
session_start();
include("conexao.php");

$erro = "";

if (isset($_POST['id']) && isset($_POST['nome'])) {

    $id = $_POST['id'];
    $nome =$_POST['nome'];

    $sql = "SELECT * FROM alunos WHERE id='$id' AND nome='$nome'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "tem alguma coisa mais erada que tua vida kkkkkk";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100 position-relative">

    <!-- Botão Administração no canto superior direito -->
    <div class="position-absolute top-0 end-0 p-3">
        <a href="log.php" class="btn btn-outline-dark fw-semibold shadow-sm">
            <i class="bi bi-shield-lock me-1"></i> Administração
        </a>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4 p-sm-5">
                        
                        <div class="text-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                                <i class="bi bi-person-lock fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-1">Área do Aluno</h4>
                        </div>

                        <!-- Formulário vai direto para pagina_alunos.php -->
                        <form action="pagina_alunos.php" method="POST">
                            
                            <div class="mb-3">
                                <label for="id" class="form-label fw-semibold">ID</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-hash"></i></span>
                                    <input type="number" class="form-control" id="id" name="id" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="nome" class="form-label fw-semibold">Nome</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="nome" name="nome" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-3 shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>