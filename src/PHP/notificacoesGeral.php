<?php
session_start();
include('connect.php'); 

    if (isset($_POST['submit'])) 

    
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtém os valores dos checkboxes
    $notificacao_gerais = isset($_POST["notificacao_gerais"]) ? 1 : 0;
    $notificacao_curtidas_comentarios = isset($_POST["notificacao_curtidas_comentarios"]) ? 1 : 0;
    $notificacao_plataforma = isset($_POST["notificacao_plataforma"]) ? 1 : 0;
    
    // Mensagem de sucesso (ou falha)
    $message = "Configurações de notificação salvas com sucesso";
} else {
    $message = "Método de solicitação inválido";
}

$conn->close();

// Retorne a mensagem em formato JSON
echo json_encode(['message' => $message]);
?>
