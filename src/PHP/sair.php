<?php
// Inicie a sessão (se ainda não estiver iniciada)
session_start();

// Destrua a sessão para fazer logout
session_destroy();

// Redirecione para a página inicial (altere 'index.php' para o caminho desejado)
header("Location: ../../index.html");
exit(); // Certifique-se de sair após redirecionar
?>