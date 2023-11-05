<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Recupere o ID_usuario após a inserção
    $ID_usuario = mysqli_insert_id($conexao);
    $email = ""
    $novaSenha = $_POST['novaSenha'];
    $confirmarSenha = $_POST['confirmarSenha'];

    if ($novaSenha === $confirmarSenha) {

        // Hash da nova senha (você deve usar password_hash para armazenar senhas de forma segura)
        $senhaHash = password_hash($novaSenha, PASSWORD_BCRYPT);

        // Atualizar a senha no banco de dados
        $sql = "UPDATE usuario SET senha = ? WHERE ID_usuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("si", $senhaHash, $ID_usuario);

        if ($stmt->execute()) {
            // Redirecionar o usuário para uma página de confirmação
            // header('Location: ../../public/index.html#login');
            echo $ID_usuario;
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
