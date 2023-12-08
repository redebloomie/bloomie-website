<?php
include('connect.php');

// Verifique se o ID da oportunidade está presente na URL
if (isset($_GET['id'])) {
  $idUser = $_GET['id'];

  // Consulta para obter os detalhes completos da oportunidade com base no ID
  $detalhesQuery = "SELECT * FROM usuario WHERE ID_usuario = $idUser";

  $detalhesResult = mysqli_query($conexao, $detalhesQuery);

  // Verifique se há resultados
  if ($detalhesResult && mysqli_num_rows($detalhesResult) > 0) {
      $detalhes = mysqli_fetch_assoc($detalhesResult);

      // Agora, $detalhes incluirá informações do post, foto_perfil e usuário
      $fotoPerfil = $detalhes['foto_perfil'];
      $usuario = $detalhes['usuario'];

      // Faça o que precisar com $fotoPerfil e $usuario
  } else {
      echo 'Post não encontrado.';
  }
} else {
  echo 'ID do post não fornecido.';
}


// Fechar a conexão
mysqli_close($conexao);
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Banir usuário</title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.css"
    />

    <link rel="stylesheet" href="../../public/style.css" />

    <link rel="shortcut icon" href="../assets/bluBloomie.png" />

    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <script
      src="https://kit.fontawesome.com/fec6e5d711.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>

  <body id="homepage">
    <nav class="navbar navbar-expand-sm navbar-dark bg-white">
      <a class="navbar-brand" href="adm.php"
        ><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"
      /></a>
    </nav>

    <main>
      <div class="row justify-content-start align-items-start g-0">
        <div class="col-2 bg-primary sidebar-container">
          <div class="container text-center sidebar">
            <div
              class="row row-cols-1 justify-content-around align-items-center g-5"
            >
              <div class="col">
                <span class="searchbar rounded-4">
                  <i class="ph ph-magnifying-glass"></i>
                  <input type="text" name="" id="" placeholder="Buscar..." />
                </span>
              </div>
              <div class="col">
                <div
                  class="row row-cols-1 justify-content-start align-items-center g-3 text-start"
                >
                  <div class="col text-white sidebar-op">
                    <i class="ph ph-house"></i>
                    <a
                      href="../pages/homepage-postagens.html"
                      class="text-decoration-none text-white"
                      >Dasboard</a
                    >
                  </div>
                  <div class="col text-white sidebar-op">
                    <i class="ph ph-plant"></i>
                    <a
                      href="../pages/perfil.html"
                      class="text-decoration-none text-white"
                      >Oportunidades</a
                    >
                  </div>
                  <div class="col text-white sidebar-op">
                    <i class="ph ph-article"></i>
                    <a href="" class="text-decoration-none text-white"
                      >Postagens</a
                    >
                  </div>
                  <div class="col text-white sidebar-op">
                    <i class="ph ph-user"></i>
                    <a href="" class="text-decoration-none text-white"
                      >Usuários</a
                    >
                  </div>
                </div>
              </div>
              <div class="col">
                <a href="" class="text-decoration-none text-white">Sair</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <section
        class="container col-12 col-sm-10 col-md-10 col-lg-9 admleft"
        style="margin-top: 5rem; height: max-content;"
      >
        <p class="h3 txtT">Banir usuário</p>
        <div class="border border-primary rounded-4 col-12 col-md-12 p-3">
          <div class="d-flex align-items-center col-10 col-md-10">
            <div class="d-flex align-items-center col-12 col-md-10 mb-4">
              <img src="<?php echo $fotoPerfil ?>"
                class="bg-black rounded-5 col-4"
                style="width: 50px; height: 50px object-fit: cover;"
              >
              <div class="d-flex linha col-12">
                <p class="txtj mb-0" style="margin-left: 1vw">@<?php echo $usuario ?></p>
              </div>
            </div>
          </div>
          <p class="txtj">Criado em:</p>
          <div class="col-12 col-md-6 col-lg-4 mb-4">
            <p
              class="form-control rounded-4"
              style="border-color: #1185e3"><?php echo $detalhes['data_criacao'] ?></p>
          </div>
          <p class="txtj">Motivo:</p>
          <div class="form-group mb-5">
            <textarea
              class="form-control"
              id="motivo"
              style="border-color: #1185e3; resize: none"
              rows="3"
            ></textarea>
          </div>

          <div class="d-flex justify-content-center align-items-center">
            <a href="adm_usuarios.php"
              class="btn btn-success btn-lg col-md-3 mx-3"
              style="height: 7vh"
            >
              <span>Cancelar</span>
            </a>
            <button
              class="btn btn-danger btn-lg col-md-3 mx-3"
              style="height: 7vh" onclick="atualizarStatus(<?php echo $detalhes['ID_usuario'] ?>)">
              <span>Confirmar</span>
            </button>
          </div>
        </div>
      </section>

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
    </main>

    <script>
      function atualizarStatus(ID_usuario) {
        var motivo = document.getElementById('motivo').value; // Obtenha o valor do motivo

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'adm_banirUsuario.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            var responseData = JSON.parse(xhr.responseText);
            console.log(responseData.response);
            window.location.href = 'adm_usuarios.php';
          }
        };

        // Inclua o motivo na requisição
        var dados = 'ID_usuario=' + ID_usuario + '&motivo=' + encodeURIComponent(motivo);
        xhr.send(dados);
      }
    </script>

    <footer>
      <!-- place footer here -->
    </footer>
    <script src="./bottom_tab.js"></script>
    <!-- Bootstrap JavaScript Libraries -->

    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
      integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
      crossorigin="anonymous"
    ></script>

    <script src="/public/script.js"></script>
  </body>
</html>
