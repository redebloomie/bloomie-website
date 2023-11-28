<?php
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');

// Configurações de paginação para oportunidades Estágio
$porPagina = 9; // 3x3
$paginaAtualEstagio = isset($_GET['pagina_estagio']) ? $_GET['pagina_estagio'] : 1;
$offsetEstagio = ($paginaAtualEstagio - 1) * $porPagina;

// Consulta para obter oportunidades Estágio com paginação
$queryEstagio = "SELECT * FROM oportunidade WHERE categoria = 'Estágio' LIMIT $offsetEstagio, $porPagina";
$resultEstagio = mysqli_query($conexao, $queryEstagio);

// Consulta para obter o número total de oportunidades Estágio
$totalQueryEstagio = "SELECT COUNT(*) as total FROM oportunidade WHERE categoria = 'Estágio'";
$totalResultEstagio = mysqli_query($conexao, $totalQueryEstagio);
$totalEstagio = mysqli_fetch_assoc($totalResultEstagio)['total'];

// Calcular o número total de páginas para oportunidades Estágio
$numPaginasEstagio = ceil($totalEstagio / $porPagina);

// Fechar a conexão
mysqli_close($conexao);
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
    <a class="navbar-brand" href="#"><img src="../assets/logoBloomie-blu.png" alt="" width="150px"></a>
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
                  <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">Dasboard</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-user"></i>
                  <a href="../pages/perfil.html" class="text-decoration-none text-white">Oportunidades</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-bell-ringing"></i>
                  <a href="" class="text-decoration-none text-white">Postagens</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-gear"></i>
                  <a href="" class="text-decoration-none text-white">Usuários</a>
                </div>
              </div>
            </div>
            <div class="col">
              <a href="" class="text-decoration-none text-white">Sair</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-10 d-flex justify-content-center d-flex flex-column perfil-pg"
        style="margin-top: 5.5vw; margin-left: 20vw; width: 75vw;">
        
          <h2 class="mb-3 txtj text-primary">Usuários</h2>
          <div class="input-group rounded" style="width:20vw;">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
              <i class="fas fa-search"></i>
            </span>
          </div>
          <div class="col-md-12 d-flex justify-content-between ">
          
      </div>

    <!-- Navegação de página no topo do conteúdo -->
    <nav aria-label="Page navigation example mb-3" style="margin-top:30px">
        <ul class="pagination">
        <?php
            // Lógica para exibir os números da página para oportunidades de Estágios
            $maxPaginas = 4; // Número máximo de páginas a serem exibidas
            $inicio = max(1, $paginaAtualEstagio - floor($maxPaginas / 2));
            $fim = min($inicio + $maxPaginas - 1, $numPaginasEstagio);

            // Exibir o botão "<" se houver mais páginas antes para oportunidades de Estágio
            if ($inicio > 1) {
              echo '<li class="page-item">';
              echo '<a class="page-link" href="?pagina_estagio=' . ($inicio - 1) . '">&laquo;</a>';
              echo '</li>';
            }

            // Exibir os números da página para oportunidades de Estágio
            for ($i = $inicio; $i <= $fim; $i++) {
              echo '<li class="page-item ' . ($i == $paginaAtualEstagio ? 'active' : '') . '">';
              echo '<a class="page-link" href="?pagina_estagio=' . $i . '">' . $i . '</a>';
              echo '</li>';
            }

            // Exibir o botão ">" se houver mais páginas depois para oportunidades de Estágio
            if ($fim < $numPaginasEstagio) {
              echo '<li class="page-item">';
              echo '<a class="page-link" href="?pagina_estagio=' . ($fim + 1) . '">&raquo;</a>';
              echo '</li>';
            }
            ?>
        </ul>
    </nav>

    <div class="border border-primary p-3 rounded-5 mb-5 feedExp">
    <!-- Exibir oportunidades de Estágio -->
    <?php
          while ($oportunidade = mysqli_fetch_assoc($resultEstagio)) {
            echo '
            <div class="oportunidade-container">
              <div class="oportunidade-foto">
                <img src="' . $oportunidade['imagem'] . '" alt="">
              </div>
              <div class="oportunidade-info">
                <h2>' . $oportunidade['titulo'] . '</h2>
                <p>' . $oportunidade['descricao'] . '</p>
                <a href="visualizar_oportunidade.php?id=' . $oportunidade['ID_oportunidade'] . '" class="btn btn-primary col-12">Acessar oportunidade</a>
              </div>
            </div>';
          }
          ?>
    </div>
            
  </main>

  <footer>
    <!-- place footer here -->
  </footer>

  <script>
    function atualizarStatus(ID_oportunidade, acao) {
    // Crie um objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configurar a solicitação AJAX
    xhr.open('POST', 'atualizar_status.php', true);
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
    var dados = 'ID_oportunidade=' + ID_oportunidade + '&acao=' + acao;

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
  
  <script src="../pages/tags.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html> 