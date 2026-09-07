<?php
include("conexao.php");

if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $exercicio = $_POST['nome_exercicio'];
    $series = $_POST['series'];
    $repeticoes = $_POST['repeticoes'];

    $sql = "UPDATE ficha SET nome_exercicio='$exercicio', series='$series', repeticoes='$repeticoes' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}


if (isset($_POST['salvar'])) {
    $exercicio = $_POST['nome_exercicio'];
    $series = $_POST['series'];
    $repeticoes = $_POST['repeticoes'];

    $sql = "INSERT INTO ficha (nome_exercicio, series, repeticoes) VALUES ('$exercicio', '$series', '$repeticoes')";

    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit();
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}


$id = '';
$exercicio = '';
$series = '';
$repeticoes = '';


if (isset($_GET["editar"])) {
    $id = $_GET["editar"];

    $sql = "SELECT * FROM ficha WHERE id = $id";
    $resultadoeditar = $conn->query($sql);
    
    if ($resultadoeditar && $resultadoeditar->num_rows > 0) {
        $linha = $resultadoeditar->fetch_assoc();
        $id = $linha['id'];
        $exercicio = $linha['nome_exercicio']; 
        $series = $linha['series'];
        $repeticoes = $linha['repeticoes'];
    }
}
if (isset($_GET["excluir"])) {
    $id = (int)$_GET["excluir"];

    if ($id > 0) {

        $sql = "DELETE FROM ficha WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Erro ao excluir " . $conn->error;
        }
    }
}

$sql = "SELECT * FROM ficha";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Exercícios</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Cadastro de Exercícios</h3>
    <a href="dashboard.php" class="btn btn-outline-primary">
        ← Voltar ao Dashboard
    </a>
</div>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center">
                <?= ($id != '') ? 'Editar Exercício' : 'Cadastro de Exercícios'; ?>
            </h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <input type="hidden" name="id" value="<?= $id; ?>">

                <div class="mb-3">
                    <label class="form-label">Nome do Exercício</label>
                    <input
                        type="text"
                        name="nome_exercicio"
                        class="form-control"
                        value="<?= $exercicio; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Séries</label>
                    <input
                        type="number"
                        name="series"
                        class="form-control"
                        value="<?= $series; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Repetições</label>
                    <input
                        type="number"
                        name="repeticoes"
                        class="form-control"
                        value="<?= $repeticoes; ?>"
                        required>
                </div>

                <?php if ($id != '') { ?>

                    <button type="submit" name="atualizar" class="btn btn-warning">
                        Atualizar
                    </button>

                    <a href="<?= $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">
                        Cancelar
                    </a>

                <?php } else { ?>

                    <button type="submit" name="salvar" class="btn btn-success">
                        Salvar
                    </button>

                <?php } ?>

            </form>

        </div>
    </div>

    <div class="card mt-5 shadow">
        <div class="card-header bg-dark text-white">
            <h4>Lista de Exercícios</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover text-center align-middle">

                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Exercício</th>
                        <th>Séries</th>
                        <th>Repetições</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($linha = $resultado->fetch_assoc()) { ?>

                    <tr>

                        <td><?= $linha['id']; ?></td>

                        <td><?= $linha['nome_exercicio']; ?></td>

                        <td><?= $linha['series']; ?></td>

                        <td><?= $linha['repeticoes']; ?></td>

                        <td>

                            <a href="?editar=<?= $linha['id']; ?>"
                               class="btn btn-primary btn-sm">
                                Editar
                            </a>

                            <a href="?excluir=<?= $linha['id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Deseja realmente excluir este exercício?')">
                                Excluir
                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>