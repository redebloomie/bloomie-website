<?php
session_start();
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['usuario'];
    $texto = $_POST['texto'];
    $idUsuario = $_SESSION['ID_usuario'];

    $caminhoImagem = '';

    // Verifique se o arquivo foi enviado corretamente
    if (isset($_FILES['uploadImagem']) && $_FILES['uploadImagem']['error'] === UPLOAD_ERR_OK) {
        $caminhoImagem = '../img/' . $_FILES['uploadImagem']['name'];
        move_uploaded_file($_FILES['uploadImagem']['tmp_name'], $caminhoImagem);
    }

    $sql = "INSERT INTO post (ID_usuario, usuario, texto, imagem, data_publicacao) 
            VALUES ('$idUsuario', '$usuario', '$texto', '$caminhoImagem', NOW())";

    if ($conexao->query($sql) === TRUE) {
        // Após a inserção, obtenha o último ID de post inserido
        $ultimoID = $conexao->insert_id;

        // Consulta para obter o post recém-inserido
        $result = $conexao->query("SELECT * FROM post WHERE ID_post = $ultimoID");
        $novoPost = $result->fetch_assoc();

        // Adicione o caminho da imagem à resposta JSON
        $novoPost['caminhoImagem'] = $novoPost['imagem'];
        $novoPost['data_publicacao'] = date('d/m/Y', strtotime($novoPost['data_publicacao']));

        echo json_encode(['success' => true, 'post' => $novoPost]);
    } else {
        echo json_encode(['success' => false, 'error' => "Erro ao postar: " . $conexao->error]);
    }
}
$conexao->close();
?>
