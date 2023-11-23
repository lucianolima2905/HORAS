<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $numeroRifa = $_POST["numeroRifa"];

    // Aqui você pode adicionar lógica adicional, como salvar os dados em um banco de dados

    // Mensagem de sucesso
    echo "<html>";
    echo "<head>";
    echo "<title>Pedido Enviado</title>";
    echo "<link rel='stylesheet' href='css/style.css'>";
    echo "</head>";
    echo "<body>";
    echo "<div class='success-message'>";
    echo "<img src='https://media1.giphy.com/media/zuS6G8ZKILnrxEYIXF/giphy.gif?cid=6c09b952040pmzb2tifdutk61rs7dz51gtqqp5tryh5oa3tu&ep=v1_stickers_related&rid=giphy.gif&ct=s' alt='Ícone de Verificação'>";
    echo "<p>Pedido enviado com sucesso! Aguarde...</p>";
    echo "</div>";
    echo "<script>";
    echo "setTimeout(function() { window.location.href = 'https://wa.me/5574999445516?text=Olá,%20meu%20nome%20é%20" . urlencode($nome) . "%20e%20eu%20gostaria%20de%20comprar%20a%20rifa%20número%20" . urlencode($numeroRifa) . "'; }, 10000);";
    echo "</script>";
    echo "</body>";
    echo "</html>";

    exit;
}
?>
