<?php
include("conexao.php");


if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $aluno_id = $_POST['aluno_id'];
    $valor = $_POST['valor'];
    $data_vencimento = $_POST['data_vencimento'];
    $data_pagamento = $_POST['data_pagamento'];
    $status = $_POST['status'];

    $sql = "UPDATE mensalidade SET 
                aluno_id = '$aluno_id', 
                valor = '$valor', 
                data_vencimento = '$data_vencimento', 
                data_pagamento = $data_pagamento, 
                status = '$status' 
            WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}


if (isset($_POST['salvar'])) {
    $aluno_id = $_POST['aluno_id'];
    $valor = $_POST['valor'];
    $data_vencimento = $_POST['data_vencimento'];
    $data_pagamento = ($_POST['data_pagamento']);
    $status = $_POST['status'];

    $sql = "INSERT INTO mensalidade (aluno_id, valor, data_vencimento, data_pagamento, status) 
            VALUES ('$aluno_id', '$valor', '$data_vencimento', $data_pagamento, '$status')";

    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}



$id = '';
$aluno_id = '';
$valor = '';
$data_de_vencimento = '';
$data_de_pagamento = '';
$status = '';


if (isset($_GET["editar"])) {
    $id = $_GET["editar"];

    $sql = "SELECT * FROM mensalidade WHERE id = $id";
    $resultadoeditar = $conn->query($sql);

    if ($resultadoeditar && $resultadoeditar->num_rows > 0) {
        $linha = $resultadoeditar->fetch_assoc();
        $aluno_id = $linha['aluno_id'];
        $valor = $linha['valor'];
        $data_de_vencimento = $linha['data_vencimento'];
        $data_de_pagamento = $linha['data_pagamento'];
        $status = $linha['status'];
    }
}
if (isset($_GET["excluir"])) {
    $id = (int)$_GET["excluir"];

    if ($id > 0) {

        $sql = "DELETE FROM mensalidade WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Erro ao excluir " . $conn->error;
        }
    }
}


$sql = "SELECT * FROM mensalidade";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensalidades</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Controle de Mensalidades</h2>

        <a href="dashboard.php" class="btn btn-secondary">
            ← Voltar ao Dashboard
        </a>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>
                <?= ($id != '') ? 'Editar Mensalidade' : 'Cadastrar Mensalidade'; ?>
            </h4>
        </div>

        <div class="card-body">

            <form method="POST">

                <input type="hidden" name="id" value="<?= $id; ?>">

                <div class="mb-3">
                    <label class="form-label">ID do Aluno</label>
                    <input
                        type="number"
                        class="form-control"
                        name="aluno_id"
                        value="<?= $aluno_id; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Valor</label>
                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        name="valor"
                        value="<?= $valor; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Data de Vencimento</label>
                    <input
                        type="date"
                        class="form-control"
                        name="data_vencimento"
                        value="<?= $data_vencimento; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Data de Pagamento</label>
                    <input
                        type="date"
                        class="form-control"
                        name="data_pagamento"
                        value="<?= $data_pagamento; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>

                    <select class="form-select" name="status" required>
                        <option value="">Selecione</option>

                        <option value="Pendente"
                            <?= ($status == "Pendente") ? "selected" : ""; ?>>
                            Pendente
                        </option>

                        <option value="Pago"
                            <?= ($status == "Pago") ? "selected" : ""; ?>>
                            Pago
                        </option>

                        <option value="Atrasado"
                            <?= ($status == "Atrasado") ? "selected" : ""; ?>>
                            Atrasado
                        </option>
                    </select>
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

    <div class="card shadow mt-5">

        <div class="card-header bg-dark text-white">
            <h4>Mensalidades Cadastradas</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle text-center">

                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Aluno</th>
                        <th>Valor</th>
                        <th>Vencimento</th>
                        <th>Pagamento</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($linha = $resultado->fetch_assoc()) { ?>

                    <tr>

                        <td><?= $linha['id']; ?></td>

                        <td><?= $linha['aluno_id']; ?></td>

                        <td>R$ <?= number_format($linha['valor'], 2, ',', '.'); ?></td>

                        <td><?= $linha['data_vencimento']; ?></td>

                        <td><?= $linha['data_pagamento']; ?></td>

                        <td>
                            <span class="badge 
                                <?= ($linha['status'] == 'Pago') ? 'bg-success' : (($linha['status'] == 'Pendente') ? 'bg-warning text-dark' : 'bg-danger'); ?>">
                                <?= $linha['status']; ?>
                            </span>
                        </td>

                        <td>

                            <a href="?editar=<?= $linha['id']; ?>" class="btn btn-primary btn-sm">
                                Editar
                            </a>

                            <a href="?excluir=<?= $linha['id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Deseja realmente excluir esta mensalidade?')">
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