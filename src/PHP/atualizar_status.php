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
            case 'revalidar':
                $novoStatus = 'pendente';
                break;
            case 'desativar':
                $novoStatus = 'inativa';

                // Mover para a tabela 'oportunidades_inativas'
                $selectQuery = "SELECT * FROM oportunidade WHERE ID_oportunidade = $ID_oportunidade";
                $selectResult = mysqli_query($conexao, $selectQuery);
                $oportunidade = mysqli_fetch_assoc($selectResult);

                $insertQuery = "INSERT INTO oportunidades_inativas (ID_usuario, titulo, estado, cidade, inicio, tempo_expirar, link, tipo_personalidade, descricao, categoria, escolaridade, status_opor, data_publicacao, imagem) VALUES ('{$oportunidade['ID_usuario']}', '{$oportunidade['titulo']}', '{$oportunidade['estado']}', '{$oportunidade['cidade']}', '{$oportunidade['inicio']}', '{$oportunidade['tempo_expirar']}', '{$oportunidade['link']}', '{$oportunidade['tipo_personalidade']}', '{$oportunidade['descricao']}', '{$oportunidade['categoria']}', '{$oportunidade['escolaridade']}', '{$novoStatus}', '{$oportunidade['data_publicacao']}', '{$oportunidade['imagem']}')";
                $insertResult = mysqli_query($conexao, $insertQuery);

                if (!$insertResult) {
                    echo 'Erro ao mover para a tabela oportunidades_inativas.';
                    exit;
                }

                // Excluir da tabela 'oportunidade'
                $deleteQuery = "DELETE FROM oportunidade WHERE ID_oportunidade = $ID_oportunidade";
                $deleteResult = mysqli_query($conexao, $deleteQuery);

                if (!$deleteResult) {
                    echo 'Erro ao excluir da tabela oportunidade.';
                    exit;
                }

                break;
                case 'reativar':
                    // 1. Selecionar a oportunidade da tabela 'oportunidades_inativas'
                    $selectQuery = "SELECT * FROM oportunidades_inativas WHERE ID_oportunidades_inativas = $ID_oportunidade";
                    $selectResult = mysqli_query($conexao, $selectQuery);
                
                    if (!$selectResult) {
                        echo 'Erro ao selecionar a oportunidade inativa.';
                        exit;
                    }
                
                    $oportunidadeInativa = mysqli_fetch_assoc($selectResult);
                
                    // 2. Inserir a oportunidade de volta na tabela 'oportunidade' com status 'pendente'
                    $insertQuery = "INSERT INTO oportunidade (ID_usuario, titulo, estado, cidade, inicio, tempo_expirar, link, tipo_personalidade, descricao, categoria, escolaridade, status_opor, data_publicacao, imagem) VALUES ('{$oportunidadeInativa['ID_usuario']}', '{$oportunidadeInativa['titulo']}', '{$oportunidadeInativa['estado']}', '{$oportunidadeInativa['cidade']}', '{$oportunidadeInativa['inicio']}', '{$oportunidadeInativa['tempo_expirar']}', '{$oportunidadeInativa['link']}', '{$oportunidadeInativa['tipo_personalidade']}', '{$oportunidadeInativa['descricao']}', '{$oportunidadeInativa['categoria']}', '{$oportunidadeInativa['escolaridade']}', 'pendente', '{$oportunidadeInativa['data_publicacao']}', '{$oportunidadeInativa['imagem']}')";
                    $insertResult = mysqli_query($conexao, $insertQuery);
                
                    if (!$insertResult) {
                        echo 'Erro ao reativar a oportunidade.';
                        exit;
                    }
                
                    // 3. Excluir a oportunidade da tabela 'oportunidades_inativas'
                    $deleteQuery = "DELETE FROM oportunidades_inativas WHERE ID_oportunidades_inativas = $ID_oportunidade";
                    $deleteResult = mysqli_query($conexao, $deleteQuery);
                
                    if (!$deleteResult) {
                        echo 'Erro ao excluir a oportunidade inativa.';
                        exit;
                    }
                
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
