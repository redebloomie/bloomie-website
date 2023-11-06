<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

// Inicie a sessão
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email']; // Captura o e-mail do formulário
    // Armazene o email na sessão
    $_SESSION['email_para_redefinicao'] = $email;
    

    // Crie uma nova instância do PHPMailer
    $mail = new PHPMailer(true);

    function gerarCodigoVerificacao($tamanho = 6) {
        $codigo = substr(md5(uniqid(rand(), true)), 0, $tamanho);
        return $codigo;
    }

    try {
        // Configuração do servidor SMTP do Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'redebloomie@gmail.com'; // Insira seu e-mail do Gmail
        $mail->Password = 'miyttiekbqxenaep'; // Insira sua senha do Gmail
        $mail->SMTPSecure = 'ssl'; // Use 'tls' ou 'ssl'
        $mail->Port = 465; // Porta 587 para TLS ou 465 para SSL

        // Remetente e destinatário
        $mail->setFrom('redebloomie@gmail.com', 'Bloomie'); // Insira suas informações
        $mail->addAddress($email); // Usar o e-mail inserido no formulário

        // Configurações do e-mail
        $mail->CharSet = 'UTF-8'; // Defina a codificação de caracteres para UTF-8

        $mail->isHTML(true); // E-mail em formato HTML

        // Gere o código de verificação
        $codigoVerificacao = gerarCodigoVerificacao();

        // Armazene o código de verificação na variável de sessão
        $_SESSION['codigo_verificacao'] = $codigoVerificacao;

        $mail->Subject = 'Código de Verificação para Recuperação de Senha';
        $mail->Body = 'Seu código de verificação é: ' . $codigoVerificacao;

        // Envie o e-mail
        $mail->send();
        header('Location: ../pages/verificarCodigo.html');
    } catch (Exception $e) {
        echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
    }
} else {
    echo 'E-mail não especificado no formulário.';
}
?>
