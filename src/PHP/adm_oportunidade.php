<?php
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');

// Configurações de paginação para oportunidades pendentes
$porPagina = 4;
$paginaAtualPendentes = isset($_GET['pagina_pendentes']) ? $_GET['pagina_pendentes'] : 1;
$offsetPendentes = ($paginaAtualPendentes - 1) * $porPagina;

// Consulta para obter oportunidades pendentes com paginação
$queryPendentes = "SELECT * FROM oportunidade WHERE status_opor = 'pendente' LIMIT $offsetPendentes, $porPagina";
$resultPendentes = mysqli_query($conexao, $queryPendentes);

// Consulta para obter o número total de oportunidades pendentes
$totalQueryPendentes = "SELECT COUNT(*) as total FROM oportunidade WHERE status_opor = 'pendente'";
$totalResultPendentes = mysqli_query($conexao, $totalQueryPendentes);
$totalPendentes = mysqli_fetch_assoc($totalResultPendentes)['total'];

// Calcular o número total de páginas para oportunidades pendentes
$numPaginasPendentes = ceil($totalPendentes / $porPagina);

// --------------------------------------------------------------------------------------------------

// Configurações de paginação para oportunidades expiradas
$porPagina = 4;
$paginaAtualExpiradas = isset($_GET['pagina_expiradas']) ? $_GET['pagina_expiradas'] : 1;
$offsetExpiradas = ($paginaAtualExpiradas - 1) * $porPagina;

// Consulta para obter oportunidades expiradas com paginação
$queryExpiradas = "SELECT * FROM oportunidade WHERE status_opor = 'expirada' LIMIT $offsetExpiradas, $porPagina";
$resultExpiradas = mysqli_query($conexao, $queryExpiradas);

// Consulta para obter o número total de oportunidades expiradas
$totalQueryExpiradas = "SELECT COUNT(*) as total FROM oportunidade WHERE status_opor = 'expirada'";
$totalResultExpiradas = mysqli_query($conexao, $totalQueryExpiradas);
$totalExpiradas = mysqli_fetch_assoc($totalResultExpiradas)['total'];

// Calcular o número total de páginas para oportunidades expiradas
$numPaginasExpiradas = ceil($totalExpiradas / $porPagina);

// ---------------------------------------------------------------------------------------------------

// Configurações de paginação para oportunidades Aceitas
$porPagina = 4;
$paginaAtualAceitas = isset($_GET['pagina_Aceitas']) ? $_GET['pagina_Aceitas'] : 1;
$offsetAceitas = ($paginaAtualAceitas - 1) * $porPagina;

// Consulta para obter oportunidades Aceitas com paginação
$queryAceitas = "SELECT * FROM oportunidade WHERE status_opor = 'aceita' LIMIT $offsetAceitas, $porPagina";
$resultAceitas = mysqli_query($conexao, $queryAceitas);

// Consulta para obter o número total de oportunidades Aceitas
$totalQueryAceitas = "SELECT COUNT(*) as total FROM oportunidade WHERE status_opor = 'aceita'";
$totalResultAceitas = mysqli_query($conexao, $totalQueryAceitas);
$totalAceitas = mysqli_fetch_assoc($totalResultAceitas)['total'];

// Calcular o número total de páginas para oportunidades Aceitas
$numPaginasAceitas = ceil($totalAceitas / $porPagina);

// ---------------------------------------------------------------------------------------------

// Configurações de paginação para oportunidades Negadas
$porPagina = 4;
$paginaAtualNegadas = isset($_GET['pagina_negadas']) ? $_GET['pagina_negadas'] : 1;
$offsetNegadas = ($paginaAtualNegadas - 1) * $porPagina;

// Consulta para obter oportunidades Negadas com paginação
$queryNegadas = "SELECT * FROM oportunidade WHERE status_opor = 'negada' LIMIT $offsetNegadas, $porPagina";
$resultNegadas = mysqli_query($conexao, $queryNegadas);

// Consulta para obter o número total de oportunidades Negadas
$totalQueryNegadas = "SELECT COUNT(*) as total FROM oportunidade WHERE status_opor = 'negada'";
$totalResultNegadas = mysqli_query($conexao, $totalQueryNegadas);
$totalNegadas = mysqli_fetch_assoc($totalResultNegadas)['total'];

// Calcular o número total de páginas para oportunidades Negadas
$numPaginasNegadas = ceil($totalNegadas / $porPagina);

// ----------------------------------------------------------------------------------------------

// Configurações de paginação para oportunidades Inativas
$porPagina = 4;
$paginaAtualInativas = isset($_GET['pagina_inativas']) ? $_GET['pagina_inativas'] : 1;
$offsetInativas = ($paginaAtualInativas - 1) * $porPagina;

