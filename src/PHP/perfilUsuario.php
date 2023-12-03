<?php
session_start();
include('connect.php');

// Obtém o ID do usuário do parâmetro na URL
$idUsuario = $_GET['idUsuario'];

// Consulta para obter informações do usuário
$consultaUsuario = $conexao->query("SELECT * FROM usuario WHERE ID_usuario = $idUsuario");

// Verifica se o usuário existe
if ($consultaUsuario->num_rows > 0) {
    $dadosUsuario = $consultaUsuario->fetch_assoc();

    // Consulta para obter postagens do usuário
    $consultaPostagens = $conexao->query("SELECT * FROM post WHERE ID_usuario = $idUsuario");

    // Resto do código para exibir informações do perfil
} else {
    // Usuário não encontrado, redireciona para uma página de erro ou homepage
    header("Location: index.php"); // Altere para a página desejada
    exit();
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
    <a class="navbar-brand" href="homepage-postagens.php"><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"></a>
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

      <div class="col-10 d-flex justify-content-center d-flex flex-column perfil-pg"
        style="margin-top: 5.5vw; margin-left: 20vw; width: 75vw;">
        <!-- Adicione o formulário ao redor dos campos de nome, usuário e foto -->
<form id="perfilForm" method="post" action="salvar_perfil.php" enctype="multipart/form-data">
  <div class="perfil-header">
    <span class="perfil-header-info">
      <span class="foto-nome-user">
        <div class="fotoPerfil-div" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
        <img src="<?php echo $dadosUsuario['foto_perfil']; ?>" alt="Foto de Perfil do Usuário">
          <label for="novaFotoPerfil" style="position: absolute; display:none;" id="novaFotoPerfil-label"><i class="ph ph-pencil"></i></label>
          <input type="file" id="novaFotoPerfil" name="novaFotoPerfil" style="display: none;">
        </div>
        
        <span style="display: flex; flex-direction: row; justify-content: center; align-items: start;">
          <div class="user-info" style="display: flex; flex-direction: column; justify-content: center; align-items: start;">
              <!-- Adicione o atributo contenteditable para tornar os campos editáveis -->
              <span style="display: flex; flex-direction: row; justify-content:center; align-items:center; gap:-2px">
                <input type="text" name="nome" id="nome" class="editavel" contenteditable="false" value="<?php echo $dadosUsuario['nome'] . ' ' . $dadosUsuario['sobrenome']; ?>" readonly style="background:none;margin:0;color:#fff; width:fit-content; max-width:auto">
                <!-- <input type="text" name="sobrenome" id="sobrenome" class="editavel" contenteditable="false" value="" readonly style="background:none;margin:0;color:#fff; width:5vw;"> --> 
              </span>
              <input type="text" name="usuario" id="usuario" class="editavel" contenteditable="false" value="<?php echo $dadosUsuario['usuario']; ?>" readonly style="background:none;margin:-5px 0 0 0;color:#fff;">
          </div>
          <input type="file" id="fotoPerfil" name="fotoPerfil" style="display: none;">
          
          
        </span>
        
      </span>
      <span>
      </span>
    </span>
  </div>
</form>

        <div class="perfil-container">
          <div class="perfil-left">
            <div class="perfil-left-item">
              <span style="display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 10px;">
                <h2>Sobre</h2>
                <!-- <i class="ph ph-pencil-simple"></i> -->
              </span>
              <p style="margin-top: 10px;"><?php echo $dadosUsuario['sobre'];?></p>
            </div>
            <div class="perfil-left-item">
              <span>
                <h2>Meu Perfil DISC é... <span style="font-size: 18px; color: #0B528C; display: inline;"><?php echo $dadosUsuario['personalidade'];?></span></h2>
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
                <!-- <i class="ph ph-pencil-simple"></i> -->
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
              <?php
                while ($post = $consultaPostagens->fetch_assoc()) {
                  echo '
                      <div class="row-cols-1 justify-content-center align-items-center col-10  p-3 post-container-item">
                          <div class="col">
                              <div class="postagem-user">
                                  <img src="' . $dadosUsuario['foto_perfil'] . '" alt="Imagem do usuário">
                                  <span>
                                  <p style="font-weight: 700; font-size: 18px;"><a href="perfilUsuario.php?idUsuario=' . $post['ID_usuario'] . '">' . $post['usuario'] . '</a></p>
                                  </span>
                              </div>
                          </div>
                          <div class="col">
                              <p style="font-size: 18px;">' . $post['texto'] . ' ' . (strlen($post['texto']) > 100 ? '<span style="font-weight: 500;">Ler mais.</span>' : '') . '</p>
                          </div>
                          ' . ($post['imagem'] ? '<div class="col img-post"><img src="' . $post['imagem'] . '" alt="" style="height: 10vw"></div>' : '') . '
                          <div class="col-12 interacoes-post">
                              <div class="options-post">
                                  <div class="rightside-op-post">
                                      <span>
                                          <i class="ph ph-heart"></i>
                                          <p></p>
                                      </span>
                                      <span>
                                          <i class="ph ph-chat-circle"></i>
                                          <p></p>
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
                  ';
                }
                $conexao->close();
              ?>
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

  <script>

  // Adicione um evento de clique ao botão "Cancelar"
  document.getElementById('btnCancelarEdicao').addEventListener('click', function () {
    // Tornar os campos não editáveis
    document.getElementById('nome').contentEditable = false;
    document.getElementById('sobrenome').contentEditable = false;
    document.getElementById('usuario').contentEditable = false;
    // Ocultar os botões de salvar e cancelar
    document.getElementById('btnSalvarPerfil').style.display = 'none';
    this.style.display = 'none';
    // Exibir o botão de editar
    document.getElementById('btnEditarPerfil').style.display = 'inline-block';
  });

  // Adicione um evento de clique ao botão "Editar perfil"
  document.getElementById('btnEditarPerfil').addEventListener('click', function () {
    // Tornar os campos editáveis
    document.getElementById('nome').contentEditable = true;
    document.getElementById('sobrenome').contentEditable = true;
    document.getElementById('usuario').contentEditable = true;
    document.getElementById('nome').removeAttribute('readonly');
    document.getElementById('sobrenome').removeAttribute('readonly');
    document.getElementById('usuario').removeAttribute('readonly');
    // Exibir os botões de salvar e cancelar
    document.getElementById('btnSalvarPerfil').style.display = 'inline-block';
    document.getElementById('btnCancelarEdicao').style.display = 'inline-block';
    document.getElementById('novaFotoPerfil-label').style.display = 'inline-block'; // Exibir o input de file
    // Ocultar o botão de editar
    this.style.display = 'none';
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

</body>

</html>