<?php
    // $conexao = new mysqli('bloomie_db.mysql.dbaas.com.br', 'bloomie_db', 'SomosBloomie0@', 'bloomie_db');
    $conexao = new mysqli('localhost', 'root', '', 'bloomie_db');
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('Y-m-d H:i:s');

    // Configurando o conjunto de caracteres para UTF-8
    mysqli_set_charset($conexao, 'utf8');

    // if($conexao->connect_errno)
    // {
    //     echo "Erro";
    // }
    // else
    // {
    //     echo "Conexão efetuada com sucesso";
    // }

?>