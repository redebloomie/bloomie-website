<?php
session_start();
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');
$idUsuario = $_SESSION['ID_usuario'];

// Configurações de paginação para oportunidades pendentes
$porPagina = 4;
$paginaAtualPendentes = isset($_GET['pagina_pendentes']) ? $_GET['pagina_pendentes'] : 1;
$offsetPendentes = ($paginaAtualPendentes - 1) * $porPagina;

// Consulta para obter oportunidades pendentes com paginação
$queryPendentes = "SELECT * FROM bloomizade WHERE usuario_id_2 = $idUsuario";
$resultPendentes = mysqli_query($conexao, $queryPendentes);

$queryBloomigo = "
    SELECT u.* 
    FROM usuario u
    JOIN bloomizade s ON u.ID_usuario = s.usuario_id_1
    WHERE s.usuario_id_2 = $idUsuario;
";

$resultBloomigo = mysqli_query($conexao, $queryBloomigo);

// Consulta para obter o número total de oportunidades pendentes
$totalQueryPendentes = "SELECT COUNT(*) as total FROM bloomizade WHERE usuario_id_2 = $idUsuario";
$totalResultPendentes = mysqli_query($conexao, $totalQueryPendentes);
$totalPendentes = mysqli_fetch_assoc($totalResultPendentes)['total'];

// Calcular o número total de páginas para oportunidades pendentes
$numPaginasPendentes = ceil($totalPendentes / $porPagina);

// Fechar a conexão
mysqli_close($conexao);
?>

<!doctype html>

<html lang="en">

<head>

  <title>Notificações Solicitação</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">



  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.css'>



  <link rel="stylesheet" href="../../public/style.css">

  <link rel="shortcut icon" href="/src/assets/bluBloomie.png" />



  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <script src="https://kit.fontawesome.com/fec6e5d711.js" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</head>



<body id="homepage">

  <nav class="navbar navbar-expand-sm navbar-dark bg-white">

    <a class="navbar-brand" href="#"><img src="/src/assets/logoBloomie-blu.png" alt="" width="150px"></a>

    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
      aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>

    <div class="collapse navbar-collapse" id="collapsibleNavId">

      <ul class="navbar-nav me-auto mt-2 mt-lg-0">



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

                  <a href="" class="text-decoration-none text-white">Home</a>

                </div>

                <div class="col text-white sidebar-op">

                  <i class="ph ph-user"></i>

                  <a href="" class="text-decoration-none text-white">Perfil</a>

                </div>

                <div class="col text-white sidebar-op">

                  <i class="ph ph-bell-ringing"></i>

                  <a href="" class="text-decoration-none text-white">Notificações</a>

                </div>

                <div class="col text-white sidebar-op">

                  <i class="ph ph-plant"></i>

                  <a href="" class="text-decoration-none text-white">Enviar<br>oportunidades</a>

                </div>

                <div class="col text-white sidebar-op">

                  <i class="ph ph-gear"></i>

                  <a href="" class="text-decoration-none text-white">Configurações</a>

                </div>

                <div class="col text-white sidebar-op">

                  <i class="ph ph-question"></i>

                  <a href="" class="text-decoration-none text-white">Ajuda & suporte</a>

                </div>

              </div>

            </div>

            <div class="col">

              <a href="" class="text-decoration-none text-white">Sair</a>

            </div>

          </div>

        </div>

      </div>
      <div class="col-2 " ></div>

      <section class="container col-12 col-md-10 col-lg-10" style="padding-top: 5rem;">
        <div class="row">
          <ul class="nav nav-pills col-12 col-md-10 col-lg-9">
            <li class="nav-item col-4 col-md-4">
              <a class="nav-link p-4 rounded-0  textlink"  href="./notificacoesGeral.html">Geral</a>
            </li>
            <li class="nav-item col-4 col-md-4">
              <a class="nav-link rounded-0 p-4 sombralink2 textlink" style="background-color: rgba(8, 158, 228, 0.3); " aria-current="page" href="./notificacoesSolicitacao.html">Solicitação</a>
            </li>
            <li class="nav-item col-4 col-md-4">
              <a class="nav-link p-4 textlink" href="./notificacoesPendente.html">Pendente</a>
            </li>
          </ul>
        </div>
      
        <div class="row">
          <div class="col-12 col-lg-9 pb-5">
            <div class="bg-primary " style="height: 1px;"></div>
          </div>
        </div>
      
        <?php

          // Verifica se há resultados
          if (mysqli_num_rows($resultBloomigo) > 0) {
              $rowCount = 0;
              while ($row = mysqli_fetch_assoc($resultBloomigo)) {
                  // Exiba as informações da oportunidade pendente
                  echo '
                
              
                <div class="d-flex justify-content-between align-items-center ">
                  <div class="d-flex align-items-center col-8 col-sm-6 col-md-6  ">
                    <img src="'.$row["foto_perfil"].'" class=" rounded-5 col-4 " style="width: 50px; height: 50px; object-fit: cover;">
                    <div class="usudata">
                      <p class=" mb-0 h5 text mg  " >'.$row["nome"].'</p>
                      <p class=" mb-0 h5 text mg  " >@'.$row["usuario"].'</p>
                      <p id="data" class="mb-0 text mg  " style=" color: #5AB5FF;">'.$row["data_criacao"].'</p>
                    </div>
                  </div>
                  <div class="d-flex   col-2 col-sm-2 col-md-6  justify-content-end ">
                    
                    <button class="btn btn-success bt1 rounded-3 h6 col-lg-3 col-sm-2 col-md-3 col-2 textb " onclick="atualizarStatus(' . $row['ID_usuario'] . ', \'aceito\')>Aceitar</button>
                  </div>
                </div>
                <div class="bg-primary col-12 mt-3 mb-3" style="height: 1px;"></div>
                  ';
                  $rowCount++;
              }
              } else {
                  echo 'Nenhuma oportunidade pendente.';
              }
          ?>
      </section>
      
      <div class="bottom-navigation">
        <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">
          <i class="ph ph-house"></i>
        </a>
        <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">
          <img src="../assets/bluBloomie.png" alt="" style="width: 5vw;">
        </a>
        <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">
          <i class="ph ph-plus"></i>
        </a>
        <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">
          <i class="ph ph-bell"></i>
        </a>
        <a href="../pages/perfil.html" class="text-decoration-none text-white">
          <i class="ph ph-user"></i>
        </a>
</div>
  </main>





  <footer>

    <!-- place footer here -->

  </footer>

  <script>
    function atualizarStatus(usuario_id_1, acao) {
    // Crie um objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configurar a solicitação AJAX
    xhr.open('POST', 'atualizar_soli.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Configurar a função de retorno de chamada
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // A resposta do servidor está disponível aqui
            console.log(xhr.responseText);

            // Atualizar a interface do usuário conforme necessário
            // (por exemplo, esconder o item, atualizar o status, etc.)

            // Recarregar a página para refletir as alterações
            location.reload();
        }
    };

    // Preparar os dados a serem enviados
    var dados = 'usuario_id_1=' + usuario_id_1 +  '&acao=' + acao;

    // Enviar a solicitação AJAX com os dados
    xhr.send(dados);
}


  </script>

  <!-- Bootstrap JavaScript Libraries -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">

    </script>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">

    </script>



  <script src="/public/script.js"></script>



</body>



</html>