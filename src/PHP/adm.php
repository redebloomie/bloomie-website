<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['start_date']) && isset($_GET['end_date'])) {
  $start_date = date('Y-m-d', strtotime($_GET['start_date']));
  $end_date = date('Y-m-d', strtotime($_GET['end_date']));

  $sql = "SELECT DATE(data_criacao) AS datac, COUNT(*) AS quantidade FROM usuario WHERE data_criacao BETWEEN '$start_date' AND '$end_date' GROUP BY DATE(data_criacao)";
  $result = $conexao->query($sql);

  if ($result) {
      while ($row = $result->fetch_assoc()) {
          $dateArray[] = $row['datac'];
          $userArray[] = $row['quantidade'];
      }

      unset($result);
  } else {
      echo 'Erro na consulta ao banco de dados: ' . $conexao->error . ' SQL: ' . $sql;
  }
}

// Gráfico de postagens
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['start_dateP']) && isset($_GET['end_dateP'])) {
  $start_dateP = date('Y-m-d', strtotime($_GET['start_dateP']));
  $end_dateP = date('Y-m-d', strtotime($_GET['end_dateP']));

  $sqlP = "SELECT DATE(data_publicacao) AS datac, COUNT(*) AS quantidade FROM post WHERE data_publicacao BETWEEN '$start_dateP' AND '$end_dateP' GROUP BY DATE(data_publicacao)";
  $resultP = $conexao->query($sqlP);

  if ($resultP) {
      while ($row = $resultP->fetch_assoc()) {
          $postDateArray[] = $row['datac'];
          $postArray[] = $row['quantidade'];
      }

      unset($resultP);
  } else {
      echo 'Erro na consulta ao banco de dados: ' . $conexao->error . ' SQL: ' . $sqlP;
  }
}

// Gráfico de postagens
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['start_dateO']) && isset($_GET['end_dateO'])) {
  $start_dateO = date('Y-m-d', strtotime($_GET['start_dateO']));
  $end_dateO = date('Y-m-d', strtotime($_GET['end_dateO']));

  $sqlO = "SELECT DATE(data_publicacao) AS datac, COUNT(*) AS quantidade FROM oportunidade WHERE data_publicacao BETWEEN '$start_dateO' AND '$end_dateO' GROUP BY DATE(data_publicacao)";
  $resultO = $conexao->query($sqlO);

  if ($resultO) {
      while ($row = $resultO->fetch_assoc()) {
          $oporDateArray[] = $row['datac'];
          $oporArray[] = $row['quantidade'];
      }

      unset($resultO);
  } else {
      echo 'Erro na consulta ao banco de dados: ' . $conexao->error . ' SQL: ' . $sqlO;
  }
}

// Consultar quantidade de usuários
$consultaUsuarios = "SELECT COUNT(*) AS totalUsuarios FROM usuario";
$resultadoUsuarios = $conexao->query($consultaUsuarios);
$totalUsuarios = $resultadoUsuarios->fetch_assoc()['totalUsuarios'];

// Consultar quantidade de oportunidades
$consultaOportunidades = "SELECT COUNT(*) AS totalOportunidades FROM oportunidade";
$resultadoOportunidades = $conexao->query($consultaOportunidades);
$totalOportunidades = $resultadoOportunidades->fetch_assoc()['totalOportunidades'];

// Consultar quantidade de posts
$consultaPosts = "SELECT COUNT(*) AS totalPosts FROM post";
$resultadoPosts = $conexao->query($consultaPosts);
$totalPosts = $resultadoPosts->fetch_assoc()['totalPosts'];

// Fechar a conexão com o banco de dados
$conexao->close();
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
  <!-- Inclua a biblioteca Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<style>

