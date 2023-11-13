<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Inclua o arquivo de conexão com o banco de dados
    include_once('connect.php');
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $ID_usuario = "SELECT ID_usuario FROM usuario WHERE email = ?";
    $usuario = "SELECT usuario FROM usuario WHERE email = ?";

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
    
        // Recupere o ID do usuário com base no email
        $sqlUsuario = "SELECT usuario FROM usuario WHERE email = ?";
        $stmtUsuario = $conexao->prepare($sqlUsuario);
        $stmtUsuario->bind_param("s", $email);
        $stmtUsuario->execute();
        $stmtUsuario->bind_result($usuario);  // Certifique-se de ajustar o nome da coluna
        $stmtUsuario->fetch();
        $stmtUsuario->close();

        // Defina a variável de sessão para o usuário
        $_SESSION['usuario'] = $usuario;
    
        if ($email == 'winnie@gmail.com' && $senha == 'winnie') {
            header('Location: ../pages/adm.html');
        } else {
            // Verifique o campo 'personalidade' na tabela 'estudante'
            $sqlEstudante = "SELECT personalidade FROM usuario WHERE ID_usuario = ?";
            $stmtEstudante = $conexao->prepare($sqlEstudante);
            $stmtEstudante->bind_param("i", $ID_usuario); // Usamos o ID do usuário aqui
            $stmtEstudante->execute();
            $stmtEstudante->bind_result($personalidade);
            $stmtEstudante->fetch();
            $stmtEstudante->close();
    
            if (empty($personalidade)) {
                header('Location: ../pages/homepage-oportunidades-nm.html');
            } else {
                header('Location: ../pages/homepage-postagens.html');
            }
        }
    } else {
        // Credenciais inválidas
        unset($_SESSION['email']);
        header('Location: ../../public/index.html');
    }
}
?>
    