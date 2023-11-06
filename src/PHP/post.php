<?php 

include('connect.php');

if(isset($_POST['submit'])){
    // $data_publicacao = $_POST['data_publicacao'];
    //$documento = $_POST['documento'];
    $imagem = $_FILES['imagem'];
    $texto = $_POST['texto'];
    $stmt = $conexao->prepare("INSERT INTO post(imagem,texto) 
    VALUES ('imagem','$texto')");

    if ($stmt->execute()) {
        echo "Post feito!";
       
    } else {
        echo "campo vazio " . $stmt->error;
    }
}

?>