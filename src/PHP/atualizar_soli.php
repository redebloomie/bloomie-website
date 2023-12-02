<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se os parâmetros necessários foram enviados
    if (isset($_POST['usuario_id_1']) && isset($_POST['acao'])) {
        $ID_usuario = $_POST['usuario_id_1'];
        $usuario_id_2 = $_POST['usuario_id_2'];
        $acao = $_POST['acao'];

        // Atualize o status com base na ação
        switch ($acao) {
            case 'aceito':
                $novoStatus = 'aceito';
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
                break;
            case 'cancelar':
                // Atualize o status no banco de dados
                $updateQuery = "DELETE FROM bloomizade WHERE (usuario_id_1 = $ID_usuario AND usuario_id_2 = $usuario_id_2) OR (usuario_id_1 = $usuario_id_2 AND usuario_id_2 = $ID_usuario)";
                $result = mysqli_query($conexao, $updateQuery);

                if ($result) {
                    // Atualização bem-sucedida
                    echo 'Status atualizado com sucesso.';
                } else {
                    // Erro na atualização
                    echo 'Erro ao atualizar o status.';
                }

                break;
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
