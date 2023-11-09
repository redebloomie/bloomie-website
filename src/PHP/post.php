<?php
session_start();
include ('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['usuario']; // Você pode obter isso de uma sessão de login
    $texto = $_POST['texto'];
    $idUsuario = $_SESSION['ID_usuario'];

    // Salvar a imagem no servidor (adapte conforme necessário)
    $caminhoImagem = '../img/' . $_FILES['uploadImagem']['name'];
    move_uploaded_file($_FILES['uploadImagem']['tmp_name'], $caminhoImagem);

    $sql = "INSERT INTO post (ID_usuario, usuario, texto, imagem, data_publicacao) 
            VALUES ('$idUsuario', '$usuario', '$texto', '$caminhoImagem', '$data')";

    if ($conexao->query($sql) === TRUE) {
        echo "Postagem realizada com sucesso!";
    } else {
        echo "Erro ao postar: " . $conexao->error;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Processar curtida, comentário, compartilhamento, relatório, etc.
    // ...
    // Retorne os resultados em formato JSON para o feed dinâmico
    $pagina = $_GET['pagina'];
    $postsPorPagina = 5;
    $indiceInicio = ($pagina - 1) * $postsPorPagina;

    $result = $conexao->query("SELECT * FROM post ORDER BY data_publicacao DESC LIMIT $indiceInicio, $postsPorPagina");
    $posts = array();

    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }

    echo json_encode($posts);
}

$conexao->close();
?>