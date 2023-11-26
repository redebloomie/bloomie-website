<?php
// adicionar_amigo.php

include('connect.php'); // Certifique-se de ter um arquivo de conexão adequado

if (isset($_GET['id'])) {
    $usuario_id_1 = $_SESSION['ID_usuario']; // ID do usuário que está logado (você pode obter isso de uma sessão)
    $usuario_id_2 = $_GET['id'];

    // Verifique se os usuários não são os mesmos
    if ($usuario_id_1 != $usuario_id_2) {
        // Verifique se eles não são amigos ainda
        $verificaAmizade = "SELECT * FROM bloomizade WHERE (usuario_id_1 = $usuario_id_1 AND usuario_id_2 = $usuario_id_2) OR (usuario_id_1 = $usuario_id_2 AND usuario_id_2 = $usuario_id_1)";
        $result = mysqli_query($conexao, $verificaAmizade);

        if ($result && mysqli_num_rows($result) == 0) {
            // Se não são amigos, adicione à tabela amigos
            $adicionarAmigo = "INSERT INTO bloomizade (usuario_id_1, usuario_id_2) VALUES ($usuario_id_1, $usuario_id_2)";
            mysqli_query($conexao, $adicionarAmigo);

            echo "Amigo adicionado com sucesso!";
        } else {
            echo "Esses usuários já são amigos.";
        }
    } else {
        echo "Você não pode se adicionar como amigo.";
    }
} else {
    echo "ID de usuário não fornecido.";
}

// Feche a conexão
mysqli_close($conexao);
?>
