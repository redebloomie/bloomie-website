<?php
session_start();
include('connect.php'); // Conexão com o banco de dados

if (isset($_POST['nome']) && isset($_POST['usuario'])) {
    // Processar campos de texto (nome, usuário)
    $novoNome = $_POST['nome']; // Obtenha o valor do campo de nome
    $novoSobrenome = $_POST['sobrenome']; // Obtenha o valor do campo de nome
    $novoUsuario = $_POST['usuario']; // Obtenha o valor do campo de usuário
    $novoSobre = $_POST['sobre']; // Obtenha o valor do campo de usuário
    $novoInteresse = $_POST['interesses'];

    // Inicializa as variáveis para a foto de perfil
    $caminhoDestino = null;

    // Processar a nova foto de perfil, se fornecida
    if ($_FILES['novaFotoPerfil']['error'] == UPLOAD_ERR_OK) {
        $nomeArquivo = $_FILES['novaFotoPerfil']['name'];
        $caminhoTemporario = $_FILES['novaFotoPerfil']['tmp_name'];
        $caminhoDestino = '../img/' . $nomeArquivo; // Especifique o caminho onde deseja salvar o arquivo

        // Move o arquivo para o destino
        move_uploaded_file($caminhoTemporario, $caminhoDestino);
    }

    // Atualiza o caminho da foto de perfil no banco de dados, se fornecido
    if ($caminhoDestino !== null) {
        $ID_usuario = $_SESSION['ID_usuario'];
        $sqlUpdateFoto = "UPDATE usuario SET foto_perfil = ? WHERE ID_usuario = ?";
        $stmtUpdateFoto = $conexao->prepare($sqlUpdateFoto);
        $stmtUpdateFoto->bind_param("si", $caminhoDestino, $ID_usuario);
        if (!$stmtUpdateFoto->execute()) {
            die('Erro ao atualizar a foto de perfil: ' . $stmtUpdateFoto->error);
        }
        $stmtUpdateFoto->close();
    }

    // Atualiza o nome e o usuário no banco de dados
    $ID_usuario = $_SESSION['ID_usuario'];
    $sqlUpdateDados = "UPDATE usuario SET nome = ?, usuario = ?, sobrenome = ?, sobre = ?, interesses = ? WHERE ID_usuario = ?";
    $stmtUpdateDados = $conexao->prepare($sqlUpdateDados);
    $stmtUpdateDados->bind_param("sssssi", $novoNome, $novoUsuario, $novoSobrenome, $novoSobre, $novoInteresse, $ID_usuario);
    if (!$stmtUpdateDados->execute()) {
        die('Erro ao atualizar o nome e o usuário: ' . $stmtUpdateDados->error);
    }
    $stmtUpdateDados->close();

    // Redireciona para a página de perfil após a atualização
    header("Location: perfil.php");
    exit();
} else {
    die('Dados não recebidos corretamente.');
}
?>
