<?php
session_start();
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');
$idUsuario = $_SESSION['ID_usuario'];

// Configurações de paginação para oportunidades pendentes
$porPagina = 8;
$paginaAtualPendentes = isset($_GET['pagina_pendentes']) ? $_GET['pagina_pendentes'] : 1;
$offsetPendentes = ($paginaAtualPendentes - 1) * $porPagina;

// Filtrar por categoria se estiver presente na URL
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Mapear os parâmetros de categoria para valores específicos
$mapaCategorias = array(
    'estagios' => 'Estágios',
    'aprendizado' => 'Aprendizados',
    'voluntariado' => 'Voluntariado',
    'conc_comp' => 'Concursos e competições',
    'bolsas_estudo' => 'Bolsas de estudo'
);

// Verificar se a categoria fornecida está no mapa
if (array_key_exists($categoria, $mapaCategorias)) {
    // Usar a categoria correspondente ao valor no mapa
    $categoria = $mapaCategorias[$categoria];
} else {
    // Se a categoria não estiver no mapa, usar uma categoria padrão (pode ajustar conforme necessário)
    $categoria = 'Estágios';
}

// Atualizar a consulta SQL
$queryPendentes = "SELECT * FROM oportunidade WHERE categoria = '$categoria'";

$resultPendentes = mysqli_query($conexao, $queryPendentes);

// Consulta para obter o número total de oportunidades pendentes com filtro por categoria
$totalQueryPendentes = "SELECT COUNT(*) as total FROM oportunidade WHERE categoria = '$categoria'";
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

  <title>Categoria</title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
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

  <nav class="navbar navbar-expand-sm navbar-dark bg-white" id="nav-principal">
    <a class="navbar-brand" href="homepage-postagens.php" style="display: block"><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"></a>
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
                  <i class="ph ph-bell"></i>
                  <a href="notificacoesGeral.php" class="text-decoration-none text-white">Notificações</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-user"></i>
                  <a href="../pages/enviarOportunidade.html" class="text-decoration-none text-white">Enviar<br>oportunidades</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-bell-ringing"></i>
                  <a href="configuracoes.php" class="text-decoration-none text-white">Configurações</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-gear"></i>
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
      <div class="col-2 d-sm-none d-md-block d-lg-block d-xs-block menu-resp" style="height: 40vh;"></div>

      <section class="  container col-12 col-md-10 col-lg-10   " style="padding-top: 5rem; padding-left: 2rem;">
        <div class="d-flex mb-4 align-content-center ">
            <h4 class="txtT"><?php echo $categoria ?></h4>        
        </div>
        <div class="search-input-container col-12 mb-5">
          <span class="search-icon"><i class="fas fa-search"></i></span>
          <input type="text" class="search-input  form-control rounded-4" style="border-color: #1185e3" placeholder="Buscar...">
        </div>
        <div>
        </div>
        
        <div class="border border-primary rounded-4 p-3 mb-10">
          <?php

            // Verifica se há resultados
            if (mysqli_num_rows($resultPendentes) > 0) {
                $rowCount = 0;
                while ($row = mysqli_fetch_assoc($resultPendentes)) {
                    // Exiba as informações da oportunidade pendente
                    echo '
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center col-8 col-sm-6 col-md-6  ">
                      <img src="'.$row['imagem'].'" class="bg-black rounded-5 col-4 " style="width: 50px; height: 50px; object-fit: cover;">
                      <div class="usudata">
                        <p class=" mb-0 h5 text mg">'. substr($row['descricao'], 0, 50) . (strlen($row['descricao']) > 50 ? '...' : '') .'</p>
                        
                      </div>
                    </div>
                    <div class="d-flex   col-2 col-sm-2 col-md-6  justify-content-end ">
                      
                      <a href="oportunidade.php?id=' . $row['ID_oportunidade'] . '" class="btn btn-primary bt1 rounded-4 h6 col-lg-3 col-sm-2 col-md-3 col-2 textb" style="height: 4vh;">Acessar</a>
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
                    echo 'Nenhuma oportunidade disponível.';
                }
          ?>
          
        </div>
        
        <div class="d-flex mb-5">

          </div>
          <div>


            
          </div>
          
        
        
            
      </section>

      <!-- Adicione isso ao seu HTML -->
    <nav class="bottom-tab bottom-navigation">
          <a
            href="homepage-oportunidades-nm.php"
            class="text-decoration-none"
          >
            <i class="ph ph-house"></i>
          </a>
          <a href="perfil.php" class="text-decoration-none">
            <i class="ph ph-user"></i>
          </a>
          <div class="bottom-tab-center">
            <div class="bottom-tab-center-inner" id="bottomTabCenter">
              <a href="enviarOportunidade.html">
                <i class="ph ph-plus-circle" id="plusIcon"></i>
              </a>
            </div>
          </div>

          <a href="notificacoesGeral.php" class="text-decoration-none">
            <i class="ph ph-bell"></i>
          </a>

          <a href="configuracoes.php" class="text-decoration-none">
            <i class="ph ph-gear"></i>
          </a>
        </nav>
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