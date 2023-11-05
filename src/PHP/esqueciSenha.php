<?php

  include("connect.php");

  $erro = array(); // Defina $erro como um array vazio

  if(isset($_POST['submit'])){
    $email = $conexao->escape_string($_POST['email']);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $erro[] = "E-mail inválido.";
    }

    // Query para verificar a existência de um usuário com base no email
    $sql = "SELECT senha FROM usuario WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result(); // Armazena os resultados para uso posterior

    // Verifica o número de linhas (deve ser 0 ou 1 no caso de um login)
    $total = $stmt->num_rows;

    // Fecha o statement
    $stmt->close();

    if ($total == 0) {
        // Usuário não encontrado
        $erro[] = "O e-mail informado não existe no banco de dados.";
    }

    

    if(count($erro) == 0){
      $novasenha = substr(md5(time()), 0, 6);
      $nscriptografada = md5(md5($novasenha));

      if(1 == 1){
        $sql_code = "UPDATE usuario SET senha = '$nscriptografada' WHERE email = '$email'";
        $sql_query = $conexao->query($sql_code) or die($conexao->error);

        if($sql_query){
          $erro[] = "Senha Alterada com Sucesso!";
        }
      }
    }
  }
?>

<!doctype html>
<html lang="en">

<head>
  <title>Bloomie</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.css'>

  <link rel="stylesheet" href="../../public/style.css">
  <link rel="shortcut icon" href="/src/assets/bluBloomie.png"/>

  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://kit.fontawesome.com/fec6e5d711.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

  <nav class="navbar-p">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="ph-bold ph-house" style="color: #fff;"></i>
          <span class="link-text" style="color: #fff;">Home</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="ph-bold ph-info" style="color: #fff;"></i>
          <span class="link-text" style="color: #fff;">Sobre</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="ph-bold ph-user" style="color: #fff;"></i>
          <span class="link-text" style="color: #fff;">Login</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="ph-bold ph-users" style="color: #fff;"></i>
          <span class="link-text" style="color: #fff;">Parcerias</span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="container-menu">
    <nav class="navigation" role="navigation">
      <div id="menuToggle">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
        <ul id="menu">
          <a href="#" style="display: flex; flex-direction: row; align-items: center;">
            <i class="ph-bold ph-house" style="font-size: 30px; margin-right: 10px;"></i>
            <li>Home</li>
          </a>
          <a href="#" style="display: flex; flex-direction: row; align-items: center;">
            <i class="ph-bold ph-info" style="font-size: 30px; margin-right: 10px;"></i>
            <li>Sobre</li>
          </a>
          <a href="#" style="display: flex; flex-direction: row; align-items: center;">
            <i class="ph-bold ph-user" style="font-size: 30px; margin-right: 10px;"></i>
            <li>Perfil</li>
          </a>
          <a href="#" style="display: flex; flex-direction: row; align-items: center;">
            <i class="ph-bold ph-users" style="font-size: 30px; margin-right: 10px;"></i>
            <li>Parcerias</li>
          </a>
        </ul>
      </div>
    </nav>
  </div>

  <section id="cadastro">
    <div class="cadastro-container">
      <div class="form-cadastro">
        <h2 class="text-center" style="font-weight: 700;">Vamos começar?</h2>
        <h3 class="text-center" style="font-weight: 400;"><span style="font-weight: 500;">Calma!</span> Informe o email associado à sua conta para redefinirmos sua senha.</h3>
        <form method="POST" action="" class="row g-3">
          <div class="col-md-12">
            <input value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" type="email" name="email" class="form-control" id="inputEmail4" placeholder="E-mail" required>
          </div>
          <!-- Área para exibir mensagens de erro -->
          <div class="col-md-12">
              <div class="error-messages" style="text-align: center;">
                  <?php
                  if (!empty($erro)) {
                      foreach ($erro as $msg) {
                          echo "<p>$msg</p>";
                      }
                  }
                  ?>
              </div>
          </div>
          <div class="col-md-12 text-center btn-lg">
            <input name="submit" type="submit" value="Enviar" class="btn btn-primary" style="color: #fff;"></input>
            <p style="color: #5AB5FF; margin-top: 10px;">Lembrou a senha? <a href="../../public/index.html#login" style="font-weight: 500; color: #4fb0ff;">Faça login</a></p>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
    crossorigin="anonymous"></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/js/swiper.js'></script>
  <script src="/public/script.js"></script>
</body>

</html>