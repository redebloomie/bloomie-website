<?php
session_start();
include("connect.php");

  $pubs = mysqli_query("SELECT * FROM posts ORDER BY ID_post desc");

  if (isset($_POST['publicar'])) {
    if ($_FILES["file"]["error"] > 0) {
      $texto = $_POST["texto"];
      $hoje = date("Y-m-d");
      $ID_usuario  = $_SESSION['ID_usuario'];

      if ($texto == "") {
        echo "<h3>Você precisa publicar alguma coisa!</h3>";
      }else{
        $query = "INSERT INTO posts (ID_usuario, texto, imagem, data_publicacao) VALUES ('$ID_usuario', '$texto', '$imagem', '$hoje')";
        $data = mysqli_query($query) or die();
        if ($data) {
          header("Location: ./");
        }else{
          echo "Erro";
        }
      }
    }else{
      $n = rand(0, 1000000);
      $img = $n.$_FILES["file"]["name"];

      move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$img);

      $texto = $_POST['texto'];
      $hoje = date("Y-m-d");

      if ($texto == "") {
        echo "<h3>Você precisa publicar alguma coisa!</h3>";
      }else{
        $query = "INSERT INTO posts (ID_usuario, texto, imagem, data_publicacao) VALUES ('$ID_usuario', '$texto', '$imagem', '$hoje')";
        $data = mysqli_query($query) or die();
        if ($data) {
          header("Location: ./");
        }else{
          echo "Erro";
        }
      }
    }
  }
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
  <link rel="shortcut icon" href="/src/assets/bluBloomie.png" />

  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://kit.fontawesome.com/fec6e5d711.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body id="homepage">
  <nav class="navbar navbar-expand-sm navbar-dark bg-white">
    <a class="navbar-brand" href="#"><img src="../assets/logoBloomie-blu.png" alt="" width="150px"
        style="margin: 0 15px;"></a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
      aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
      <ul class="navbar-nav me-auto mt-2 mt-lg-0" style="display: flex; flex-direction: row; gap: 10px;">
        <li class="nav-item">
          <a href="../pages/homepage-postagens.html"><button type="button" id="btnPostagens" class="btn"
            style="background-color: #0C5D9E; color: #fff; font-weight: 500; border-radius: 15px; width: 150px;">Postagens</button></a>
        </li>
        <li class="nav-item">
          <a href="../pages/homepage-oportunidades.html"><button type="button" id="btnOportunidades" class="btn"
            style="color: #5AB5FF; font-weight: 500;">Oportunidades</button></a>
        </li>
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
                  <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">Home</a>
                </div>
                <div class="col text-white sidebar-op">
                  <i class="ph ph-user"></i>
                  <a href="../pages/perfil.html" class="text-decoration-none text-white">Perfil</a>
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

      <div class="col-8 d-flex justify-content-center pg-postagens" style="margin-top: 5.5vw;">
        <div id="feed-postagens" class="row-cols-1 justify-content-center align-items-center g-0 col-12">
          <div class="col-12 d-flex justify-content-center">
            <form action="../PHP/post.php" method="post" class="col-10 form-post" enctype="multipart/form-data">
              <div class="col-12 row-cols-1">
                <div class="col form-msg-post">
                  <textarea class="col-12 post-section multiline-input" rows="3" name="texto" wrap="hard"
                    placeholder="Algo para compartilhar? Deixe florescer!"></textarea>
                </div>
                <div class="col op-form" style="background-color: #E6F4FF;">
                  <span>
                    <label for="uploadImagem" class="custom-upload-btn align-items-center">
                      <i class="ph ph-image"></i>
                      <p style="font-weight: 500;">Foto</p>
                    </label>
                    <label for="uploadArquivo" class="custom-upload-btn">
                      <i class="ph ph-file-text"></i>
                      <p style="font-weight: 500;">Documento</p>
                    </label>
                    <input type="file" name="uploadImagem" id="uploadImagem" accept="image/*" size="5000000">
                    <input type="file" name="uploadArquivo" id="uploadArquivo" accept="*/*" size="5000000">
                  </span>
                  <input type="submit" name="publicar" value="Postar" class="btn btn-primary rounded-4" style="font-weight: 500;">
                </div>
              </div>
            </form>
          </div>
          <div class="col-12 d-flex justify-content-center post-container" id="feed">
            <div class="row-cols-1 justify-content-center align-items-center col-10 p-3 post-container-item">
              <div class="col">
                <div class="postagem-user">
                  <img src="https://source.unsplash.com/random/" alt="">
                  <span>
                    <p style="font-weight: 700; font-size: 18px;">Nome do Usuário</p>
                    <p style="color: #45abff;">22/06/2023</p>
                  </span>
                </div>
              </div>
              <div class="col">
                <p style="font-size: 18px;">Descubra a essência que impulsiona a Bloomie e transforma
                  vidas. Conheça nossa visão de conectar
                  estudantes a oportunidades de crescimento pess... <span style="font-weight: 500;">Ler mais.</span></p>
              </div>
              <div class="col doc-post">
                <span>
                  <i class="ph ph-file-text"></i>
                  <a href="">bloomie.pdf</a>
                </span>
              </div>
              <div class="col img-post">
                <img src="https://source.unsplash.com/random/" alt="">
              </div>
              <div class="col-12 interacoes-post">
                <div class="options-post">
                  <div class="rightside-op-post">
                    <span>
                      <i class="ph ph-heart"></i>
                      <p>19</p>
                    </span>
                    <span>
                      <i class="ph ph-chat-circle"></i>
                      <p>19</p>
                    </span>
                    <span>
                      <i class="ph ph-link-simple-horizontal"></i>
                    </span>
                  </div>
                  <div class="leftside-op-post">
                    <i class="ph ph-warning"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        while ($pub=mysqli_fetch_assoc($pubs)) {
          $email = $pub['user'];
          $saberr = mysqli_query("SELECT * FROM usuario WHERE email='$email'");
          $saber = mysqli_fetch_assoc($saberr);
          $nome = $saber['nome']." ".$saber['usuario'];
          $id = $pub['ID_post'];

          if ($pub['img']=="") {
            echo `<div class="pub" id=""></div>`;
          }
        }
      ?>

      <div class="col-2 rightsidebar p-0 pg-postagens-leftSidebar ">
        <div id="sidebar-postagens" class="row-cols-1 justify-content-center align-items-center rightsidebar-group">
          <div class="col rounded text-center">
            <div class="container rightsidebar-container-1">
              <div class="row-cols-1 destaques justify-content-center align-items-center g-0">
                <div class="col destaques-top text-nowrap">
                  <p style="color: #1289EA; font-weight: 500;">Destaques da semana</p>
                  <p style="color: #DBAC01; font-weight: 500;">Arraste e confira!</p>
                </div>
                <div class="col text-start destaques-post">
                  <span style="display:flex; flex-direction: row;" class="destaques-post-user">
                    <img src="https://source.unsplash.com/random" alt="">
                    <span>
                      <p style="font-weight: 500;">Nome de usuário</p>
                      <p style="font-size: 1vw;">21/11/2023</p>
                    </span>
                  </span>
                  <div style="display:flex; flex-direction: column;" class="destaques-post-text">
                    <p>Descubra a essência que impulsiona a Bloomie e transforma... Ler mais.</p>
                    <span class="destaques-post-tags">
                      <p style="background-color: #F2C934;">#educação</p>
                      <p style="background-color: #5AB5FF;">#redesocial</p>
                    </span>
                    <img src="/src/assets/sobre_foto.png" alt="">
                  </div>
                </div>
                <div class="col dots"
                  style="display:flex; flex-direction: row; justify-content: center; align-items: center;">
                  <div class="dot" style="background-color: #1185E3;"></div>
                  <div class="dot" style="background-color: #0C5D9E;"></div>
                  <div class="dot" style="background-color: #DBAC01;"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col rounded text-center">
            <div class="container rightsidebar-container-2">
              <div class="row-cols-1 justify-content-center align-items-center g-0">
                <div class="col destaques-bloomigos">
                  <p style="color: #1289EA; font-weight: 500;">Bloomigos sugeridos</p>
                  <p style="color: #DBAC01; font-weight: 500;">Amplie sua rede, conecte-se.</p>
                </div>
                <div class="col">
                  <div class="rows-cols-1 justify-content-center align-items-center g-2">
                    <div class="col destaques-bloomigos-user">
                      <span style="display:flex; flex-direction: row;">
                        <img src="https://source.unsplash.com/random" alt=""
                          style="border-radius: 100%; width: 3vw; height: 3vw;">
                        <span style="display: flex; flex-direction: column; text-align: start;">
                          <p style="font-weight: 500;">Ayla Santos</p>
                          <p style="font-size: 1vw;">@aylasantos</p>
                        </span>
                      </span>
                    </div>
                    <div class="col destaques-bloomigos-user">
                      <span style="display:flex; flex-direction: row;">
                        <img src="https://source.unsplash.com/random" alt=""
                          style="border-radius: 100%; width: 3vw; height: 3vw;">
                        <span style="display: flex; flex-direction: column; text-align: start;">
                          <p style="font-weight: 500;">Ayla Santos</p>
                          <p style="font-size: 1vw;">@aylasantos</p>
                        </span>
                      </span>
                    </div>
                    <div class="col destaques-bloomigos-user">
                      <span style="display:flex; flex-direction: row;">
                        <img src="https://source.unsplash.com/random" alt=""
                          style="border-radius: 100%; width: 3vw; height: 3vw;">
                        <span style="display: flex; flex-direction: column; text-align: start;">
                          <p style="font-weight: 500;">Ayla Santos</p>
                          <p style="font-size: 1vw;">@aylasantos</p>
                        </span>
                      </span>
                    </div>
                    <div class="col destaques-bloomigos-user">
                      <span style="display:flex; flex-direction: row;">
                        <img src="https://source.unsplash.com/random" alt=""
                          style="border-radius: 100%; width: 3vw; height: 3vw;">
                        <span style="display: flex; flex-direction: column; text-align: start;">
                          <p style="font-weight: 500;">Ayla Santos</p>
                          <p style="font-size: 1vw;">@aylasantos</p>
                        </span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="line-division"></div>
      </div>
    </div>
  </main>

  <footer>
    <!-- place footer here -->
  </footer>

  <script>
    function carregarPostagens() {
        // Faça uma solicitação AJAX para o seu script PHP que recupera as postagens
        fetch('caminho-para-seu-script-php.php')
        .then(response => response.json())
        .then(data => {
            const feedElement = document.getElementById('feed');
            
            // Limpe o conteúdo existente no feed
            feedElement.innerHTML = '';

            // Itere sobre os dados recebidos e crie elementos HTML para cada postagem
            data.forEach(postagem => {
                const postElement = document.createElement('div');
                postElement.className = 'seu-classe-de-postagem';

                // Crie os elementos para mostrar os dados da postagem
                // Exemplo: postElement.innerHTML = `<p>${postagem.texto}</p>`;

                // Anexe o elemento da postagem ao feed
                feedElement.appendChild(postElement);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar postagens:', error);
        });
    }

    // Chame carregarPostagens para carregar as postagens quando a página for carregada
    window.onload = carregarPostagens;
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