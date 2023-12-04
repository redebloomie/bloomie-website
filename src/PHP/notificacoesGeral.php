<!doctype html>

<html lang="en">

<head>

  <title>Notificações Geral</title>
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



<body id="homepage">

  <nav class="navbar navbar-expand-sm navbar-dark bg-white">

    <a class="navbar-brand" href="homepage-postagens.php"><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"></a>

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
      <div class="col-2 " ></div>

      <section class="container col-12 col-md-10 col-lg-10 " style="padding-top: 5rem;">
        <div class="row">
          <ul class="nav nav-pills col-12 col-md-10 col-lg-9">
            <li class="nav-item col-4 col-md-4">
              <a class="nav-link p-4 rounded-0 sombralink textlink" style="background-color: rgba(8, 158, 228, 0.3); " aria-current="page" href="notificacoesGeral.php">Geral</a>
            </li>
            <li class="nav-item col-4 col-md-4">
              <a class="nav-link rounded-0 p-4 textlink" href="notificacoesSolicitacao.php">Solicitação</a>
            </li>
            <li class="nav-item col-4 col-md-4">
              <a class="nav-link p-4 textlink" href="notificacoesPendente.php">Pendente</a>
            </li>
          </ul>
        </div>
      
        <div class="row">
          <div class="col-12 col-lg-9 pb-5">
            <div class="bg-primary " style="height: 1px;"></div>
          </div>
        </div>
      
        <div>
          <div class="d-flex justify-content-between align-items-center ">
            <div class="d-flex align-items-center col-12 ">
              <div class="bg-black rounded-5 col-4 " style="width: 50px; height: 50px;"></div>
              <div class="usudata  col-10">
                <p class=" mb-0 h5 text mg  "style="color: #1185e3; "  >nome do usuario </p>
                <p class=" mb-0 h5 text mg  " style="color: #1185e3; " >curtiu sua <span style=" font-weight:bold;">postagem</span></p>  
                <p id="data" class="mb-0 text mg  " style=" color: #5AB5FF;">21/10/2023</p> 

              </div>
            </div>
            
            
          </div>
          
          <div class=" bg-primary col-12  mt-3 mb-3" style="height: 1px;"></div>
        </div>
        <div>
          <div class="d-flex justify-content-between align-items-center ">
            <div class="d-flex align-items-center col-12 ">
              <div class="bg-black rounded-5 col-4 " style="width: 50px; height: 50px;"></div>
              <div class="usudata  col-10">
                <p class=" mb-0 h5 text mg  "style="color: #1185e3; "  >nome do usuario </p>
                <p class=" mb-0 h5 text mg  " style="color: #1185e3; " >comentou sua <span style=" font-weight:bold;">postagem</span></p>  
                <p id="data" class="mb-0 text mg  " style=" color: #5AB5FF;">21/10/2023</p> 

              </div>
            </div>
            
            
          </div>
          
          <div class=" bg-primary col-12  mt-3 mb-3" style="height: 1px;"></div>
        </div>
        <div>
          <div class="d-flex justify-content-between align-items-center ">
            <div class="d-flex align-items-center col-12 ">
              <div class="bg-black rounded-5 col-4 " style="width: 50px; height: 50px;"></div>
              <div class="usudata  col-10">
                <p class=" mb-0 h5 text mg  "style="color: #1185e3; "  >nome do usuario </p>
                <p class=" mb-0 h5 text mg  " style="color: #1185e3; " >Publico uma nova <span style=" font-weight:bold;">oportunidade</span></p>  
                <p id="data" class="mb-0 text mg  " style=" color: #5AB5FF;">21/10/2023</p> 

              </div>
            </div>
            
            
          </div>
          
          <div class=" bg-primary col-12  mt-3 mb-3" style="height: 1px;"></div>
        </div>
        
        
      </section>
      
      <nav class="bottom-tab bottom-navigation">
          <a
            href="homepage-postagens.php"
            class="text-decoration-none"
          >
            <i class="ph ph-house"></i>
          </a>
          <a href="perfil.php" class="text-decoration-none">
            <i class="ph ph-user"></i>
          </a>
          <div class="bottom-tab-center">
            <div class="bottom-tab-center-inner" id="bottomTabCenter">
              <a href="../pages/enviarOportunidade.html">
                <i class="ph ph-plus-circle" id="plusIcon"></i>
              </a>
            </div>
          </div>

          <a href="notificacoesGeral.php" class="text-decoration-none">
            <i class="ph ph-bell"></i>
          </a>

          <a href="../pages/configuracoes.html" class="text-decoration-none">
            <i class="ph ph-gear"></i>
          </a>
        </nav>

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