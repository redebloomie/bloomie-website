<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se os parâmetros necessários foram enviados
    if (isset($_POST['usuario_id_1']) && isset($_POST['acao'])) {
        $ID_usuario = $_POST['usuario_id_1'];
        $acao = $_POST['acao'];

        // Atualize o status com base na ação
        switch ($acao) {
            case 'aceito':
                $novoStatus = 'aceito';
                break;
            case 'negada':
                $novoStatus = 'negada';

                // Mover para a tabela 'oportunidades_inativas'
                $selectQuery = "SELECT * FROM bloomizade WHERE usuario_id_1 = $ID_usuario AND status_soli = 'pendente'";
                $selectResult = mysqli_query($conexao, $selectQuery);
                $oportunidade = mysqli_fetch_assoc($selectResult);

                $insertQuery = "UPDATE bloomizade SET status_soli = '$novoStatus' WHERE usuario_id_1 = $ID_usuario AND status_soli = 'pendente'";
                $insertResult = mysqli_query($conexao, $insertQuery);

                if (!$insertResult) {
                    echo 'Erro ao mover para a tabela oportunidades_inativas.';
                    exit;
                }

                break;
        }

        // Atualize o status no banco de dados
        $updateQuery = "UPDATE bloomizade SET status_soli = '$novoStatus' WHERE usuario_id_1 = $ID_usuario AND status_soli = 'pendente'";
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
