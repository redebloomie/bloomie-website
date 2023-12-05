<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha'])) {
    // Inclua o arquivo de conexão com o banco de dados
    include_once('connect.php');
    
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Verifique se o login é um e-mail ou nome de usuário
    $campoLogin = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'usuario';

    // Consulta SQL para obter o ID do usuário e a senha com base no e-mail ou nome de usuário
    $sql = "SELECT ID_usuario, usuario, foto_perfil, senha FROM usuario WHERE $campoLogin = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($ID_usuario, $usuario, $fotoPerfil, $senhaHash);
    $stmt->fetch();
    $stmt->close();

    $_SESSION['ID_usuario'] = $ID_usuario;
    $_SESSION['foto_perfil'] = $fotoPerfil;
    $_SESSION['email'] = $email;

    if (password_verify($senha, $senhaHash)) {
        // A senha é válida, permita o acesso
        $_SESSION['usuario'] = $usuario;

         // Verifique o campo 'personalidade' na tabela 'estudante'
         $sqlEstudante = "SELECT personalidade FROM usuario WHERE ID_usuario = ?";
         $stmtEstudante = $conexao->prepare($sqlEstudante);
         $stmtEstudante->bind_param("i", $ID_usuario);
         $stmtEstudante->execute();
         $stmtEstudante->bind_result($personalidade);
         $stmtEstudante->fetch();
         $stmtEstudante->close();
 
         if (empty($personalidade)) {
             header('Location: homepage-oportunidades-nm.php');
         } else {
             header('Location: homepage-postagens.php');
         }
    } else {
        // Credenciais inválidas
        unset($_SESSION['usuario']);
        header('Location: ../../public/index.html');
    }
}

?>
