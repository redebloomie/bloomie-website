<?php
// Inicie a sessão (se ainda não estiver iniciada)
session_start();
include('connect.php'); // Certifique-se de incluir o arquivo de conexão

// Verifique se o formulário foi enviado
if (isset($_POST['submit'])) {
    // Obtém os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $ID_usuario = $_SESSION['ID_usuario'];

    // Valide os dados do formulário (você pode adicionar mais validações conforme necessário)
    if (empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        // Consulta para obter informações do usuário
        $consultaUsuario = $conexao->query("SELECT * FROM usuario WHERE ID_usuario = $ID_usuario");

        // Verifica se o usuário existe
        if ($consultaUsuario->num_rows > 0) {
            $dadosUsuario = $consultaUsuario->fetch_assoc();

            // Prepare a segunda consulta SQL
            $stmt = $conexao->prepare("INSERT INTO contas_inativas (ID_usuario, nome, sobrenome, usuario, senha, email, data_inatividade, motivo, estado, cidade, personalidade, data_nasc) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), 'Exclusão de conta', ?, ?, ?, ?)");

            if ($stmt === false) {
                die('Erro de preparação da segunda consulta: ' . $conexao->error);
                // Exibir informações adicionais para depuração
                echo 'Detalhes do erro: ' . $stmt->error;
            }

            // Associe os parâmetros
            $stmt->bind_param("isssssssss", $dadosUsuario['ID_usuario'], $dadosUsuario['nome'], $dadosUsuario['sobrenome'], $dadosUsuario['usuario'], $dadosUsuario['senha'], $dadosUsuario['email'], $dadosUsuario['estado'], $dadosUsuario['cidade'], $dadosUsuario['personalidade'], $dadosUsuario['data_nasc']);

            // Execute a segunda consulta
            $stmt->execute();

            // Agora exclua a conta da tabela de usuários
            $conexao->query("DELETE FROM usuario WHERE ID_usuario = $ID_usuario");

            // Destrua a sessão
            session_destroy();

            // Redirecione para a página inicial ou de confirmação
            header("Location: ../../public/index.html");
            exit();
        } else {
            // Usuário não encontrado, redireciona para uma página de erro ou homepage
            header("Location: index.php"); // Altere para a página desejada
            exit();
        }
    }
}
?>
