<?php
  session_start();
  include('connect.php'); // Conexão com o banco de dados
  
  if (isset($_SESSION['ID_usuario'])) {
      $ID_usuario = $_SESSION['ID_usuario'];
      $usuario = $_SESSION['usuario'];
  
      // Consulta SQL para obter os dados do usuário
      $sql = "SELECT nome, usuario FROM usuario WHERE ID_usuario = ?";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param("i", $ID_usuario);
      $stmt->execute();
      $result = $stmt->get_result();
  
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $nome = $row['nome'];
          $usuario = $row['usuario'];
      }
  
      $stmt->close();
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
  <link rel="shortcut icon" href="../assets/bluBloomie.png" />

  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://kit.fontawesome.com/fec6e5d711.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    .content {
      max-width: 500px;
      border-radius: 5px;
      padding: 10px;
      width: 300px;
      background-color: white;
      overflow-y: auto;
      max-height: 50vh;
      box-shadow: 0 1px 2px #0003;
      margin: auto 5px;
    }

    .content::-webkit-scrollbar {
      width: 6px;
      border-radius: 10px;
    }

    .content::-webkit-scrollbar-thumb {
      border-radius: 10px;
      background-color: rgba(0, 0, 0, 0.2);
    }

    ul {
      flex-wrap: wrap;
    }

    li {
      list-style: none;
      background-color: #efefef;
      padding: 5px;
      border-radius: 5px;
      margin: 3px;
      float: left;
    }

    input {
      outline: none;
      border: none;
      height: 30px;
      margin-left: 5px;
      background-color: #efefef;
      max-width: 100px;
      padding: 5px;
      border-radius: 5px;
      margin: 3px;
    }

    button {
      border-radius: 50%;
      padding: 0 3px;
      border: none;
      cursor: pointer;
      background-color: #ddd;
    }
  </style>
</head>

<body id="homepage">
  <nav class="navbar navbar-expand-sm navbar-dark bg-white">
    <a class="navbar-brand" href="#"><img src="/src/assets/logoBloomie-blu.png" alt="" width="150px"></a>
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

      <div class="col-10 d-flex justify-content-center d-flex flex-column perfil-pg"
        style="margin-top: 5.5vw; margin-left: 20vw; width: 75vw;">
        <div class="perfil-header">
          <span class="perfil-header-info">
            <span class="foto-nome-user">
              <img src="https://source.unsplash.com/random/" alt="">
              <span style="display: flex; flex-direction: row; justify-content: center; align-items: start;">
                <div class="user-info">
                <?php if (isset($nome) && isset($usuario)) : ?>
                  <p style="font-size: 20px; font-weight: 500;"><?php echo $nome; ?></p>
                  <p>@<?php echo $usuario; ?></p>
                  <?php else : ?>
                    <p>Dados do usuário não encontrados.</p>
                <?php endif; ?>
                </div>
                <i class="ph ph-pencil-simple"></i>
              </span>
            </span>
            <button>Editar perfil</button>
          </span>
        </div>

        <div class="perfil-container">
          <div class="perfil-left">
            <div class="perfil-left-item">
              <span style="display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 10px;">
                <h2>Sobre</h2>
                <i class="ph ph-pencil-simple"></i>
              </span>
              <p style="margin-top: 10px;">Quer deixar seu perfil ainda mais incrível? A área 'Sobre' é perfeita pra
                você compartilhar suas
                paixões, conquistas e o que te inspira a crescer. Coloque um toque pessoal e vem florescer! :)</p>
            </div>
            <div class="perfil-left-item">
              <span>
                <h2>Meu Perfil DISC é... <span style="font-size: 18px; color: #0B528C; display: inline;">Realize o teste
                    agora.</span></h2>
              </span>
            </div>
            <div class="perfil-left-item">
              <span style="display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 10px;">
                <h2>Bloomigos</h2>
                <p
                  style="color: #fff; background-color: #5AB5FF; font-weight: 500; padding: 0px 40px; border-radius: 15px;">
                  3</p>
                <i class="ph ph-lock-open"></i>
              </span>
              <p style="margin-top: 0px;">Suas conexões estão aqui. Clique em <span
                  style="color: #0B528C; display: inline;">></span> pra fazer
                alterações.</p>
              <span class="bloomigos-container-perfil" style="margin-top: 10px;">
                <div class="bloomigo-perfil">
                  <img src="https://source.unsplash.com/random/80x80" alt="">
                  <p style="color: #0B528C;">Usuário 1</p>
                </div>
                <div class="bloomigo-perfil">
                  <img src="https://source.unsplash.com/random/80x80" alt="">
                  <p style="color: #0B528C;">Usuário 1</p>
                </div>
                <div class="bloomigo-perfil">
                  <img src="https://source.unsplash.com/random/80x80" alt="">
                  <p style="color: #0B528C;">Usuário 1</p>
                </div>
              </span>
            </div>
          </div>

          <div class="perfil-left">
            <div class="perfil-left-item">
              <span style="display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 10px;">
                <h2>Interesses</h2>
                <i class="ph ph-pencil-simple"></i>
              </span>
              <p style="margin-top: 10px;">Ainda não há nada por aqui. Para preencher, escreva 1 interesse e clique em +
                para adicionar ao perfil.</p>
              <div class="content">
                <ul id="tagUl"></ul>
                <input id="tagInput" type="text" />
              </div>

            </div>

            <div class="perfil-left-item">
              <span style="display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 10px;">
                <h2>Posts</h2>
              </span>
              <div class="row-cols-1 justify-content-center align-items-center col-10 post-container-item perfil-post-container" style="margin-top: 15px; width: 100%; padding: 1vw;">
                <div class="col">
                  <div class="postagem-user">
                    <img src="https://source.unsplash.com/random/" alt="">
                    <span>
                      <p style="font-weight: 600; font-size: 15px;">Nome do Usuário</p>
                      <p style="color: #45abff; font-size: 12px;">22/06/2023</p>
                    </span>
                  </div>
                </div>
                <div class="col">
                  <p style="font-size: 15px;">Descubra a essência que impulsiona a Bloomie e transforma
                    vidas. Conheça nossa visão de conectar
                    estudantes a oportunidades de crescimento pess... <span style="font-weight: 500;">Ler mais.</span></p>
                </div>
                <div class="col doc-post">
                  <span style="display: flex; gap: 5px; width: max-content; justify-content: center; align-items: center;">
                    <i class="ph ph-file-text" style="font-size: 20px;"></i>
                    <a href="" style="font-size: 15px;">bloomie.pdf</a>
                  </span>
                </div>
                <div class="col img-post">
                  <img src="https://source.unsplash.com/random/" alt="" style="height: 8vw;">
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
              <div class="perfil-next-post">
                
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

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

  <script src="../pages/tags.js"></script>

</body>

</html>