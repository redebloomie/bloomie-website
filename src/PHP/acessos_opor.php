<?php
session_start();
include('connect.php');

if (isset($_GET['id'])) {
    $idOportunidade = $_GET['id'];

    // Consulta para obter os dados da oportunidade
    $query = "SELECT * FROM oportunidade WHERE ID_oportunidade = $idOportunidade";
    $result = $conexao->query($query);

    // Verificar se a consulta foi bem-sucedida
    if ($result) {
        // Verificar se há pelo menos uma linha de resultado
        if ($result->num_rows > 0) {
            // Buscar os resultados como um array associativo
            $oportunidade = $result->fetch_assoc();

            // Registre o acesso na tabela acessos_oportunidade
            $conexao->query("INSERT INTO acessos_oportunidade (ID_oportunidade) VALUES ($idOportunidade)");

            // Restante do seu código para exibir os detalhes da oportunidade
            header("Location: " . $oportunidade['link']);
            exit(); // Certifique-se de sair após redirecionar para evitar execução adicional do script
        } else {
            echo 'Nenhuma oportunidade encontrada com o ID fornecido.';
        }
    } else {
        echo 'Erro na consulta: ' . $conexao->error;
    }
} else {
    echo 'ID de oportunidade não fornecido.';
}

mysqli_close($conexao);
?>
