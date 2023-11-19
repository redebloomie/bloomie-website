<?php
session_start();
include ('connect.php');

if (isset($_POST['submit'])) {
    $titulo = $_POST['titulo'];
    $categoria = $_POST['categoria'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $inicio = $_POST['inicio'];
    $tempo_expirar = $_POST['tempo_expirar'];
    $descricao = $_POST['descricao'];
    $escolaridade = $_POST['escolaridade'];
    $link = $_POST['link'];
    $tipo_personalidade = $_POST['tipo_personalidade'];
    $idUsuario = $_SESSION['ID_usuario'];

    // Verifique se o arquivo foi enviado corretamente
    if (isset($_FILES['uploadImagem']) && $_FILES['uploadImagem']['error'] === UPLOAD_ERR_OK) {
        $caminhoImagem = '../img/' . $_FILES['uploadImagem']['name'];
        move_uploaded_file($_FILES['uploadImagem']['tmp_name'], $caminhoImagem);
    } else {
        echo "Erro no envio do arquivo. Código de erro: " . $_FILES['uploadImagem']['error'];
        // Definir um caminho padrão ou mensagem de erro para a imagem
        $caminhoImagem = '../assets/bluBloomie.png';
    }

    // Calcular a diferença entre a data de vencimento e a data atual
    $diferenca = strtotime($tempo_expirar) - strtotime($data);

    // Definir o status com base na diferença de datas
    if ($diferenca < 0) {
        $status = "inativa";
    } else {
        $status = "ativa";
    }

    $stmt = $conexao->prepare("INSERT INTO oportunidade(ID_usuario, titulo, estado, cidade, inicio, tempo_expirar, link, tipo_personalidade, descricao, categoria, escolaridade, status_opor, data_publicacao, imagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }

    $stmt->bind_param("isssssssssssss", $idUsuario, $titulo, $estado, $cidade, $inicio, $tempo_expirar, $link, $tipo_personalidade, $descricao, $categoria, $escolaridade, $status, $data, $caminhoImagem);

    if ($stmt->execute()) {
        header('Location: ../pages/oportunidadeEnviada.html');
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    // Feche a declaração preparada e a conexão
    $stmt->close();
    $conexao->close();
}
2
?>
