<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Inclua o arquivo de conexão com o banco de dados
    include_once('connect.php');
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT senha FROM usuario WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($senhaHash);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($senha, $senhaHash)) {
        // A senha é válida, permita o acesso
        $_SESSION['email'] = $email;

        // Verifique o campo 'personalidade' na tabela 'estudante'
        $sqlEstudante = "SELECT personalidade FROM estudante WHERE ID_usuario = (SELECT ID_usuario FROM usuario WHERE email = ?)";
        $stmtEstudante = $conexao->prepare($sqlEstudante);
        $stmtEstudante->bind_param("s", $email);
        $stmtEstudante->execute();
        $stmtEstudante->bind_result($personalidade);
        $stmtEstudante->fetch();
        $stmtEstudante->close();

        if ($email == 'winnie@gmail.com' && $senha == 'winnie') {
            header('Location: ../pages/adm.html');
        } elseif (empty($personalidade)) {
            header('Location: ../pages/homepage-oportunidades-nm.html');
        } else {
            header('Location: ../pages/homepage-postagens.html');
        }
    } else {
        // Credenciais inválidas
        unset($_SESSION['email']);
        header('Location: ../../public/index.html');
    }
} else {
    // Não acessa
    header('Location: connect.php');
}
?>
