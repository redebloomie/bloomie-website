<?php
session_start();
include('connect.php');

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $anoNasc = $_POST['ano'];
    $mesNasc = $_POST['mes'];
    $diaNasc = $_POST['dia'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $fotoPerfil = "../assets/bluBloomie.png";
    date_default_timezone_set("America/Sao_Paulo");
    $format = "$anoNasc-$mesNasc-$diaNasc";
    $dataNascimento = date("Y-m-d", strtotime($format));
    $data = date("Y-m-d H:i:s");

    

    // Validação da senha
    if (strlen($senha) < 8 || !preg_match("/[a-z]/", $senha) || !preg_match("/[A-Z]/", $senha) || !preg_match("/[!@#$%^&*()_+]/", $senha)) {
        echo "Senha inválida. A senha deve ter pelo menos 8 caracteres, uma letra maiúscula, uma letra minúscula e um caractere especial.";
        exit;
    }

    // Validação da data de nascimento
    $dataLimite = strtotime('-14 years');

    if (strtotime($dataNascimento) > $dataLimite) {
        echo "Você deve ter mais de 14 anos para se cadastrar.";
        exit;
    }

    // Use declarações preparadas para evitar SQL Injection
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Insira os dados do usuário na tabela usuario
    $stmt_usuario = $conexao->prepare("INSERT INTO usuario(nome, sobrenome, senha, email, usuario, estado, cidade, data_nasc, data_criacao, foto_perfil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt_usuario->bind_param("ssssssssss", $nome, $sobrenome, $senha_hash, $email, $usuario, $estado, $cidade, $dataNascimento, $data, $fotoPerfil);

    if ($stmt_usuario->execute()) {
        // Recupere o ID_usuario após a inserção
        $ID_usuario = $stmt_usuario->insert_id;

        // Verifique se a inserção na tabela usuario foi bem-sucedida
        if ($ID_usuario > 0) {
            $_SESSION['ID_usuario'] = $ID_usuario; // Defina user_id após o cadastro bem-sucedido
            // Redirecione o usuário após o registro bem-sucedido
            header('Location: ../pages/cadConfirmacao.html');
            exit;
        } else {
            echo "Erro ao inserir dados do usuário.";
        }
    } else {
        echo "Erro ao inserir dados do usuário: " . $stmt_usuario->error;
    }

    // Feche as declarações preparadas
    $stmt_usuario->close();
    $conexao->close();
}
?>
