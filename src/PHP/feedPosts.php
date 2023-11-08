<?php
include('connect.php');

// Consulta SQL para selecionar postagens do banco de dados (substitua pelas suas próprias tabelas e colunas)
$query = "SELECT * FROM postagens ORDER BY data_publicacao DESC LIMIT 10"; // Por exemplo, pegando as últimas 10 postagens

$resultado = $conexao->query($query);

if ($resultado->num_rows > 0) {
    $postagens = array();

    while ($row = $resultado->fetch_assoc()) {
        // Construa um array com os dados das postagens
        $postagem = array(
            'titulo' => $row['titulo'],
            'texto' => $row['texto'],
            'imageUrl' => $row['imagem_url']
        );

        // Adicione a postagem ao array de postagens
        $postagens[] = $postagem;
    }

    // Converte o array de postagens em JSON
    $json_postagens = json_encode($postagens);

    // Envie o JSON de volta para o JavaScript
    echo $json_postagens;
} else {
    echo "Nenhuma postagem encontrada.";
}

// Feche a conexão com o banco de dados
$conexao->close();
?>
