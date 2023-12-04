<?php
include('connect.php');

// Verifique se o ID da oportunidade está presente na URL
if (isset($_GET['id'])) {
    $idOportunidade = $_GET['id'];

    // Consulta para obter os detalhes completos da oportunidade com base no ID
    $detalhesQuery = "SELECT * FROM oportunidade WHERE ID_oportunidade = $idOportunidade";
    $detalhesResult = mysqli_query($conexao, $detalhesQuery);

    // Verifique se há resultados
    if ($detalhesResult && mysqli_num_rows($detalhesResult) > 0) {
      $detalhes = mysqli_fetch_assoc($detalhesResult);
  } else {
      echo 'Oportunidade não encontrada.';
  }
} else {
    echo 'ID de oportunidade não fornecido.';
}

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

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-white">
    <a class="navbar-brand" href="adm.php"><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"></a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
      aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
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

      <section class="container col-10 col-md-10 col-lg-10 d-flex justify-content-center txtj" style="padding-top: 4.5rem; padding-left: 10vw;">
        <div class="text-center col-md-5">
          
          <p class="h5 txtT mb-4">Aprovação de Oportunidades</p>
          
          <div class="col p-2">
            <h5 class="text-start h6 ">Título Oportunidades</h5>
            <div class="col-12 col-md-12 col-lg-12 mb-3" >
                <input type="text" class="form-control rounded-4" id="" value="<?php echo $detalhes['titulo']; ?>" readonly style="border-color: #1185e3;">
            </div>
    
          </div>
          <div class="col p-2">
            <h5 class="text-start h6">Categoria</h5>
            <div class="col-12 col-md-12 col-lg-12 mb-3" >
                <input type="text" class="form-control rounded-4" id="" value="<?php echo $detalhes['categoria']; ?>" readonly style="border-color: #1185e3;" >
            </div>
    
          </div>
          <div class="d-flex">
            <div class="col p-2">
              <h5 class="text-start  h6">Estado</h5>
              <div class="col-12 col-md-12 col-lg-12 mb-3 " >
                  <input type="text" class="form-control rounded-4" id="" value="<?php echo $detalhes['estado']; ?>" readonly style="border-color: #1185e3;" >
              </div>
      
            </div>
            <div class="col p-2">
              <h5 class="text-start h6">Cidade</h5>
              <div class="col-12 col-md-12 col-lg-12 mb-3 " >
                  <input type="text" class="form-control rounded-4" id="" value="<?php echo $detalhes['cidade']; ?>" readonly style="border-color: #1185e3;" >
              </div>
      
            </div>
          </div>
          <div class="d-flex">
            <div class="col p-2">
              <h5 class="text-start h6">Inicio <span>?</span></h5>
              <div class="col-12 col-md-12 col-lg-12 mb-3 " >
                  <input type="text" class="form-control rounded-4" id="" value="<?php echo $detalhes['inicio']; ?>" readonly style="border-color: #1185e3;" >
              </div>
      
            </div>
            <div class="col p-2">
              <h5 class="text-start h6">Prazo de vencimento <span>?</span></h5>
              <div class="col-12 col-md-12 col-lg-12 mb-3 " >
                  <input type="text" class="form-control rounded-4" id="" value="<?php echo $detalhes['tempo_expirar']; ?>" readonly style="border-color: #1185e3;" >
              </div>
      
            </div>
          </div>
          <div class="col p-2">
            <h5 class="text-start h6">Descrição <span>?</span></h5>
            <div class="col-12 col-md-12 col-lg-12 mb-3" >
                <input type="text" class="form-control rounded-4 h-25" id="" value="<?php echo $detalhes['descricao']; ?>" readonly style="border-color: #1185e3;" >
            </div>
    
          </div><div class="d-flex col-md-12">
            <div class="col p-2">
              <h5 class="text-start h6">Faixa etária</h5>
              <div class="col-12 col-md-12 col-lg-12 mb-3" >
                  <input type="text" class="form-control rounded-4" id="" value="<?php echo $detalhes['faixa_etaria']; ?>" readonly style="border-color: #1185e3;" >
              </div>
            </div>
          </div>

          <div class="col p-2">
            <h5 class="text-start h6">Escolaridade</h5>
            <div class="col-12 col-md-12 col-lg-12 " >
                <input type="text" class="form-control rounded-4 mb-3" id="" value="<?php echo $detalhes['escolaridade']; ?>" readonly style="border-color: #1185e3;" >
            </div>
          </div>

          <div class="col p-2">
            <h5 class="text-start h6">Tipo de personalidade</h5>
            <div class="col-12 col-md-12 col-lg-12 " >
                <input type="text" class="form-control rounded-4 mb-3" id="" value="<?php echo $detalhes['tipo_personalidade']; ?>" readonly style="border-color: #1185e3;" >
            </div>
          </div>

          
          <div class="col p-2">
            <h5 class="text-start h6">Link de acesso a oportunidade</h5>
            <div class="col-12 col-md-12 col-lg-12 " >
                <input type="text" class="form-control rounded-4 mb-3" id="" value="<?php echo $detalhes['link']; ?>" readonly style="border-color: #1185e3;" >
            </div>
          </div>
          
          <div class="col p-2">
          <h5 class="text-start h6 ">Foto relacionada à oportunidade</h5>
            <div class="border border-primary bg-primary rounded-4 col-md-6 mb-5" >
              <img src="<?php echo $detalhes['imagem']; ?>" class="img-fluid rounded-4" alt="" style="width: 100%;height: 200px; object-fit: cover;position: relative;">

            </div>
    
          </div>
          
          
          <?php
            echo'
            <div class="d-flex justify-content-between  col-md-12">
              <button class="btn btn-danger col-md-5 mb-5" onclick="atualizarStatus(' . $idOportunidade . ', \'desativar\')"><span>Desativar <br>oportunidade</span></button>
            </div>';
          ?>
        </div>
      </section>
      
      






  </main>





  <footer>

    <!-- place footer here -->

  </footer>

  <!-- Bootstrap JavaScript Libraries -->

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
            window.location.href = 'adm_oportunidade.php';
        }
    };

    // Preparar os dados a serem enviados
    var dados = 'ID_oportunidade=' + ID_oportunidade + '&acao=' + acao;

    // Enviar a solicitação AJAX com os dados
    xhr.send(dados);
}


  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">

    </script>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">

    </script>



  <script src="../../public/script.js"></script>



</body>



</html>