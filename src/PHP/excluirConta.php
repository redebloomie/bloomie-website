<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('connect.php'); // Inclua o arquivo de conexão com o banco de dados

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifique se as credenciais estão corretas
    $sqlVerificarCredenciais = "SELECT ID_usuario, senha FROM usuario WHERE email = ?";
    $stmtVerificarCredenciais = $conexao->prepare($sqlVerificarCredenciais);
    $stmtVerificarCredenciais->bind_param("s", $email);
    $stmtVerificarCredenciais->execute();
    $stmtVerificarCredenciais->bind_result($ID_usuario, $senhaHash);
    $stmtVerificarCredenciais->fetch();
    $stmtVerificarCredenciais->close();

    if ($ID_usuario && password_verify($senha, $senhaHash)) {
        // Credenciais corretas, proceda com a exclusão da conta

        // Excluir posts associados ao usuário
        $sqlExcluirPosts = "DELETE FROM post WHERE ID_usuario = ?";
        $stmtExcluirPosts = $conexao->prepare($sqlExcluirPosts);
        $stmtExcluirPosts->bind_param("i", $ID_usuario);
        $stmtExcluirPosts->execute();
        $stmtExcluirPosts->close();

        // Mover o usuário para a tabela de contas inativas
        $sqlMoverContaInativa = "INSERT INTO contas_inativas (ID_usuario, data_mover) VALUES (?, NOW())";
        $stmtMoverContaInativa = $conexao->prepare($sqlMoverContaInativa);
        $stmtMoverContaInativa->bind_param("i", $ID_usuario);
        $stmtMoverContaInativa->execute();
        $stmtMoverContaInativa->close();

        // Agora você pode prosseguir para excluir a conta se necessário
        // ...

        // Limpe a sessão e redirecione para a página de login
        session_unset();
        session_destroy();
        header('Location: ../../public/index.html');
        exit();
    } else {
        // Credenciais inválidas
        header('Location: ../pages/excluir_conta.html');
        exit();
    }
} else {
    // Se a solicitação não veio do formulário de exclusão, redirecione para a página principal
    header('Location: ../../public/index.html');
    exit();
}
?>
