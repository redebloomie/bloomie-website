<?php
session_start();
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['postId'];
    $userId = $_SESSION['ID_usuario'];

    // Verifique se o usuário já curtiu o post
    $result = $conexao->query("SELECT * FROM curtidas WHERE ID_usuario = $userId AND ID_post = $postId");
    
    if ($result->num_rows > 0) {
        // O usuário já curtiu, então descurtir
        $conexao->query("DELETE FROM curtidas WHERE ID_usuario = $userId AND ID_post = $postId");
    } else {
        // O usuário não curtiu ainda, então curtir
        $conexao->query("INSERT INTO curtidas (ID_usuario, ID_post) VALUES ($userId, $postId)");
    }

    // Obtenha o número atual de curtidas para o post
    $result = $conexao->query("SELECT COUNT(*) as curtidas FROM curtidas WHERE ID_post = $postId");
    $row = $result->fetch_assoc();
    $curtidas = $row['curtidas'];

    // Retorne a nova contagem de curtidas como JSON
    echo json_encode(['curtidas' => $curtidas]);
} else {
    // Em caso de erro, retorne um JSON indicando o erro
    echo json_encode(['error' => 'Método de requisição inválido.']);
}

$conexao->close();
?>
