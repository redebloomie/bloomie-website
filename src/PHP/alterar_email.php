<?php
session_start();
include ('connect.php');

// Inicializar a variável de erro
$erroEmail = "";

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar e-mails
    $novoEmail = mysqli_real_escape_string($conexao, $_POST['novo_email']);
    $confirmarEmail = mysqli_real_escape_string($conexao, $_POST['confirmar_email']);

    if ($novoEmail == $confirmarEmail) {
        // Atualizar o e-mail no banco de dados (substitua com sua lógica)
        $idUsuario = $_SESSION['ID_usuario'];
        $queryUpdateEmail = "UPDATE usuario SET email = '$novoEmail' WHERE ID_usuario = $idUsuario";
        mysqli_query($conexao, $queryUpdateEmail);

        // Redirecionar para a página de perfil ou outra página
        header("Location: configuracoes.php");
        exit();
    } else {
        $erroEmail = "Os e-mails não coincidem.";
    }
}

// Fechar a conexão
mysqli_close($conexao);
?>
