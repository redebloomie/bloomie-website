<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = date('Y-m-d', strtotime($_GET['start_date']));
    $end_date = date('Y-m-d', strtotime($_GET['end_date']));
  
    $sql = "SELECT DATE(data_criacao) AS datac, COUNT(*) AS quantidade FROM usuario WHERE data_criacao BETWEEN '$start_date' AND '$end_date' GROUP BY DATE(data_criacao)";
    $result = $conexao->query($sql);
  
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $dateArray[] = $row['datac'];
            $userArray[] = $row['quantidade'];
        }
  
        unset($result);
    } else {
        echo 'Erro na consulta ao banco de dados: ' . $conexao->error . ' SQL: ' . $sql;
    }
  }
?>