// Consulta para obter oportunidades Inativas com paginação
$queryInativas = "SELECT * FROM oportunidades_inativas LIMIT $offsetInativas, $porPagina";
$resultInativas = mysqli_query($conexao, $queryInativas);

// Consulta para obter o número total de oportunidades Inativas
$totalQueryInativas = "SELECT COUNT(*) as total FROM oportunidades_inativas";
$totalResultInativas = mysqli_query($conexao, $totalQueryInativas);
$totalInativas = mysqli_fetch_assoc($totalResultInativas)['total'];

// Calcular o número total de páginas para oportunidades Inativas
$numPaginasInativas = ceil($totalInativas / $porPagina);

// Fechar a conexão
mysqli_close($conexao);
?>


<!doctype html>
<html lang="en">

<head>
  <title>Oportunidades</title>
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
    <a class="navbar-brand" href="adm.php"><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"></a>
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
                  <i class="ph ph-plant"></i>
                  <a href="adm_oportunidade.php" class="text-decoration-none text-white">Oportunidades</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-article"></i>
                  <a href="adm_postagens.php" class="text-decoration-none text-white">Postagens</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-user"></i>
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

      <div class="col-10 d-flex justify-content-center d-flex flex-column perfil-pg"
        style="margin-top: 5.5vw; margin-left: 20vw; width: 75vw;">
        
          <h2 class="mb-3 txtj text-primary">Oportunidade</h2>
          <div class="col-md-12 d-flex justify-content-between ">
            <div class="border border-primary col-md-2 rounded-4 text-center d-flex flex-column justify-content-center align-items-center" style="height: 30vh;">
              <p class="txtj">Pendentes</p>
              <span class="h1 txtT"><?php echo $totalPendentes; ?></span>
            </div>
            <div class="border border-primary col-md-2 rounded-4 text-center d-flex flex-column justify-content-center align-items-center" style="height: 30vh;">
              <p class="txtj text-success">Aceitas</p>
              <span class="h1 txtT"><?php echo $totalAceitas; ?></span>
            </div>
            <div class="border border-primary col-md-2 rounded-4 text-center d-flex flex-column justify-content-center align-items-center" style="height: 30vh;">
              <p class="txtj text-danger">Negadas</p>
              <span class="h1 txtT"><?php echo $totalNegadas; ?></span>
            </div>
            <div class="mb-4 border border-primary col-md-2 rounded-4 text-center d-flex flex-column justify-content-center align-items-center" style="height: 30vh;">
              <p class="txtj text-secondary">Inativas</p>
              <span class="h1 txtT"><?php echo $totalInativas; ?></span>
            </div>
      </div>
      <h5 class="mb-3 txtj ">Pendentes</h5>

    <!-- Navegação de página no topo do conteúdo -->
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

    <div class="border border-primary p-3 rounded-5 mb-5 feedExp">
    <?php
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');

// Verifica se há resultados
if (mysqli_num_rows($resultPendentes) > 0) {
    $rowCount = 0;
    while ($row = mysqli_fetch_assoc($resultPendentes)) {
        // Exiba as informações da oportunidade pendente
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<div class="d-flex align-items-center col-6">';
        echo '<a href="detalhes_oportunidade.php?id=' . $row['ID_oportunidade'] . '" class="link-oportunidade" style="display:flex;flex-direction:row;justify-content:center;align-items:center;">';
        echo '<img src="' . $row['imagem'] . '" class="bg-black rounded-5 col-4 " style="width: 4vw; height: 4vw; object-fit:cover;">';
        echo '<p class="mb-0 h5 text mg">' . $row['titulo'] . '</p>';
        echo '</a>';
        echo '</div>';
        echo '<div class="d-flex p-1 col-6 col-sm-4 col-md-6 justify-content-end">';
        echo '<button class="btn btn-success bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb" onclick="atualizarStatus(' . $row['ID_oportunidade'] . ', \'aceita\')">Aceitar</button>';
        echo '<button class="btn btn-danger bt1 rounded-3 h6 col-lg-2 col-sm-2 col-md-3 col-4 textb" onclick="atualizarStatus(' . $row['ID_oportunidade'] . ', \'negada\')">Negar</button>';
        echo '</div>';
        echo '</div>';
        // Adicione a linha separadora, exceto para a última oportunidade
        if ($rowCount < mysqli_num_rows($resultPendentes) - 1) {
            echo '<div class="bg-primary col-12 mt-3 mb-3" style="height: 1px;"></div>';
        }

        $rowCount++;
    }
    } else {
        echo 'Nenhuma oportunidade pendente.';
    }
    ?>
    </div>

      <h5 class="mb-3 txtj ">Aceitas</h5>

    <!-- Navegação de página no topo do conteúdo -->
    <nav aria-label="Page navigation example mb-3">
        <ul class="pagination">
        <?php
        // Lógica para exibir os números da página
        $maxPaginas = 4; // Número máximo de páginas a serem exibidas
        $inicio = max(1, $paginaAtualAceitas - floor($maxPaginas / 2));
        $fim = min($inicio + $maxPaginas - 1, $numPaginasAceitas);

        // Exibir o botão "<" se houver mais páginas antes
        if ($inicio > 1) {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="?pagina_aceitas=' . ($inicio - 1) . '">&laquo;</a>';
            echo '</li>';
        }

        // Exibir os números da página
        for ($i = $inicio; $i <= $fim; $i++) {
            echo '<li class="page-item ' . ($i == $paginaAtualAceitas ? 'active' : '') . '">';
            echo '<a class="page-link" href="?pagina_aceitas=' . $i . '">' . $i . '</a>';
            echo '</li>';
        }

        // Exibir o botão ">" se houver mais páginas depois
        if ($fim < $numPaginasAceitas) {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="?pagina_aceitas=' . ($fim + 1) . '">&raquo;</a>';
            echo '</li>';
        }
        ?>
        </ul>
    </nav>

    <div class="border border-primary p-3 rounded-5 mb-5 feedExp">
    <?php
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');

