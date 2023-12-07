<?php
session_start();
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');
$idUsuario = $_SESSION['ID_usuario'];

// Configurações de paginação para oportunidades pendentes
$porPagina = 8;
$paginaAtualPendentes = isset($_GET['pagina_pendentes']) ? $_GET['pagina_pendentes'] : 1;
$offsetPendentes = ($paginaAtualPendentes - 1) * $porPagina;

// Consulta para obter oportunidades pendentes com paginação
$queryPendentes = "SELECT * FROM post LIMIT $offsetPendentes, $porPagina";
$resultPendentes = mysqli_query($conexao, $queryPendentes);

// Consulta para obter o número total de oportunidades pendentes
$totalQueryPendentes = "SELECT COUNT(*) as total FROM post";
$totalResultPendentes = mysqli_query($conexao, $totalQueryPendentes);
$totalPendentes = mysqli_fetch_assoc($totalResultPendentes)['total'];

// Calcular o número total de páginas para oportunidades pendentes
$numPaginasPendentes = ceil($totalPendentes / $porPagina);

// --------------------------------------------------------------------------------------------------

$porPagina = 1;
$paginaAtualExcluidos = isset($_GET['pagina_excluidos']) ? $_GET['pagina_excluidos'] : 1;
$offsetExcluidos = ($paginaAtualExcluidos - 1) * $porPagina;

// Consulta para obter posts excluídos com todas as informações do usuário
$queryPostsExcluidos = "SELECT pe.*, u.* FROM posts_excluidos pe
                        JOIN usuario u ON pe.ID_usuario = u.ID_usuario
                        ORDER BY pe.data_exclusao DESC
                        LIMIT $offsetExcluidos, $porPagina";

$resultPostsExcluidos = mysqli_query($conexao, $queryPostsExcluidos);

// Consulta para obter o número total de posts excluídos
$totalQueryPostsExcluidos = "SELECT COUNT(*) as total FROM posts_excluidos";
$totalResultPostsExcluidos = mysqli_query($conexao, $totalQueryPostsExcluidos);
$totalPostsExcluidos = mysqli_fetch_assoc($totalResultPostsExcluidos)['total'];

// Calcular o número total de páginas para posts excluídos
$numPaginasExcluidos = ceil($totalPostsExcluidos / $porPagina);

// --------------------------------------------------------------------------------------------------

$porPagina = 1;
$paginaAtualBanidos = isset($_GET['pagina_banidos']) ? $_GET['pagina_banidos'] : 1;
$offsetBanidos = ($paginaAtualBanidos - 1) * $porPagina;

// Consulta para obter posts excluídos com todas as informações do usuário
$queryPostsBanidos = "SELECT pe.*, u.* FROM posts_banidos pe
                        JOIN usuario u ON pe.ID_usuario = u.ID_usuario
                        ORDER BY pe.data_banimento DESC
                        LIMIT $offsetBanidos, $porPagina";

$resultPostsBanidos = mysqli_query($conexao, $queryPostsBanidos);

// Consulta para obter o número total de posts excluídos
$totalQueryPostsBanidos = "SELECT COUNT(*) as total FROM posts_banidos";
$totalResultPostsBanidos = mysqli_query($conexao, $totalQueryPostsBanidos);
$totalPostsBanidos = mysqli_fetch_assoc($totalResultPostsBanidos)['total'];

// Calcular o número total de páginas para posts excluídos
$numPaginasBanidos = ceil($totalPostsBanidos / $porPagina);


// Fechar a conexão
mysqli_close($conexao);
?>

<!doctype html>

<html lang="en">

<head>

  <title>Excluir erro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">



  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.css'>



  <link rel="stylesheet" href="../../public/style.css">

  <link rel="shortcut icon" href="../assets/bluBloomie.png" />



  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <script src="https://kit.fontawesome.com/fec6e5d711.js" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</head>



