<?php
// Inicie a sessão se ainda não estiver iniciada
session_start();
include('connect.php');

// Verifique se o usuário está logado (você pode ter seu próprio mecanismo de verificação de login)
if (isset($_SESSION['ID_usuario'])) {
    // Recupere o ID do usuário da sessão
    $idUsuario = $_SESSION['ID_usuario'];

    // Recupere o resultado da personalidade enviado pelo JavaScript
    $data = json_decode(file_get_contents("php://input"));

    // Execute a atualização na tabela de estudantes
    $sql = "UPDATE usuario SET personalidade = ? WHERE ID_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $data->personalidade, $idUsuario);

    if ($stmt->execute()) {
        echo "Resultado da personalidade atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o resultado da personalidade: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
} else {
    echo "Usuário não está logado."; // Ou implemente uma lógica de redirecionamento
}
?>
