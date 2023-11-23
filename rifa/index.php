<?php
include('config.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Rifas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <h1>Rifas</h1>
    <!-- Adicione aqui o conteúdo do banner ou qualquer outro elemento do cabeçalho -->
</header>

<div class="container">
    <section class="rifa-section">
        <h2>Rifas Disponíveis</h2>
        <?php
        $sqlDisponiveis = "SELECT id, numero FROM Rifas WHERE disponivel = TRUE";
        $resultDisponiveis = $conn->query($sqlDisponiveis);

        if ($resultDisponiveis->num_rows > 0) {
            echo "<div class='rifas-disponiveis'>";
            while ($row = $resultDisponiveis->fetch_assoc()) {
                echo "<div class='rifa-item disponivel'>" . $row['numero'] . "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>Nenhuma rifa disponível</p>";
        }
        ?>
    </section>

    <section class="rifa-section">
        <h2>Rifas Vendidas</h2>
        <?php
        $sqlVendidas = "SELECT id, numero FROM Rifas WHERE disponivel = FALSE";
        $resultVendidas = $conn->query($sqlVendidas);

        if ($resultVendidas->num_rows > 0) {
            echo "<div class='rifas-vendidas'>";
            while ($row = $resultVendidas->fetch_assoc()) {
                echo "<div class='rifa-item vendida'>" . $row['numero'] . "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>Nenhuma rifa vendida</p>";
        }
        ?>
    </section>

    <section class="formulario-section">
        <h2>Formulário de Compra</h2>
        <form action="processar_compra.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="numeroRifa">Número da Rifa:</label>
            <select id="numeroRifa" name="numeroRifa" required>
                <?php
                $sqlNumerosRifa = "SELECT id, numero FROM Rifas WHERE disponivel = TRUE";
                $resultNumerosRifa = $conn->query($sqlNumerosRifa);

                while ($row = $resultNumerosRifa->fetch_assoc()) {
                    echo "<option value='" . $row['numero'] . "'>" . $row['numero'] . "</option>";
                }
                ?>
            </select>

            <button type="submit">Enviar para WhatsApp</button>
        </form>
    </section>
</div>

<footer class="footer">
    <!-- Adicione aqui o conteúdo do rodapé -->
    <p>&copy; 2023 Sua Empresa</p>
</footer>

<script src="js/script.js"></script>
</body>
</html>