<body id="">

  <nav class="navbar navbar-expand-sm navbar-dark bg-white">

    <a class="navbar-brand" href="adm.php"><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"></a>

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
                  <a href="adm.php" class="text-decoration-none text-white">Dasboard</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-user"></i>
                  <a href="adm_oportunidade.php" class="text-decoration-none text-white">Oportunidades</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-bell-ringing"></i>
                  <a href="adm_postagens.php" class="text-decoration-none text-white">Postagens</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-gear"></i>
                  <a href="adm_usuarios.php" class="text-decoration-none text-white">Usuários</a>
                </div>
              </div>
            </div>
            <div class="col">
              <a href="sair.php" class="text-decoration-none text-white">Sair</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-2  " style="height: 40vh;"></div>

      <section class="  container col-12 col-md-10 col-lg-10   " style="padding-top: 5rem; padding-left: 2rem;">
        <div class="d-flex mb-4 align-content-center ">
            <h4 class="txtT">Postagens</h4>
            <div class="dropdown mb-0 m-0 mx-3 ">
              <a class="btn  dropdown-toggle rounded-5 d-flex justify-content-center  " href="#" style="opacity: 100%; background-color: #88C2F1; height: 4vh;" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="txtT h6  ">Filtra por</span>
              </a>
            
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </div>
            
        </div>
        <div class="search-input-container col-12 mb-5">
          <span class="search-icon"><i class="fas fa-search"></i></span>
          <input type="text" class="search-input  form-control rounded-4" style="border-color: #1185e3" placeholder="Buscar...">
        </div>
        <div>
          <nav aria-label="Page navigation example mb-3">
            <ul class="pagination">
            <?php
              // Lógica para exibir os números da página para oportunidades pendentes
              $maxPaginas = 4; // Número máximo de páginas a serem exibidas
              $inicio = max(1, $paginaAtualPendentes - floor($maxPaginas / 2));
              $fim = min($inicio + $maxPaginas - 1, $numPaginasPendentes);

              // Exibir o botão "<" se houver mais páginas antes para oportunidades pendentes
              if ($inicio > 1) {
                  echo '<li class="page-item">';
                  echo '<a class="page-link" href="?pagina_pendentes=' . ($inicio - 1) . '">&laquo;</a>';
                  echo '</li>';
              }

              // Exibir os números da página para oportunidades pendentes
              for ($i = $inicio; $i <= $fim; $i++) {
                  echo '<li class="page-item ' . ($i == $paginaAtualPendentes ? 'active' : '') . '">';
                  echo '<a class="page-link" href="?pagina_pendentes=' . $i . '">' . $i . '</a>';
                  echo '</li>';
              }

              // Exibir o botão ">" se houver mais páginas depois para oportunidades pendentes
              if ($fim < $numPaginasPendentes) {
                  echo '<li class="page-item">';
                  echo '<a class="page-link" href="?pagina_pendentes=' . ($fim + 1) . '">&raquo;</a>';
                  echo '</li>';
              }
            ?>
            </ul>
          </nav>
        </div>
        
        <div class="border border-primary rounded-4 p-3 mb-5">
          <?php

            // Verifica se há resultados
            if (mysqli_num_rows($resultPendentes) > 0) {
                $rowCount = 0;
                while ($row = mysqli_fetch_assoc($resultPendentes)) {
                    // Exiba as informações da oportunidade pendente
                    echo '
                    <div class="d-flex justify-content-between align-items-center ">
                    <div class="d-flex align-items-center col-8 col-sm-6 col-md-6  ">
                      <div class="bg-black rounded-5 col-4 " style="width: 50px; height: 50px;"></div>
                      <div class="usudata">
                        <p class=" mb-0 h5 text mg">'. substr($row['texto'], 0, 20) . (strlen($row['texto']) > 20 ? '...' : '') .'</p>
                        
                      </div>
                    </div>
                    <div class="d-flex   col-2 col-sm-2 col-md-6  justify-content-end ">
                      
                      <a href="adm_banir_post.php?id=' . $row['ID_post'] . '" class="btn btn-danger bt1 rounded-4 h6 col-lg-3 col-sm-2 col-md-3 col-2 textb" style="height: 4vh;">Banir</a>
                      <a href="adm_excluir_post.php?id=' . $row['ID_post'] . '" class="btn btn-danger bt1 rounded-4 h6 col-lg-3 col-sm-2 col-md-3 col-2 textb" style="height: 4vh;">Apagar</a>
                    </div>
                    </div>
                    
                    ';
                    // Adicione a linha separadora, exceto para a última oportunidade
                    if ($rowCount < mysqli_num_rows($resultPendentes) - 1) {
                        echo '<div class=" bg-primary col-12  mt-3 mb-3" style="height: 1px;"></div>';
                    }

                    $rowCount++;
                }
                } else {
                    echo 'Nenhuma postagem disponível.';
                }
          ?>
          
        </div>
        
        <div class="d-flex mb-5">
            <h4 class="txtT">Banidos</h4>
            <div class="dropdown mb-0 m-0 mx-3 ">
              <a class="btn  dropdown-toggle rounded-5 d-flex justify-content-center  " href="#" style="opacity: 100%; background-color: #88C2F1; height: 4vh;" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="txtT h6 text-center ">Filtra por</span>
              </a>
            
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </div>
            
          </div>
          <div>
            <div class="search-input-container col-12 mb-5">
              <span class="search-icon"><i class="fas fa-search"></i></span>
              <input type="text" class="search-input  form-control rounded-4" style="border-color: #1185e3" placeholder="Buscar...">
            </div>
            <nav aria-label="Page navigation example mb-3">
              <ul class="pagination">
                <?php
                  // Lógica para exibir os números da página para oportunidades pendentes
                  $maxPaginas = 4; // Número máximo de páginas a serem exibidas
                  $inicio = max(1, $paginaAtualBanidos - floor($maxPaginas / 2));
                  $fim = min($inicio + $maxPaginas - 1, $numPaginasBanidos);

                  // Exibir o botão "<" se houver mais páginas antes para oportunidades pendentes
                  if ($inicio > 1) {
                      echo '<li class="page-item">';
                      echo '<a class="page-link" href="?pagina_banidos=' . ($inicio - 1) . '">&laquo;</a>';
                      echo '</li>';
                  }

                  // Exibir os números da página para oportunidades pendentes
                  for ($i = $inicio; $i <= $fim; $i++) {
                      echo '<li class="page-item ' . ($i == $paginaAtualBanidos ? 'active' : '') . '">';
                      echo '<a class="page-link" href="?pagina_banidos=' . $i . '">' . $i . '</a>';
                      echo '</li>';
                  }

                  // Exibir o botão ">" se houver mais páginas depois para oportunidades pendentes
                  if ($fim < $numPaginasBanidos) {
                      echo '<li class="page-item">';
                      echo '<a class="page-link" href="?pagina_banidos=' . ($fim + 1) . '">&raquo;</a>';
                      echo '</li>';
                  }
                ?>
              </ul>
            </nav>
          </div>
          
            <div class="col-md-11 border border-primary rounded-4 p-3 mb-5" style="overflow:hidden;">
              <?php
                // Verifica se há resultados
                if (mysqli_num_rows($resultPostsBanidos) > 0) {
                    $rowCount = 0;
                    while ($row = mysqli_fetch_assoc($resultPostsBanidos)) {
                        // Exiba as informações da oportunidade pendente
                        echo '
                        <div class="d-flex align-items-center col-6 col-md-10 mb-4">
                            <img src="' . $row['foto_perfil'] . '" class="bg-black rounded-5 col-4" style="width: 50px; height: 50px;">
                            <p class="mb-0 h5 text-primary" style="margin-left: 1vw;">' . $row['nome'] . '</p>
                            <p class="mb-0 h6 text-primary" style="margin-left: 1vw; font-weight:400">@' . $row['usuario'] . '</p>
                        </div>
                        <div class="d-flex align-items-center col-6 col-md-12 mb-4">
                            <p class="mb-0 h5 text-primary" style="margin: 0; font-weight:400; word-wrap: break-word; max-width: 100%;">"' . $row['texto'] . '"</p>
                        </div>';
                        
                        // Verifique se há uma imagem no post
                        if (!empty($row['imagem'])) {
                            echo '
                                <div class="d-flex align-items-center col-12 col-md-12 mb-4">
                                    <div class="d-flex linha col-12">
                                        <img class="txtj mb-0" style="height:15vw; width: 30vw; object-fit: cover; border-radius: 20px" src="' . $row['imagem'] . '">
                                    </div>
                                </div>
                            ';
                        }
                        echo '<p class="txtj">Data de exclusão:</p>
                        <div class="col-12 col-md-12 col-lg-3 mb-4">
                            <p class="form-control rounded-4" id="" style="border-color: #1185e3;">' . $row['data_banimento'] . '</p>
                        </div>
                        <p class="txtj">Motivo:</p>
                        <div class="form-group mb-5">
                          
                          <p class="form-control " id="" style="border-color: #1185e3; resize: none;"  rows="4">'.$row['motivo'].'</p>
                        </div>
                        ';
                        // Adicione a linha separadora, exceto para a última oportunidade
                        if ($rowCount < mysqli_num_rows($resultPostsBanidos) - 1) {
                            echo '<div class=" bg-primary col-12 mt-3 mb-3" style="height: 1px;"></div>';
                        }

                        $rowCount++;
                    }
                } else {
                    echo 'Nenhuma postagem disponível.';
                }
              ?>

            </div>

          <div class="d-flex mb-5">
            <h4 class="txtT">Deletados</h4>
            <div class="dropdown mb-0 m-0 mx-3 ">
              <a class="btn  dropdown-toggle rounded-5 d-flex justify-content-center  " href="#" style="opacity: 100%; background-color: #88C2F1; height: 4vh;" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="txtT h6 text-center ">Filtra por</span>
              </a>
            
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </div>
            
          </div>
          <div>
            <div class="search-input-container col-12 mb-5">
              <span class="search-icon"><i class="fas fa-search"></i></span>
              <input type="text" class="search-input  form-control rounded-4" style="border-color: #1185e3" placeholder="Buscar...">
            </div>
            <nav aria-label="Page navigation example mb-3">
              <ul class="pagination">
                <?php
                  // Lógica para exibir os números da página para oportunidades pendentes
                  $maxPaginas = 4; // Número máximo de páginas a serem exibidas
                  $inicio = max(1, $paginaAtualExcluidos - floor($maxPaginas / 2));
                  $fim = min($inicio + $maxPaginas - 1, $numPaginasExcluidos);

                  // Exibir o botão "<" se houver mais páginas antes para oportunidades pendentes
                  if ($inicio > 1) {
                      echo '<li class="page-item">';
                      echo '<a class="page-link" href="?pagina_excluidos=' . ($inicio - 1) . '">&laquo;</a>';
                      echo '</li>';
                  }

                  // Exibir os números da página para oportunidades pendentes
                  for ($i = $inicio; $i <= $fim; $i++) {
                      echo '<li class="page-item ' . ($i == $paginaAtualExcluidos ? 'active' : '') . '">';
                      echo '<a class="page-link" href="?pagina_excluidos=' . $i . '">' . $i . '</a>';
                      echo '</li>';
                  }

                  // Exibir o botão ">" se houver mais páginas depois para oportunidades pendentes
                  if ($fim < $numPaginasExcluidos) {
                      echo '<li class="page-item">';
                      echo '<a class="page-link" href="?pagina_excluidos=' . ($fim + 1) . '">&raquo;</a>';
                      echo '</li>';
                  }
                ?>
              </ul>
            </nav>
          </div>
          
            <div class="col-md-11 border border-primary rounded-4 p-3 mb-5" style="overflow:hidden;">
              <?php
                // Verifica se há resultados
                if (mysqli_num_rows($resultPostsExcluidos) > 0) {
                    $rowCount = 0;
                    while ($row = mysqli_fetch_assoc($resultPostsExcluidos)) {
                        // Exiba as informações da oportunidade pendente
                        echo '
                        <div class="d-flex align-items-center col-6 col-md-10 mb-4">
                            <img src="' . $row['foto_perfil'] . '" class="bg-black rounded-5 col-4" style="width: 50px; height: 50px;">
                            <p class="mb-0 h5 text-primary" style="margin-left: 1vw;">' . $row['nome'] . '</p>
                            <p class="mb-0 h6 text-primary" style="margin-left: 1vw; font-weight:400">@' . $row['usuario'] . '</p>
                        </div>
                        <div class="d-flex align-items-center col-6 col-md-12 mb-4">
                            <p class="mb-0 h5 text-primary" style="margin: 0; font-weight:400; word-wrap: break-word; max-width: 100%;">"' . $row['texto'] . '"</p>
                        </div>';
                        
                        // Verifique se há uma imagem no post
                        if (!empty($row['imagem'])) {
                            echo '
                                <div class="d-flex align-items-center col-12 col-md-12 mb-4">
                                    <div class="d-flex linha col-12">
                                        <img class="txtj mb-0" style="height:15vw; width: 30vw; object-fit: cover; border-radius: 20px" src="' . $row['imagem'] . '">
                                    </div>
                                </div>
                            ';
                        }
                        echo '<p class="txtj">Data de exclusão:</p>
                        <div class="col-12 col-md-12 col-lg-3 mb-4">
                            <p class="form-control rounded-4" id="" style="border-color: #1185e3;">' . $row['data_exclusao'] . '</p>
                        </div>
                        <p class="txtj">Motivo:</p>
                        <div class="form-group mb-5">
                          
                          <p class="form-control " id="" style="border-color: #1185e3; resize: none;"  rows="4">'.$row['motivo'].'</p>
                        </div>
                        ';
                        // Adicione a linha separadora, exceto para a última oportunidade
                        if ($rowCount < mysqli_num_rows($resultPostsExcluidos) - 1) {
                            echo '<div class=" bg-primary col-12 mt-3 mb-3" style="height: 1px;"></div>';
                        }

                        $rowCount++;
                    }
                } else {
                    echo 'Nenhuma postagem disponível.';
                }
              ?>

            </div>
          
        
        
            
      </section>
  </main>

  <footer>

    <!-- place footer here -->

  </footer>

  <script>
    function atualizarStatus(ID_post) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'adm_excluirPost.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
              var responseData = JSON.parse(xhr.responseText);
              console.log(responseData.response);
              location.reload();
          }
      };
      var dados = 'ID_post=' + ID_post;
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



  <script src="../../public/script.js"></script>



</body>



</html>