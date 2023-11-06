<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novaSenha = $_POST['novaSenha'];
    $confirmarSenha = $_POST['confirmarSenha'];

    if ($novaSenha === $confirmarSenha) {
        // Recupere o email da sessão
        $emailUsuario = $_SESSION['email_para_redefinicao']; // Correção aqui

        // Hash da nova senha (use password_hash para armazenar senhas de forma segura)
        $senhaHash = password_hash($novaSenha, PASSWORD_BCRYPT);

        // Atualize a senha no banco de dados para o usuário com o email especificado
        $sql = "UPDATE usuario SET senha = ? WHERE email = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ss", $senhaHash, $emailUsuario); // Correção aqui

        if ($stmt->execute()) {
            // Redirecionar o usuário para uma página de confirmação
            echo "Senha atualizada com sucesso!";
            exit();
        } else {
            echo "Erro ao redefinir a senha: " . $stmt->error;
        }

        // Fechar a conexão e liberar recursos
        $stmt->close();
        $conexao->close();
    } else {
        echo '<p>As senhas não coincidem. Tente novamente.</p>';
    }
}

?>
