<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lógica de processamento do comprovante e envio da mensagem para o WhatsApp

    // Recupere a mensagem e o número do WhatsApp (substitua com a lógica real)
    $mensagem = $_POST["mensagem"];
    $numeroWhatsApp = "5574999445516";

    // Diretório para uploads
    $uploadDir = "uploads/";

    // Garanta que o diretório de uploads exista
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Lógica para processar o upload do comprovante (substitua com a lógica real)
    $uploadFile = $uploadDir . basename($_FILES['comprovante']['name']);

    if (move_uploaded_file($_FILES['comprovante']['tmp_name'], $uploadFile)) {
        // Mensagem de sucesso
        echo "<html>";
        echo "<head>";
        echo "<title>Comprovante Enviado</title>";
        echo "<link rel='stylesheet' href='css/style.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='success-message'>";
        echo "<img src='https://media1.giphy.com/media/zuS6G8ZKILnrxEYIXF/giphy.gif?cid=6c09b952040pmzb2tifdutk61rs7dz51gtqqp5tryh5oa3tu&ep=v1_stickers_related&rid=giphy.gif&ct=s' alt='Ícone de Verificação'>";
        echo "<p>Comprovante enviado com sucesso! Aguarde...</p>";
        echo "</div>";
        echo "<script>";
        echo "setTimeout(function() { window.location.href = 'https://wa.me/$numeroWhatsApp?text=" . urlencode($mensagem) . "'; }, 10000);";
        echo "</script>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "Erro no upload do comprovante.";
    }
}
?>
