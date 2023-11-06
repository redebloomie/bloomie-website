<?php
session_start();

if (isset($_POST['codigo'])) {
    $codigoInserido = $_POST['codigo']; // Código inserido pelo usuário
    $codigoVerificacao = $_SESSION['codigo_verificacao']; // Código de verificação gerado anteriormente
    // Armazene o email na sessão
    $email = $_SESSION['email_para_redefinicao'];

    if ($codigoInserido === $codigoVerificacao) {
        // Código correto, redirecione o usuário para a página de redefinição de senha
        header('Location: ../pages/redefinirSenha.html');
        exit();
    } else {
        echo 'Código de verificação incorreto. Tente novamente.';
    }
} else {
    echo 'Código de verificação não especificado.';
}
?>