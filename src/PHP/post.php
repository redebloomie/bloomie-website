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

        echo json_encode($novoPost); // Envie o novo post como resposta JSON
    } else {
        echo json_encode(['error' => "Erro ao postar: " . $conexao->error]);
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $postsPorPagina = 5;
    $indiceInicio = ($pagina - 1) * $postsPorPagina;

    // Substitua a consulta SQL atual pelo seguinte:
    $result = $conexao->query("SELECT ID_post, ID_usuario, usuario, texto, imagem, data_publicacao FROM post ORDER BY data_publicacao DESC LIMIT $indiceInicio, $postsPorPagina");
    $posts = array();

    while ($row = $result->fetch_assoc()) {
        // Adicione o caminho da imagem ao array
        $row['caminhoImagem'] = $row['imagem'];

        // Se não houver imagem, remova a chave 'imagem' do array
        if (empty($row['imagem'])) {
            unset($row['imagem']);
        }

        $posts[] = $row;
    }

    echo json_encode($posts);
}

$conexao->close();
?>
