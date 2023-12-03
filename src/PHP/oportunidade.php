<?php
  session_start();
  include('connect.php');
  $idOportunidade = $_GET['id'];
?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.css'>

  <link rel="stylesheet" href="../../public/style.css">
  <link rel="shortcut icon" href="../assets/bluBloomie.png" />

  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://kit.fontawesome.com/fec6e5d711.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body id="homepage">
  <nav class="navbar navbar-expand-sm navbar-dark bg-white">
    <a class="navbar-brand" href="homepage-postagens.php"><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"></a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
      aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
      <ul class="navbar-nav me-auto mt-2 mt-lg-0" style="display: flex; flex-direction: row; gap: 10px;">
        <li class="nav-item">
          <a href="homepage-postagens.php">
            <button type="button" id="btnPostagens" class="btn"
            style="color: #5AB5FF; font-weight: 500;">Postagens</button>
          </a>
        </li>
        <li class="nav-item">
          <a href="homepage-oportunidades-nm.php">
            <button type="button" id="btnOportunidades" class="btn"
            style="background-color: #0C5D9E; color: #fff; font-weight: 500; border-radius: 15px; width: 150px;">Oportunidades</button>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <main>
    <div class="row justify-content-start align-items-start g-0">
      <div class="col-2 bg-primary sidebar-container">
        <div class="container text-center sidebar">
          <div class="row row-cols-1 justify-content-around align-items-center g-5">
            <div class="col">
              <span class="searchbar rounded-4">
                <i class="ph ph-magnifying-glass"></i>
                <input type="text" name="" id="" placeholder="Buscar...">
              </span>
            </div>
            <div class="col">
              <div class="row row-cols-1 justify-content-start align-items-center g-3 text-start">
                <div class="col text-white sidebar-op">
                  <i class="ph ph-house"></i>
                  <a href="homepage-postagens.php" class="text-decoration-none text-white">Home</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-user"></i>
                  <a href="perfil.php" class="text-decoration-none text-white">Perfil</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-bell-ringing"></i>
                  <a href="notificacoesGeral.php" class="text-decoration-none text-white">Notificações</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-plant"></i> 
                  <a href="../pages/enviarOportunidade.html" class="text-decoration-none text-white">Enviar<br>oportunidades</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-gear"></i>
                  <a href="../pages/configuracoes.html" class="text-decoration-none text-white">Configurações</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-question"></i>
                  <a href="../pages/Ajuda_e_Suporte.html" class="text-decoration-none text-white">Ajuda & suporte</a>
                </div>
              </div>
            </div>
            <div class="col">
              <a href="sair.php" class="text-decoration-none text-white">Sair</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-10 d-flex align-items-center justify-content-center pg-postagens oportunidade-page" style="margin-top: 5.5vw;">
      <?php
        // Recupere as oportunidades
        $oportunidades = $conexao->query("SELECT * FROM oportunidade WHERE ID_oportunidade = " . $_GET['id']);

        while ($oportunidade = $oportunidades->fetch_assoc()) {
          echo '
          <div class="oportunidade-container-expand">
            <div class="oportunidade-expand-foto">
              <p class="tipo-oportunidade">' . $oportunidade['categoria'] . '</p>
              <img src="' . $oportunidade['imagem'] . '" alt="">
            </div>
            <div class="oportunidade-expand-info">
              <h2>' . $oportunidade['titulo'] . '</h2>
              <span class="oportunidade-datas span-row">
                <p><span style="color: #1289EA; font-size: 17px;">Início:</span> ' . $oportunidade['inicio'] . '</p>
                <p><span style="color: #1289EA; font-size: 17px;">Vencimento:</span> ' . $oportunidade['tempo_expirar'] . '</p>
              </span>
              <p>' . $oportunidade['descricao'] . '</p>
              <div class="oportunidades-expand-tags">
                <p style="color: #1289EA; font-size: 17px;">Tags relacionadas:</p>
                <span class="span-row tags-rel">
                  <p style="background-color: #F2C934; padding: 0 10px; border-radius: 15px;">Competição</p>
                  <p style="background-color: #88c2f1b2; padding: 0 10px; border-radius: 15px;">Olimpíada</p>
                  <p style="background-color: #5AB5FF; padding: 0 10px; border-radius: 15px;">STEM</p>
                </span>
              </div>
              <span class="span-row">
                <p><span style="color: #1289EA; font-size: 17px;">Escolaridade:</span> ' . $oportunidade['escolaridade'] . '</p>
                <p><span style="color: #1289EA; font-size: 17px;">Faixa etária:</span> ' . $oportunidade['faixa_etaria'] . '</p>
                <p><span style="color: #1289EA; font-size: 17px;">Região:</span> ' . $oportunidade['estado'] . '</p>
              </span>
              <a href="acessos_opor.php?id=' . $oportunidade['ID_oportunidade'] . '" class="btn btn-primary col-12">Acessar oportunidade</a>
            </div>
          </div>';

          // Recupere as oportunidades semelhantes
          $limit = 3;
          $oportunidadesSemelhantes = $conexao->query("SELECT * FROM oportunidade WHERE categoria = '" . $oportunidade['categoria'] . "' AND tipo_personalidade = '" . $oportunidade['tipo_personalidade'] . "' LIMIT $limit");

          echo '
          <div class="oportunidades-parecidas">
            <h2>Se você gostou disso, também pode gostar de...</h2>
            <span>';
          while ($oportunidadeSemelhante = $oportunidadesSemelhantes->fetch_assoc()) {
            echo '
            <a href="oportunidade.php?id=' . $oportunidadeSemelhante['ID_oportunidade'] . '" class="text-decoration-none">
              <div class="op-parecidas-item">
                <img src="' . $oportunidadeSemelhante['imagem'] . '" alt="">
                <p>' . $oportunidadeSemelhante['titulo'] . '</p>
              </div>
            </a>';
          }
          echo '
            </span>
          </div>';
        }
        ?>
      </div>
    </div>
  </main>

  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

  <script src="../../public/script.js"></script>

</body>

</html>