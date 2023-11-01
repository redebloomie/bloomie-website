<?php

include('connect.php');

if(isset($_POST['submit']))
{
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
    $data_criacao = date("Y-m-d");
    date_default_timezone_set("America/Sao_Paulo");
    $dataNascimento = date("Y-m-d", strtotime("$anoNasc-$mesNasc-$diaNasc"));



    $stmt = $conexao->prepare("INSERT INTO usuario(nome, sobrenome, email, usuario, senha, estado, cidade) VALUES ('$nome','$sobrenome','$email','$usuario','$senha','$estado','$cidade')");

    // Validação da senha
    if (strlen($senha) < 8 || !preg_match("/[a-z]/", $senha) || !preg_match("/[A-Z]/", $senha) || !preg_match("/[!@#$%^&*()_+]/", $senha)) {
        echo "Senha inválida. A senha deve ter pelo menos 8 caracteres, uma letra maiúscula, uma letra minúscula e um caractere especial.";
        exit;
    }

    // Validação da data de nascimento
    $dataLimite = strtotime('-14 years');

    if ($dataNascimento > $dataLimite) {
        echo "Você deve ter mais de 14 anos para se cadastrar.";
        exit;
    }

    // Use declarações preparadas para evitar SQL Injection
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Insira os dados do usuário na tabela usuario
    // Insira os dados do usuário na tabela usuario
$stmt_usuario = $conexao->prepare("INSERT INTO usuario(nome, sobrenome, senha, email, usuario, estado, cidade) VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt_usuario->bind_param("sssssss", $nome, $sobrenome, $senha_hash, $email, $usuario, $estado, $cidade);

if ($stmt_usuario->execute()) {
    // Recupere o ID_usuario após a inserção
    $ID_usuario = mysqli_insert_id($conexao);

    // Verifique se a inserção na tabela usuario foi bem-sucedida
    if ($ID_usuario > 0) {
        // Insira o ID_usuario na tabela estudante
        $stmt_estudante = $conexao->prepare("INSERT INTO estudante(ID_usuario, data_nasc) VALUES (?, ?)");
        $stmt_estudante->bind_param("ss", $ID_usuario, $dataNascimento);

        if ($stmt_estudante->execute()) {
            // Redirecione o usuário após o registro bem-sucedido
            header('Location: ../pages/cadConfirmacao.html');
        } else {
            echo "Erro ao inserir dados do estudante: " . $stmt_estudante->error;
        }
    } else {
        echo "Erro ao inserir dados do usuário.";
    }
} else {
    echo "Erro ao inserir dados do usuário: " . $stmt_usuario->error;
}

// Feche as declarações preparadas
if (isset($stmt_usuario)) {
    $stmt_usuario->close();
}

if (isset($stmt_estudante)) {
    $stmt_estudante->close();
}

$conexao->close();

}
?>
