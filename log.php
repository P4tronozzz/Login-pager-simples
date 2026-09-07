<?php
session_start();
include("conexao.php");

if (isset($_POST['usuario']) && isset($_POST['senha'])) {

    $usuario= $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE usuario ='$usuario' AND senha = '$senha'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $_SESSION['usuario'] = $usuario;
        header("Location: dashboard.php");
        exit();
   
    }
    else {
   
    echo "<script>alert('tem alguma coisa errada com sua senha ou user');</script>";

       
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Painel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4 p-sm-5">
                        
                        <!-- Cabeçalho -->
                        <div class="text-center mb-4">
                            <div class="bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                                <i class="bi bi-shield-lock fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-1">Acesso ao Sistema</h4>
                        </div>

                        <!-- Alerta de Erro -->
                        <?php if (!empty($erro)): ?>
                            <div class="alert alert-danger alert-dismissible fade show text-center py-2 fs-6 mb-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> <?php echo $erro; ?>
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Formulário -->
                        <form action="" method="POST">
                            
                            <div class="mb-3">
                                <label for="usuario" class="form-label fw-semibold">Usuário</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="usuario" name="usuario" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="senha" class="form-label fw-semibold">Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-key"></i></span>
                                    <input type="password" class="form-control" id="senha" name="senha" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 py-2 fw-bold rounded-3 shadow-sm">
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