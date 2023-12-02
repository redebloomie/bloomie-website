<?php
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');

// Configurações de paginação para oportunidades Estágio
$porPagina = 9; // 3x3
$paginaAtualEstagio = isset($_GET['pagina_estagio']) ? $_GET['pagina_estagio'] : 1;
$offsetEstagio = ($paginaAtualEstagio - 1) * $porPagina;

// Consulta para obter oportunidades Estágio com paginação
$queryEstagio = "SELECT * FROM oportunidade WHERE categoria = 'Estágios' LIMIT $offsetEstagio, $porPagina";
$resultEstagio = mysqli_query($conexao, $queryEstagio);

// Consulta para obter o número total de oportunidades Estágio
$totalQueryEstagio = "SELECT COUNT(*) as total FROM oportunidade WHERE categoria = 'Estágios'";
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
                  <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">Home</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-user"></i>
                  <a href="../PHP/perfil.php" class="text-decoration-none text-white">Perfil</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-bell-ringing"></i>
                  <a href="" class="text-decoration-none text-white">Notificações</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-plant"></i>
                  <a href="../pages/enviarOportunidade.html" class="text-decoration-none text-white">Enviar<br>oportunidades</a>
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

      <div class="col-8 pg-oportunidades">
        <div id="feed-oportunidades" class="row-cols-1 justify-content-center align-items-center g-0 col-12 conteudo">
          <div class="col-12 justify-content-center align-items-center">
            <div class="row-cols-1 justify-content-center align-items-center g-2">

              <div class="col row-cols-1 justify-content-center align-items-center g-2 op-lista"
                style="margin-top: 30px;">
                <div class="col op-lista-top">
                  <span
                    style="display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 1vw;">
                    <h2 style="margin: 0; color: #1185E3; display: flex; justify-content: center; align-items: center;">
                      Estágios</h2>
                    <p
                      style="margin: 0; font-size: 15px; background-color: #1185E3; color: #fff; border-radius: 15px; padding: 0 15px; font-weight: 500;">
                      Crescimento profissional</p>
                  </span>
                </div>
                <div class="col op-lista-bottom" style="margin-top: 20px; margin-bottom: 40px; display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 3vw; position: relative;">
                  <?php
                    while ($oportunidade = mysqli_fetch_assoc($resultEstagio)) {
                  
                      echo '
                      <div>
                            <div class="row-cols-1 justify-content-center align-items-center g-2">
                              <div class="col image-container">
                                <img src="'. $oportunidade['imagem'].'" alt="" style="width: 12vw; height: 12vw; object-fit: cover;">
                                <div class="overlay" style="color: #0C5D9E;" style="width: 12vw; height: 12vw;>'.$oportunidade['descricao'].' <span style="font-weight: 500; width: 12vw; height: 12vw;">Ler mais.</span></div>
                              </div>
                              <div class="col" style="margin-top: 10px;">
                                <p style="font-weight: 500; font-size: 18px;">'. $oportunidade['titulo'] .'</p>
                                <p><span style="font-weight: 500; color: #1185E3;">Prazo:</span> '.$oportunidade['tempo_expirar'].'</p>
                                <p><span style="font-weight: 500; color: #1185E3;">Faixa etária:</span> '.$oportunidade['faixa_etaria'].'</p>
                              </div>
                              <div class="col">
                              <a href="oportunidade.php?id='. $oportunidade['ID_oportunidade'] .'" class="btn btn-primary" style="width: 12vw; padding: 2px 0; font-weight: 500; font-size: 18px; margin-top: 10px;">Saiba mais</a>
                              </div>
                            </div>
                          </div>';
                    }
                  ?>
                  <div class="col-1" style="position: absolute; right:0;">
                    <div class="row-cols-1 justify-content-center align-items-center g-2" style="height: 100%;">
                      <a href="" style="height: 100%; display: flex; justify-content: center; align-items: center; text-decoration: none; font-size: 4vw; color: #1185E3;"><i class="ph ph-caret-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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