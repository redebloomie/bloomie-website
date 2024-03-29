<!doctype html>

<html lang="en">

<head>

  <title>Configurações</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

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

    <a class="navbar-brand" href="../PHP/homepage-postagens.php"><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"></a>

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

                  <a href="configuracoes.php" class="text-decoration-none text-white">Configurações</a>

                </div>

                <div class="col text-white sidebar-op">

                  <i class="ph ph-question"></i>

                  <a href="../pages/Ajuda_e_Suporte.html" class="text-decoration-none text-white">Ajuda & suporte</a>

                </div>

              </div>

            </div>

            <div class="col">

              <a href="../PHP/sair.php" class="text-decoration-none text-white">Sair</a>

            </div>

          </div>

        </div>

      </div>
      <div class="col-2  " ></div>

      <section class="container col-12 col-md-10 col-lg-10 justify-content-center " style="padding-top: 5rem;">
        <p class="h3 txtT mb-3 ">Conta</p>
        <div class="border border-primary rounded-4 p-4 txtT col-12 col-md-9 col-lg-9 mb-5">
          <h5>Alterar e-mail</h5>
          <form action="alterar_email.php" method="post" onsubmit="return validarForm()">
              <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                  <input type="email" class="form-control rounded-4 mb-3" name="novo_email" id="novo_email" placeholder="Novo email" style="border-color: #1185e3;" required>
              </div>
              <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                  <input type="email" class="form-control rounded-4 mb-3" name="confirmar_email" id="confirmar_email" placeholder="Digite novamente" style="border-color: #1185e3;" required>
              </div>
              <div class="col-12 text-danger mb-3" id="erroEmail">
              </div>
              <div class="col-12 col-md-12 btn-lg text-end">
                  <button type="submit" class="btn btn-primary col-4 col-md-2">Salvar</button>
              </div>
          </form>
        </div>
        <p class="h3 txtT mb-3 ">Notificações</p>
        <div class="border border-primary rounded-4 p-4 txtT col-12 col-md-9 col-lg-9  mb-5" >
          <div class="d-flex justify-content-between  col-md-8 col-8">
            <p class="h5 col-5">Notificações Gerais</p>
            <div class="form-check form-switch form-switch-md ">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label" for="flexSwitchCheckChecked"></label>
            </div>
          </div>
          <div class="d-flex justify-content-between  col-md-8 col-8">
            <p class="h5 col-5">Curtidas e Comentários</p>
            <div class="form-check form-switch form-switch-md ">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label" for="flexSwitchCheckChecked"></label>
            </div>
          </div>
          <div class="d-flex justify-content-between  col-md-8 col-8">
            <p class="h5 col-5">Sobre a plataforma</p>
            <div class="form-check form-switch form-switch-md ">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label" for="flexSwitchCheckChecked"></label>
            </div>
          </div>
          

        </div>
        <p class="h3 txtT mb-3 text-decoration-underline ">Portal de Privacidade</p>
        <div class="border border-primary rounded-4 p-4 txtT col-12 col-md-9 col-lg-9 mb-5" >
          <div class="d-flex justify-content-between  col-8 col-sm-8 col-md-8 mb-3 ">
            <p class="h4 txtj col-12 " style="font-weight: normal;">Termos de Uso</p>
            <div><img src="../assets/filo-icon1.png" class="" alt="..." style="width: 20px; height: 20px;"></div>
          </div>
          <div class="d-flex justify-content-between  col-8 col-sm-8 col-md-8 mb-3 ">
            <p class="h4 txtj col-12 " style="font-weight: normal;">Política de Privacidade</p>
            <div><img src="../assets/filo-icon1.png" class="" alt="..." style="width: 20px; height: 20px;"></div>
          </div>
          <div class="d-flex justify-content-between  col-8 col-sm-8 col-md-8 mb-3 ">
            <p class="h4 txtj col-12 " style="font-weight: normal;">Regras e Diretrizes</p>
            <div><img src="../assets/filo-icon1.png" class="" alt="..." style="width: 20px; height: 20px;"></div>
          </div>

          
          

        </div>
        <p class="h3 txtT mb-3 text-decoration-underline ">Ajuda e Suporte</p>
        <div class="border border-primary rounded-4 p-4 txtT col-12 col-md-9 col-lg-9 mb-5" >
          <div class="d-flex justify-content-between  col-8 col-sm-8 col-md-8 mb-3 ">
            <p class="h4  col-12 " >Realizar denúncia</p>
            <div><img src="../assets/filo-icon1.png" class="" alt="..." style="width: 20px; height: 20px;"></div>
          </div>
          <div class="d-flex justify-content-between  col-8 col-sm-8 col-md-8 mb-3 ">
            <p class="h4  col-12 " >Política de Privacidade</p>
            <div><img src="../assets/filo-icon1.png" class="" alt="..." style="width: 20px; height: 20px;"></div>
          </div>
          <p class="h6 txtj text-decoration-underline">Entre em contato conosco clicando <span>aqui,</span></p>
          <p class=" txtj">Ou contate: Suportebloomie@gmail.com</p>
          

          
          

        </div>
        <p class="h3 txtT mb-3 text-decoration-underline ">Controle de Conta</p>
        <div class="border border-primary rounded-4 p-4 txtT col-12 col-md-9 col-lg-9"   >
          <div class="d-flex justify-content-between  col-8 col-sm-8 col-md-8  ">
            <a href="../pages/excluirConta.html" class="d-flex justify-content-between  col-12 col-sm-12 col-md-12  ">
              <p class="h4  col-12 " >Excluir minha conta</p>
              <div><img src="../assets/filo-icon1.png" class="" alt="..." style="width: 20px; height: 20px;"></div>
            </a>
          </div>
          
        </div>
        <div style="height: 5rem;"></div>
        
        <nav class="bottom-tab bottom-navigation">
          <a
            href="../PHP/homepage-postagens.php"
            class="text-decoration-none"
          >
            <i class="ph ph-house"></i>
          </a>
          <a href="../PHP/perfil.php" class="text-decoration-none">
            <i class="ph ph-user"></i>
          </a>
          <div class="bottom-tab-center">
            <div class="bottom-tab-center-inner" id="bottomTabCenter">
              <a href="enviarOportunidade.html">
                <i class="ph ph-plus-circle" id="plusIcon"></i>
              </a>
            </div>
          </div>

          <a href="../PHP/notificacoesGeral.php" class="text-decoration-none">
            <i class="ph ph-bell"></i>
          </a>

          <a href="configuracoes.php" class="text-decoration-none">
            <i class="ph ph-gear"></i>
          </a>
        </nav>

            
        
      </section>
      






  </main>





  <footer>

    <!-- place footer here -->

  </footer>
  <script src="bottom_tab.js"></script>

  <script>
    function validarForm() {
        // Validar se os e-mails coincidem
        var novoEmail = document.getElementById('novo_email').value;
        var confirmarEmail = document.getElementById('confirmar_email').value;

        if (novoEmail !== confirmarEmail) {
            document.getElementById('erroEmail').innerHTML = "Os e-mails não coincidem.";
            alert("Os e-mails não coincidem.");
            return false;
        }

        return true;
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