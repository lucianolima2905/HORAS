<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o formulário foi submetido
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $rifaSelecionada = $_POST['rifa'];

    // Lógica para cadastrar o cliente (substitua pelo seu código de inserção no banco de dados)
    $sqlInserirCliente = "INSERT INTO Clientes (nome, email) VALUES ('$nome', '$email')";
    if ($conn->query($sqlInserirCliente) === TRUE) {
        echo "Cliente cadastrado com sucesso.";

        // Atualiza a disponibilidade da rifa selecionada
        $sqlAtualizarRifa = "UPDATE Rifas SET disponivel = FALSE, cliente_id = (SELECT id FROM Clientes WHERE nome = '$nome') WHERE id = $rifaSelecionada";
        $conn->query($sqlAtualizarRifa);
    } else {
        echo "Erro ao cadastrar o cliente: " . $conn->error;
    }

    $conn->close();
    exit; // Evita que o restante do HTML seja executado
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2>Formulário de Cliente</h2>
    <form id="formCliente" method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="rifa">Selecione uma rifa:</label>
        <select id="rifa" name="rifa" required>
            <?php
            $sql = "SELECT id, numero FROM Rifas WHERE disponivel = TRUE";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>Rifa " . $row['numero'] . "</option>";
                }
            } else {
                echo "<option value='' disabled>Nenhuma rifa disponível</option>";
            }
            ?>
        </select>

        <button type="submit">Cadastrar Cliente</button>
    </form>
</div>

<script src="js/script.js"></script>
</body>
</html>
