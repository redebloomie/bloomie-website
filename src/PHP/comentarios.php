<?php
include('connect.php');

if (isset($_POST['comnetar']) && $_POST['comentar'] == "comentar"){
  $usuario = $_POST['usuario']; //esse campo é pra mostra o nome d usuario que ta comentando, não sei como fazer isso
  $comentario = $_POST['comentario'];
  $data = date("d/m/Y");
  $hora = date ("H:i");
}

  $comentar = "INSERT INTO comentarios (ID_post, usuario, comentario, data, hora) VALUES ('$ID_post','$usuario','$comentario','$data','$hora')";

  if(mysql_query($comentar)){
    echo "Comentário enviado com sucesso"; // comentario salvo no banco (espero)

  }

    // mostrar comentarios na publicação 
    $selecione = mysql_query("SELECT * FROM comentarios WHERE  ID_post = '$ID_post' ");
    $conta = mysql_num_rows($selecione);
    
    if($conta <= 0){
        echo "sem comentários";
    }else{
        while($row = mysql_fetch_array($selecione)){
            $usuario = $row['usuario']; 
            $comentario = $row['comentario'];
            $data = $row['data'];
            $hora = $row ['hora'];
        }
    }

?>