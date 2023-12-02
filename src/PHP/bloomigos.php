<?php
session_start();
// Conectar ao banco de dados (utilize suas credenciais)
include('connect.php');
$ID_usuario = $_SESSION['ID_usuario'];

// Consulta para obter os 3 últimos amigos
$queryUltimosAmigos = "SELECT u.ID_usuario, u.nome, u.sobrenome, u.usuario, u.foto_perfil
FROM bloomizade b
JOIN usuario u ON b.usuario_id_2 = u.ID_usuario
WHERE b.usuario_id_1 = $ID_usuario
ORDER BY b.data_criacao DESC";

$resultUltimosAmigos = mysqli_query($conexao, $queryUltimosAmigos);

// ---------------------------------------------------------------------------------------------

// Consulta para obter informações do usuário
$consultaUsuario = $conexao->query("SELECT * FROM usuario WHERE ID_usuario = $ID_usuario");

// Verifica se o usuário existe
if ($consultaUsuario->num_rows > 0) {
$dadosUsuario = $consultaUsuario->fetch_assoc();

// Consulta para obter postagens do usuário
$consultaPostagens = $conexao->query("SELECT * FROM post WHERE ID_usuario = $ID_usuario LIMIT 1");

// Resto do código para exibir informações do perfil
} else {
// Usuário não encontrado, redireciona para uma página de erro ou homepage
header("Location: index.php"); // Altere para a página desejada
exit();
}

// Fechar a conexão
mysqli_close($conexao);
?>

<!doctype html>

<html lang="en">

<head>

  <title>AJuda e Suporte</title>
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



<body id="">

  <nav class="navbar navbar-expand-sm navbar-dark bg-white">

    <a class="navbar-brand" href="#"><img src="../assets/logoBloomie-blu.png" alt="" width="150px"></a>

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

                  <a href="" class="text-decoration-none text-white">Home</a>

                </div>

                <div class="col text-white sidebar-op">

                  <i class="ph ph-user"></i>

                  <a href="" class="text-decoration-none text-white">Perfil</a>

                </div>

                <div class="col text-white sidebar-op">

                  <i class="ph ph-bell-ringing"></i>

                  <a href="" class="text-decoration-none text-white">Notificações</a>

                </div>

                <div class="col text-white sidebar-op">

                  <i class="ph ph-plant"></i>

                  <a href="" class="text-decoration-none text-white">Enviar<br>oportunidades</a>

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
      <div class="col-2  " ></div>

      <section class="container col-12 col-md-10 col-lg-10 justify-content-center "
        style="padding-top: 5rem;">
        <div class="d-flex">
          <h3 class="mt-5 txtj">Bloomigos</h3>
          <div class="bg-primary rounded-5 col-3 col-sm-2 col-md-1 col-lg-1 d-flex justify-content-center align-items-center mt-5 mx-4" style="height: 4vh;">
            <span class="text-white h5 mb-0">3</span>
          </div>
          
        </div>
        <h5 class="txtj">Conexões dentro da Bloomie</h5>
        <?php

          // Verifica se há resultados
          if (mysqli_num_rows($resultUltimosAmigos) > 0) {
              $rowCount = 0;
              while ($row = mysqli_fetch_assoc($resultUltimosAmigos)) {
                  // Exiba as informações da oportunidade pendente
                  echo '
                  <div class="d-flex justify-content-between align-items-center ">
                  <div class="d-flex align-items-center col-8 col-sm-6 col-md-6 mt-3 ">
                    <img src="'.$row['foto_perfil'].'" class=" rounded-circle col-4 " style="width: 50px; height: 50px; object-fit: cover">
                    <div class="">
                      <p class=" mb-0 h5 text mg">'.$row['nome'].' '.$row['sobrenome'].'</p>
                      <p id="" class="mb-0 text mg  " style=" color: #5AB5FF;">@'.$row['usuario'].'</p>
                    </div>
                  </div>
                  <div class="d-flex   col-2 col-sm-6 col-md-6  justify-content-end ">
                    
                  <button class="btn btn-danger bt1 rounded-3 h6 col-sm-8 col-md-8 col-lg-5 textb mt-3" onclick="atualizarStatus(' . $ID_usuario . ', ' . $row['ID_usuario'] . ', \'cancelar\')">Desfazer Bloomizade</button>
                  </div>
                </div>
                <div class="bg-primary col-12 mt-3 mb-3" style="height: 1px;"></div>
                  ';
                  $rowCount++;
              }
              } else {
                  echo 'Nenhuma solicitação pendente.';
              }
          ?>

        <nav class="bottom-tab">
          <a
            href="../pages/homepage-postagens.html"
            class="text-decoration-none"
          >
            <i class="ph ph-house"></i>
          </a>
          <a href="../pages/perfil.html" class="text-decoration-none">
            <i class="ph ph-user"></i>
          </a>
          <div class="bottom-tab-center">
            <div class="bottom-tab-center-inner" id="bottomTabCenter">
              <a href="./enviarOportunidade.html">
                <i class="ph ph-plus-circle" id="plusIcon"></i>
              </a>
            </div>
          </div>

          <a href="../PHP/not.php" class="text-decoration-none">
            <i class="ph ph-bell"></i>
          </a>

          <a href="./configuracoes.html" class="text-decoration-none">
            <i class="ph ph-gear"></i>
          </a>
        </nav>




      </section>







  </main>





  <footer>

    <!-- place footer here -->

  </footer>

  <script>
    function atualizarStatus(usuario_id_2, usuario_id_1, acao) {
    // Crie um objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configurar a solicitação AJAX
    xhr.open('POST', 'atualizar_soli.php', true);
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
    var dados = 'usuario_id_2=' + usuario_id_2 + '&usuario_id_1=' + usuario_id_1 + '&acao=' + acao;

    // Enviar a solicitação AJAX com os dados
    xhr.send(dados);
}


  </script>
  
  <script src="./bottom_tab.js"></script>
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