<?php
include('connect.php');

// Obtenha as datas de início e término da solicitação
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

// Consulta SQL para obter a quantidade de usuários entre as datas fornecidas
$sql = "SELECT COUNT(*) as total_users FROM post WHERE data_publicacao BETWEEN '$start_date' AND '$end_date'";
$result = $conexao->query($sql);

// Verifique se a consulta foi bem-sucedida
if ($result) {
    // Obtenha os resultados da consulta
    $row = $result->fetch_assoc();

    // Retorne os resultados como JSON
    echo json_encode([$row['total_users']]);
} else {
    // Em caso de erro na consulta, retorne um array vazio
    echo json_encode([]);
}

// Feche a conexão com o banco de dados
$conexao->close();
?>
