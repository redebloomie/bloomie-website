<?php
session_start();

// Conectar ao banco de dados (você já deve ter isso em seu código)
include('connect.php');

// Obter dados do POST
$postId = $_POST['postId'];
$ID_usuario = $_SESSION['ID_usuario'];
$commentText = $_POST['commentText'];

// Validar e sanitizar os dados (IMPORTANTE: Adapte isso às suas necessidades)
$postId = intval($postId);
$commentText = mysqli_real_escape_string($conexao, $commentText);

// Inserir o comentário no banco de dados
$insertCommentQuery = "INSERT INTO comentarios (ID_post, ID_usuario, comentario, data_comentario) VALUES ($postId, $ID_usuario, '$commentText', NOW())";
$insertCommentResult = mysqli_query($conexao, $insertCommentQuery);

if ($insertCommentResult) {
    // Se a inserção for bem-sucedida, envie uma resposta JSON de sucesso ao cliente
    echo json_encode(['success' => true]);
} else {
    // Se houver um erro, envie uma resposta JSON de falha ao cliente
    echo json_encode(['success' => false]);
}

// Fechar a conexão com o banco de dados (opcional, dependendo do seu fluxo de trabalho)
mysqli_close($conexao);
?>
