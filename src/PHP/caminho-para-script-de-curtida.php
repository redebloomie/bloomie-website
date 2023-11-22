<?php
session_start();
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST['id_usuario'];
    $idPost = $_POST['id_post'];

    // Verifique se o usuário já curtiu esta postagem
    $verificarCurtida = $conexao->query("SELECT * FROM curtidas WHERE ID_usuario = $idUsuario AND ID_post = $idPost");

    if ($verificarCurtida->num_rows == 0) {
        // O usuário ainda não curtiu esta postagem, então adicione a curtida
        $conexao->query("INSERT INTO curtidas (ID_usuario, ID_post) VALUES ($idUsuario, $idPost)");

        // Obtenha o número atualizado de curtidas
        $numeroCurtidas = obterNumeroCurtidas($idPost);

        echo json_encode(['success' => true, 'numeroCurtidas' => $numeroCurtidas]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Você já curtiu esta postagem.']);
    }
}

$conexao->close();

function obterNumeroCurtidas($idPost) {
    // Consulta para obter o número de curtidas para uma postagem específica
    global $conexao;
    $result = $conexao->query("SELECT COUNT(*) as total FROM curtidas WHERE ID_post = $idPost");
    $row = $result->fetch_assoc();
    return $row['total'];
}
?>