// Verifica se há resultados
if (mysqli_num_rows($resultAceitas) > 0) {
    $rowCount = 0;
    while ($row = mysqli_fetch_assoc($resultAceitas)) {
        // Exiba as informações da oportunidade pendente
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<div class="d-flex align-items-center col-6">';
        echo '<a href="detalhes_oportunidadeDesativar.php?id=' . $row['ID_oportunidade'] . '" class="link-oportunidade" style="display:flex;flex-direction:row;justify-content:center;align-items:center;">';
        echo '<img src="' . $row['imagem'] . '" class="bg-black rounded-5 col-4 " style="width: 4vw; height: 4vw; object-fit:cover;">';
        echo '<p class="mb-0 h5 text mg">' . $row['titulo'] . '</p>';
        echo '</a>';
        echo '</div>';
        echo '<div class="d-flex p-1 col-6 col-sm-4 col-md-6 justify-content-end">';
        echo '<button class="btn btn-danger bt1 rounded-3 h6 col-lg-2 col-sm-2 col-md-3 col-4 textb" onclick="atualizarStatus(' . $row['ID_oportunidade'] . ', \'desativar\')">Desativar</button>';
        echo '</div>';
        echo '</div>';
        // Adicione a linha separadora, exceto para a última oportunidade
        if ($rowCount < mysqli_num_rows($resultAceitas) - 1) {
            echo '<div class="bg-primary col-12 mt-3 mb-3" style="height: 1px;"></div>';
        }

        $rowCount++;
    }
    } else {
        echo 'Nenhuma oportunidade pendente.';
    }
    ?>
    </div>

      <h5 class="mb-3 txtj ">Negadas</h5>

    <!-- Navegação de página no topo do conteúdo -->
    <nav aria-label="Page navigation example mb-3">
        <ul class="pagination">
        <?php
        // Lógica para exibir os números da página
        $maxPaginas = 4; // Número máximo de páginas a serem exibidas
        $inicio = max(1, $paginaAtualNegadas - floor($maxPaginas / 2));
        $fim = min($inicio + $maxPaginas - 1, $numPaginasNegadas);

        // Exibir o botão "<" se houver mais páginas antes
        if ($inicio > 1) {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="?pagina_negadas=' . ($inicio - 1) . '">&laquo;</a>';
            echo '</li>';
        }

        // Exibir os números da página
        for ($i = $inicio; $i <= $fim; $i++) {
            echo '<li class="page-item ' . ($i == $paginaAtualNegadas ? 'active' : '') . '">';
            echo '<a class="page-link" href="?pagina_negadas=' . $i . '">' . $i . '</a>';
            echo '</li>';
        }

        // Exibir o botão ">" se houver mais páginas depois
        if ($fim < $numPaginasNegadas) {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="?pagina_negadas=' . ($fim + 1) . '">&raquo;</a>';
            echo '</li>';
        }
        ?>
        </ul>
    </nav>

    <div class="border border-primary p-3 rounded-5 mb-5 feedExp">
    <?php
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');

