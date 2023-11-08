<?php
include('connect.php');

// Verifique se um arquivo de imagem foi enviado
if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === 0) {
    $nomeArquivo = $_FILES["imagem"]["name"];
    $imagem = "../img/" . $nomeArquivo;

    // Move o arquivo para o destino
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem)) {

        // Agora você pode inserir as informações no banco de dados
        if (isset($_POST['submit'])) {
            $data_publicacao = date("Y-m-d"); // Altere isso para o formato de data desejado
            $texto = $_POST['texto'];

            // Use declarações preparadas para evitar injeções de SQL
            $stmt = $conexao->prepare("INSERT INTO post (imagem, texto, data_publicacao) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $imagem, $texto, $data_publicacao);

            if ($stmt->execute()) {
                echo "Post feito!";
            } else {
                echo "Erro ao inserir no banco de dados: " . $stmt->error;
            }
        }
    } else {
        echo "Erro ao mover o arquivo para o destino.";
    }
}
?>