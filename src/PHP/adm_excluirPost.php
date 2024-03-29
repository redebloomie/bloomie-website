<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se os parâmetros necessários foram enviados
    // Verifique se os parâmetros necessários foram enviados
    if (isset($_POST['ID_post'], $_POST['motivo'])) {
        $ID_post = $_POST['ID_post'];
        $motivo = $_POST['motivo'];

        // Mover para a tabela 'posts_excluidos'
        $selectQuery = "SELECT * FROM post WHERE ID_post = $ID_post";
        $selectResult = mysqli_query($conexao, $selectQuery);
        $post = mysqli_fetch_assoc($selectResult);

        // Inclua o motivo na inserção
        $insertQuery = "INSERT INTO posts_excluidos (ID_usuario, texto, data_exclusao, imagem, motivo) VALUES ('{$post['ID_usuario']}', '{$post['texto']}', NOW(), '{$post['imagem']}', '$motivo')";
        $insertResult = mysqli_query($conexao, $insertQuery);

        if (!$insertResult) {
            $response = 'Erro ao mover para a tabela posts_excluidos: ' . mysqli_error($conexao);
        } else {
            // Excluir da tabela 'post'
            $deleteQuery = "DELETE FROM post WHERE ID_post = $ID_post";
            $deleteResult = mysqli_query($conexao, $deleteQuery);

            if (!$deleteResult) {
                $response = 'Erro ao excluir da tabela post: ' . mysqli_error($conexao);
            } else {
                $response = 'Operação concluída com sucesso.';
            }
        }
    } else {
        // Parâmetros ausentes
        $response = 'Parâmetros ausentes.';
    }
} else {
    // Requisição inválida
    $response = 'Requisição inválida.';
}

// Enviar resposta ao JavaScript
echo json_encode(['response' => $response]);
?>