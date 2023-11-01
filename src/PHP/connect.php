<?php
    
    $conexao = new mysqli('localhost', 'root', '', 'bloomie_db');
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('Y-m-d H:i:s');

    // if($conexao->connect_errno)
    // {
    //     echo "Erro";
    // }
    // else
    // {
    //     echo "Conexão efetuada com sucesso";
    // }

?>