</style>
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

      <div class="col-10 d-flex justify-content-center d-flex flex-column perfil-pg"
        style="margin-top: 5.5vw; margin-left: 20vw; width: 75vw;">
        
          <h2 class="mb-3">Visão Geral</h2>
          <div class="row justify-content-between">
            <div class="bg-primary col-md-3 rounded-4 text-white text-center d-flex justify-content-center align-items-center"
              style="height: 18vh;">
              <div> <img src="../assets/bluBloomie.png" class="img-fluid" style="height: 50px; width: 50px;" alt=""></div>
              <div>
                <p class="m-0">Usuários</p>
                <span class="h1"><?php echo $totalUsuarios; ?></span>
              </div>
          
            </div>
            <div class="bg-primary col-md-3 rounded-4 text-white text-center d-flex justify-content-center align-items-center"
              style="height: 18vh;">
              <div> <img src="../assets/bluBloomie.png" class="img-fluid" style="height: 50px; width: 50px;" alt=""></div>
              <div>
                <p class="m-0">Oportunidades</p>
                <span class="h1"><?php echo $totalOportunidades; ?></span>
              </div>
          
            </div>
            <div class="bg-primary col-md-3 rounded-4 text-white text-center d-flex justify-content-center align-items-center"
              style="height: 18vh;">
              <div> <img src="../assets/bluBloomie.png" class="img-fluid" style="height: 50px; width: 50px;" alt=""></div>
              <div>
                <p class="m-0">Postagens</p>
                <span class="h1"><?php echo $totalPosts; ?></span>
              </div>
          
            </div>
          </div>   
          <h2 class="mt-5 mb-3">Usuários</h2> 
          <div class="d-flex justify-content-between">
          <div class="p-3 border border-primary rounded-4 col-md-8 d-flex justify-content-between  "style="height: 25rem;display:flex;flex-direction:column;">
          <span class="col-12" style="display:flex;flex-direction:row;justify-content:space-between;width:100%">
              <p class="h4 txtj">Taxa de crescimento</p>
              <form method="GET" action="" style="display:flex;flex-direction:row;justify-content:center;align-items:center;">
                  <input type="date" id="start_date" name="start_date" required style="width:100px;">
                  <p style="margin: 0;">-</p>
                  <input type="date" id="end_date" name="end_date" required style="width:100px;">

                  <button type="submit" style="margin-left:10px;">Filtrar</button>
              </form>
          </span>

          <canvas id="myChart"></canvas>

            </div>
            <div class="p-3 border border-primary rounded-4 col-md-3 d-flex flex-column" style="height: 20rem;">
              <p class="h4 txtj">Base Filtrada</p>
              <!-- Seu conteúdo aqui -->
              <div class="mt-auto text-center"> 
                  <input type="date" class="rounded-4 " style="height: 2rem;">
                  
              </div>
          </div>
          
          
          </div>
          <h2 class="mt-5 mb-3">Postagens</h2> 
          <div class="d-flex justify-content-between">
          <div class="p-3 border border-primary rounded-4 col-md-8 d-flex justify-content-between  "style="height: 25rem;display:flex;flex-direction:column;">
          <span class="col-12" style="display:flex;flex-direction:row;justify-content:space-between;width:100%">
              <p class="h4 txtj">Taxa de crescimento</p>
              <form method="GET" action="" style="display:flex;flex-direction:row;justify-content:center;align-items:center;">
                  <input type="date" id="start_dateP" name="start_dateP" required style="width:100px;">
                  <p style="margin: 0;">-</p>
                  <input type="date" id="end_dateP" name="end_dateP" required style="width:100px;">

                  <button type="submit" style="margin-left:10px;">Filtrar</button>
              </form>
          </span>

          <canvas id="ChartP"></canvas>
            </div>
            <div class="col-md-3">
              <div class="bg-primary col-md-12 rounded-4 text-white text-center d-flex justify-content-center align-items-center mb-5" style="height: 8rem;" >
                <div> <img src="../assets/bluBloomie.png" class="img-fluid" style="height: 50px; width: 50px;"  alt=""></div>
                <div>
                  <p class="m-0">Usuários</p> 
                  <span class="h1">100</span>
                </div>
                
              </div>
              <div class="bg-primary col-md-12 rounded-4 text-white text-center d-flex justify-content-center align-items-center mb-5" style="height: 8rem;" >
                <div> <img src="../assets/bluBloomie.png" class="img-fluid" style="height: 50px; width: 50px;"  alt=""></div>
                <div>
                  <p class="m-0">Usuários</p> 
                  <span class="h1">100</span>
                </div>
                
              </div>
            </div>
            
              
          </div>
          <h2 class="mt-5 mb-3">Oportunidades</h2> 
            <div class="p-3 border border-primary rounded-4 col-md-12 mb-5 d-flex justify-content-between " style="height: 35rem;display:flex;flex-direction:column;">
            <span class="col-12" style="display:flex;flex-direction:row;justify-content:space-between;width:100%">
              <p class="h4 txtj">Taxa de crescimento</p>
              <form method="GET" action="" style="display:flex;flex-direction:row;justify-content:center;align-items:center;">
                  <input type="date" id="start_dateO" name="start_dateO" required style="width:100px;">
                  <p style="margin: 0;">-</p>
                  <input type="date" id="end_dateO" name="end_dateO" required style="width:100px;">

                  <button type="submit" style="margin-left:10px;">Filtrar</button>
              </form>
          </span>

          <canvas id="ChartO"></canvas>
  
            </div>
            
          
          
        
      </div>
  <!--BASE FILTRADA-->
    <!--  <div class="row mt-4">
              <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card z-index-2">
                  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                      <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas" height="180"></canvas>
                        <div class="card-body">
                          <h4>Base filtrada</h4>
                          <input type="text">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              </div>
            </div>--> 
            
  </main>

  <footer>
    <!-- place footer here -->
  </footer>

  <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode(isset($dateArray) ? $dateArray : []); ?>,
                datasets: [{
                    label: '# of Users',
                    data: <?php echo json_encode(isset($userArray) ? $userArray : []); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctxPost = document.getElementById('ChartP');

        new Chart(ctxPost, {
            type: 'line',
            data: {
                labels: <?php echo json_encode(isset($postDateArray) ? $postDateArray : []); ?>,
                datasets: [{
                    label: '# of Posts',
                    data: <?php echo json_encode(isset($postArray) ? $postArray : []); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctxOpor = document.getElementById('ChartO');

        new Chart(ctxOpor, {
            type: 'line',
            data: {
                labels: <?php echo json_encode(isset($oporDateArray) ? $oporDateArray : []); ?>,
                datasets: [{
                    label: '# of Posts',
                    data: <?php echo json_encode(isset($oporArray) ? $oporArray : []); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
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