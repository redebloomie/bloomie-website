
<?php
// Inicie a sessão (se ainda não estiver iniciada)
session_start();
include('connect.php'); // Certifique-se de incluir o arquivo de conexão

// Verifique se o formulário foi enviado
if (isset($_POST['submit'])) {
    // Obtém os dados do formulário
    $ID_posts_excluidos = $_POST['ID_posts_excluidos'];
    $ID_post = $_POST['ID_post'];
    $ID_usuario = $_POST['ID_usuario'];
    $data_exclusao = $_POST['data_exclusao'];


// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifique se a solicitação é do tipo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtenha o ID da postagem a ser excluída
    $ID_post = isset($_POST["ID_post"]) ? $_POST["ID_post"] : null;

    // Verifique se o ID da postagem foi fornecido
    if ($ID_post) {
        // Consulta para obter os dados da postagem antes de excluí-la
        $select_query = "SELECT * FROM post WHERE id = $ID_post";
        $result = $conn->query($select_query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Mova a postagem excluída para a tabela de posts excluídos
            $insert_query = "INSERT INTO post_excluidos (ID_posts_excluidos, ID_post, ID_usuario, data_exclusao) VALUES ('$ID_posts_excluidos','$ID_post','$ID_usuario','$data_exclusao')";
            $conn->query($insert_query);

            // Exclua a postagem da tabela principal
            $delete_query = "DELETE FROM post WHERE id = $ID_post";
            $conn->query($delete_query);

            $message = "Postagem excluída e movida para 'Posts Excluídos'";
        } else {
            $message = "Postagem não encontrada";
        }
    } else {
        $message = "ID da postagem não fornecido";
    }
} else {
    $message = "Método de solicitação inválido";
}

// Feche a conexão com o banco de dados
$conn->close();

// Redirecione de volta à página principal com a mensagem
header("Location:  adm_Postagem.html");
exit;
}
?>




