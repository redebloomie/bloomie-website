<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se os parâmetros necessários foram enviados
    if (isset($_POST['ID_oportunidade']) && isset($_POST['acao'])) {
        $ID_oportunidade = $_POST['ID_oportunidade'];
        $acao = $_POST['acao'];

        // Atualize o status com base na ação
        switch ($acao) {
            case 'aceita':
                $novoStatus = 'aceita';
                break;
            case 'negada':
                $novoStatus = 'negada';
                break;
            default:
                // Ação desconhecida, trate conforme necessário
                break;
        }

        // Atualize o status no banco de dados
        $updateQuery = "UPDATE oportunidade SET status_opor = '$novoStatus' WHERE ID_oportunidade = $ID_oportunidade";
        $result = mysqli_query($conexao, $updateQuery);

        if ($result) {
            // Atualização bem-sucedida
            echo 'Status atualizado com sucesso.';
        } else {
            // Erro na atualização
            echo 'Erro ao atualizar o status.';
        }
    } else {
        // Parâmetros ausentes
        echo 'Parâmetros ausentes.';
    }
} else {
    // Requisição inválida
    echo 'Requisição inválida.';
}

// Fechar a conexão
mysqli_close($conexao);
?>