// Verifica se há resultados
if (mysqli_num_rows($resultNegadas) > 0) {
    $rowCount = 0;
    while ($row = mysqli_fetch_assoc($resultNegadas)) {
        // Exiba as informações da oportunidade pendente
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<div class="d-flex align-items-center col-6">';
        echo '<a href="detalhes_oportunidadeRevalidar.php?id=' . $row['ID_oportunidade'] . '" class="link-oportunidade" style="display:flex;flex-direction:row;justify-content:center;align-items:center;">';
        echo '<img src="' . $row['imagem'] . '" class="bg-black rounded-5 col-4 " style="width: 4vw; height: 4vw; object-fit:cover;">';
        echo '<p class="mb-0 h5 text mg">' . $row['titulo'] . '</p>';
        echo '</a>';
        echo '</div>';
        echo '<div class="d-flex p-1 col-6 col-sm-4 col-md-6 justify-content-end">';
        echo '<button class="btn btn-success bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb" onclick="atualizarStatus(' . $row['ID_oportunidade'] . ', \'revalidar\')">Revalidar</button>';
        echo '<button class="btn btn-danger bt1 rounded-3 h6 col-lg-2 col-sm-2 col-md-3 col-4 textb" onclick="atualizarStatus(' . $row['ID_oportunidade'] . ', \'desativar\')">Desativar</button>';
        echo '</div>';
        echo '</div>';
        // Adicione a linha separadora, exceto para a última oportunidade
        if ($rowCount < mysqli_num_rows($resultNegadas) - 1) {
            echo '<div class="bg-primary col-12 mt-3 mb-3" style="height: 1px;"></div>';
        }

        $rowCount++;
    }
    } else {
        echo 'Nenhuma oportunidade pendente.';
    }
    ?>
    </div>
      <h5 class="mb-3 txtj ">Expiradas</h5>

    <!-- Navegação de página no topo do conteúdo -->
    <nav aria-label="Page navigation example mb-3">
        <ul class="pagination">
        <?php
        // Lógica para exibir os números da página
        $maxPaginas = 4; // Número máximo de páginas a serem exibidas
        $inicio = max(1, $paginaAtualInativas - floor($maxPaginas / 2));
        $fim = min($inicio + $maxPaginas - 1, $numPaginasInativas);

        // Exibir o botão "<" se houver mais páginas antes
        if ($inicio > 1) {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="?pagina_inativas=' . ($inicio - 1) . '">&laquo;</a>';
            echo '</li>';
        }

        // Exibir os números da página
        for ($i = $inicio; $i <= $fim; $i++) {
            echo '<li class="page-item ' . ($i == $paginaAtualInativas ? 'active' : '') . '">';
            echo '<a class="page-link" href="?pagina_inativas=' . $i . '">' . $i . '</a>';
            echo '</li>';
        }

        // Exibir o botão ">" se houver mais páginas depois
        if ($fim < $numPaginasInativas) {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="?pagina_inativas=' . ($fim + 1) . '">&raquo;</a>';
            echo '</li>';
        }
        ?>
        </ul>
    </nav>

    <div class="border border-primary p-3 rounded-5 mb-5 feedExp">
    <?php
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');

// Verifica se há resultados
if (mysqli_num_rows($resultInativas) > 0) {
    $rowCount = 0;
    while ($row = mysqli_fetch_assoc($resultInativas)) {
        // Exiba as informações da oportunidade pendente
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<div class="d-flex align-items-center col-6">';
        echo '<a href="detalhes_oportunidadeReativar.php?id=' . $row['ID_oportunidades_inativas'] . '" class="link-oportunidade" style="display:flex;flex-direction:row;justify-content:center;align-items:center;">';
        echo '<img src="' . $row['imagem'] . '" class="bg-black rounded-5 col-4 " style="width: 4vw; height: 4vw; object-fit:cover;">';
        echo '<p class="mb-0 h5 text mg">' . $row['titulo'] . '</p>';
        echo '</a>';
        echo '</div>';
        echo '<div class="d-flex p-1 col-6 col-sm-4 col-md-6 justify-content-end">';
        echo '<button class="btn btn-success bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb" onclick="atualizarStatus(' . $row['ID_oportunidades_inativas'] . ', \'reativar\')">Reativar</button>';
        echo '</div>';
        echo '</div>';
        // Adicione a linha separadora, exceto para a última oportunidade
        if ($rowCount < mysqli_num_rows($resultInativas) - 1) {
            echo '<div class="bg-primary col-12 mt-3 mb-3" style="height: 1px;"></div>';
        }

        $rowCount++;
    }
    } else {
        echo 'Nenhuma oportunidade pendente.';
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
</body>

</html> 