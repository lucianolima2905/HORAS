<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Enviar Comprovante</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <h1>Enviar Comprovante</h1>
    <!-- Adicione aqui o conteúdo do banner ou qualquer outro elemento do cabeçalho -->
</header>

<div class="container">
    <section class="formulario-section">
        <h2>Enviar Comprovante</h2>
        <form action="processar_comprovante.php" method="post" enctype="multipart/form-data">
            <label for="comprovante">Selecione o comprovante:</label>
            <input type="file" id="comprovante" name="comprovante" accept=".pdf, .jpg, .jpeg, .png" required>

            <label for="mensagem">Mensagem para o WhatsApp:</label>
            <textarea id="mensagem" name="mensagem" rows="4" required></textarea>

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
