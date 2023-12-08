<?php
session_start();
include('connect.php');

$limit = 3; // Defina o limite desejado

// Verifica se o campo tipo_personalidade do usuário está vazio
if (empty($_SESSION['personalidade'])) {
    // Se estiver vazio, exibe oportunidades de todas as personalidades

    // Estágio
    $estagios = $conexao->query("SELECT * FROM oportunidade WHERE categoria = 'Estágios' ORDER BY data_publicacao DESC LIMIT $limit");

    // Aprendizado
    $aprendizado = $conexao->query("SELECT * FROM oportunidade WHERE categoria = 'Aprendizados' ORDER BY data_publicacao DESC LIMIT $limit");

    // Bolsas de Estudo
    $bolsas_estudo = $conexao->query("SELECT * FROM oportunidade WHERE categoria = 'Bolsas de Estudo' ORDER BY data_publicacao DESC LIMIT $limit");

    // Concursos e Competições
    $concursos_competicoes = $conexao->query("SELECT * FROM oportunidade WHERE categoria = 'Concursos e Competições' ORDER BY data_publicacao DESC LIMIT $limit");

    // Voluntariado
    $voluntariado = $conexao->query("SELECT * FROM oportunidade WHERE categoria = 'Voluntariado' ORDER BY data_publicacao DESC LIMIT $limit");
} else {
    // Se não estiver vazio, exibe oportunidades apenas da personalidade do usuário
    $tipo_personalidade = $_SESSION['personalidade'];

    // Estágio
    $estagios = $conexao->query("SELECT * FROM oportunidade WHERE categoria = 'Estágios' AND tipo_personalidade = '$tipo_personalidade' ORDER BY data_publicacao DESC LIMIT $limit");

    // Aprendizado
    $aprendizado = $conexao->query("SELECT * FROM oportunidade WHERE categoria = 'Aprendizados' AND tipo_personalidade = '$tipo_personalidade' ORDER BY data_publicacao DESC LIMIT $limit");

    // Bolsas de Estudo
    $bolsas_estudo = $conexao->query("SELECT * FROM oportunidade WHERE categoria = 'Bolsas de Estudo' AND tipo_personalidade = '$tipo_personalidade' ORDER BY data_publicacao DESC LIMIT $limit");

    // Concursos e Competições
    $concursos_competicoes = $conexao->query("SELECT * FROM oportunidade WHERE categoria = 'Concursos e Competições' AND tipo_personalidade = '$tipo_personalidade' ORDER BY data_publicacao DESC LIMIT $limit");

    // Voluntariado
    $voluntariado = $conexao->query("SELECT * FROM oportunidade WHERE categoria = 'Voluntariado' AND tipo_personalidade = '$tipo_personalidade' ORDER BY data_publicacao DESC LIMIT $limit");
}

// Restante do seu código para exibir as oportunidades


?>

<!doctype html>
<html lang="en">

<head>
  <title>Homepage - Oportunidades</title>
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
<nav class="navbar navbar-expand-sm navbar-dark bg-white" id="nav-principal" style="display:flex;">
    <a class="navbar-brand" href="homepage-postagens.php"><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"></a>
    <div class="botoes-nav">
      <ul class="navbar-nav me-auto mt-2 mt-lg-0" style="display: flex; flex-direction: row; gap: 10px;">
        <li class="nav-item">
          <a href="homepage-postagens.php"><button type="button" id="btnPostagens" class="btn"
            style="color: #5AB5FF; font-weight: 500; font-weight: 500;">Postagens</button></a>
        </li>
        <li class="nav-item">
          <a href="homepage-oportunidades-nm.php"><button type="button" id="btnOportunidades" class="btn"
            style="background-color: #0C5D9E; color: #fff; border-radius: 15px; width: 150px;">Oportunidades</button></a>
        </li>
      </ul>
    </div>
  </nav>

  <main>
  <div class="row g-0" id="feed-all-container" style="display: flex; flex-direction: row; justify-content: start; align-items: start;">
      <div class="col-md-2 col-sm-0 d-sm-none d-md-flex bg-primary sidebar-container">
        <div class="container text-center sidebar">
          <div class="row row-cols-1 d-flex justify-content-around align-items-center g-5">
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
            <div class="col text-white" style="display: flex; flex-direction: row; justify-content: center; align-items: center; gap: 5px;">
              <i class="ph ph-sign-out" style="font-size: 20px"></i>
              <a href="sair.php" class="text-decoration-none text-white">Sair</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-10 col-10 col-sm-10 d-flex justify-content-center pg-postagens pg-oportunidades ms-auto me-auto" id="feed-all-container1o" style="">
        <div id="feed-oportunidades" class="row-cols-1 justify-content-center align-items-center g-0 col-md-12 col-10 conteudo">
          <div class="col-12 justify-content-center align-items-center">
            <div class="row-cols-1 justify-content-center align-items-center g-2">
              <div class="col row-cols-1 justify-content-center align-items-center g-2">
              <?php
                // Verificar se o usuário está autenticado
                if (isset($_SESSION['ID_usuario'])) {
                    // Se estiver autenticado, você pode acessar os dados do usuário da sessão
                    $idUsuario = $_SESSION['ID_usuario']; // Assumindo que você tenha um campo 'id_usuario' na sua tabela de usuários

                    // Conectar ao banco de dados (utilize suas credenciais)
                    include('connect.php');

                    // Consulta para obter o tipo_personalidade do usuário
                    $query = "SELECT personalidade FROM usuario WHERE ID_usuario = $idUsuario";
                    $result = mysqli_query($conexao, $query);

                    if ($result) {
                        // Verificar se há resultados
                        if ($row = mysqli_fetch_assoc($result)) {
                            $tipoPersonalidade = $row['personalidade'];

                            // Agora você tem $tipoPersonalidade para verificar se é vazio ou não
                            if (empty($tipoPersonalidade)) {
                                // O usuário não tem personalidade
                                // Exibir a mensagem e link para o teste DISC
                                echo '
                                    <div class="col-12 col-sm-10 col-md-10 col-lg-10">
                                    <div class="col top-oportunidades">
                                        <h2>Ops, não conseguimos recomendar nada!<br>Faça nosso Teste DISC e desbloqueie suas recomendações.</h2>
                                    </div>
                                        <div class="oportunidade-container-expand col-md-12 col-sm-12 p-2" style="margin-top: 30px; justify-content: start; align-items: center; height: max-content; gap: 5px;">
                                            <div class="oportunidade-expand-foto col-4">
                                                <img src="../assets/blu-disc.png" alt="" style="height: 40vh; width: 90%;">
                                            </div>
                                            <div class="oportunidade-expand-info col-8">
                                                <h2 class="" style="margin: 0;">Realize nosso Teste DISC e receba oportunidades personalizadas.</h2>
                                                <p class="" style="margin: 0; font-size: 15px; font-weight: 400; word-wrap: break-word; max-width: 100%;">Descubra seu perfil e acesse o que há de melhor pra você.</p>
                                                <a href="../pages/testeDISC.html" class="btn btn-primary col-11 rounded-3 bold">
                                                    Realizar Teste DISC
                                                </a>
                                            </div>
                                        </div>
                                    </div>';
                            } else {
                                // O usuário tem personalidade
                                // Exibir a mensagem e o filtro
                                echo '
                                <div class="col-sm-12 col-md-10 top-oportunidades">
                                    <h2>Tem oportunidade quentinha por aqui!</h2>
                                    <span>
                                        <p style="font-size: 18px;">Recomendações com base no seu perfil:</p>
                                    </span>
                                </div>';

                                // Consulta para obter a oportunidade mais clicada da semana
                                $queryOportunidadeMaisClicada = "SELECT o.*, COUNT(a.ID_acesso) as total_cliques 
                                                                FROM oportunidade o
                                                                LEFT JOIN acessos_oportunidade a ON o.ID_oportunidade = a.ID_oportunidade
                                                                WHERE o.tipo_personalidade = $tipoPersonalidade AND a.data_acesso >= CURDATE() - INTERVAL 1 WEEK
                                                                GROUP BY o.ID_oportunidade
                                                                ORDER BY total_cliques DESC
                                                                LIMIT 1";

                                $resultOportunidadeMaisClicada = mysqli_query($conexao, $queryOportunidadeMaisClicada);

                                // Verificar se há resultados
                                if ($resultOportunidadeMaisClicada && mysqli_num_rows($resultOportunidadeMaisClicada) > 0) {
                                    // Recuperar os dados da oportunidade mais clicada
                                    $oportunidadeMaisClicada = mysqli_fetch_assoc($resultOportunidadeMaisClicada);

                                    // Exibir a oportunidade mais clicada
                                    echo '
                                    <div class="col-10">
                                        <div class="oportunidade-container-expand col-md-12 col-sm-12 p-2" style="margin-top: 30px; justify-content: start; align-items: center; height: max-content; gap: 5px;">
                                            <div class="oportunidade-expand-foto col-4">
                                                <p class="tipo-oportunidade" style="margin: 5px;">' . $oportunidadeMaisClicada['categoria'] . '</p>
                                                <img src="' . $oportunidadeMaisClicada['imagem'] . '" alt="" style="height: 40vh; width: 90%;">
                                            </div>
                                            <div class="oportunidade-expand-info col-8">
                                                <h2 class="" style="font-size: 25px; margin: 0;">' . $oportunidadeMaisClicada['titulo'] . '</h2>
                                                <span class="oportunidade-datas span-row">
                                                    <p class="" style="margin: 0;"><span style="color: #1289EA; font-size: 18px;">Prazo:</span> ' . $oportunidadeMaisClicada['tempo_expirar'] . '</p>
                                                    <p class="" style="margin: 0;"><span style="color: #1289EA; font-size: 18px;">Faixa etária:</span> ' . $oportunidadeMaisClicada['faixa_etaria'] . '</p>
                                                </span>
                                                <p class="" style="margin: 0; font-size: 15px; font-weight: 400; word-wrap: break-word; max-width: 100%;">'. substr($oportunidadeMaisClicada['descricao'], 0, 100) . (strlen($oportunidadeMaisClicada['descricao']) > 100 ? '...' : '') .' <span style="font-weight: 500;">Ler mais.</span></p>
                                                <p class="mb-1" style="margin: 0; font-size: 15px; font-weight: 400; word-wrap: break-word; max-width: 100%;background-color: #F2C934; color: #0C5D9E; font-weight: 500; border-radius: 15px; padding: 0 15px;">'.$oportunidadeMaisClicada['tipo'].'</p>
                                                <a href="oportunidade.php?id=' . $oportunidadeMaisClicada['ID_oportunidade'] . '" class="btn btn-primary col-11 rounded-3 bold">
                                                    Acessar oportunidades
                                                </a>
                                            </div>
                                        </div>
                                    </div>';
                                } else {
                                    // Se não houver oportunidade mais clicada, exiba uma mensagem alternativa
                                    echo '
                                    <div class="col-12">
                                        <div class="oportunidade-container-expand col-sm-12" style="margin-top: 30px;">
                                            <p>Nenhuma oportunidade encontrada na última semana.</p>
                                        </div>
                                    </div>';
                                }
                            }
                        } else {
                            // Tratar caso não haja resultados da consulta
                            echo 'Erro ao obter dados do usuário.';
                        }

                        // Fechar a conexão
                        mysqli_close($conexao);
                    } else {
                        // Tratar caso haja erro na execução da consulta
                        echo 'Erro na consulta ao banco de dados.';
                    }
                } else {
                    // Se não estiver autenticado, redirecione para a página de login
                    header("Location: ../pages/login.html");
                    exit();
                }
              ?>

              </div>

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
                <div class="col op-lista-bottom" style="margin-top: 20px; margin-bottom: 40px; display: flex; flex-direction: row; justify-content: start; align-items: center; position: relative; gap: 2vw;">
                  <?php
                  while ($opor = $estagios->fetch_assoc()) {
                      echo '
                      <div>
                          <div class="row-cols-1 justify-content-center align-items-center g-2">
                              <div class="col image-container">
                                  <img src="'. $opor['imagem'].'" alt="" style="width:14vw; height:14vw; object-fit:cover;">
                                  <div class="overlay" style="color: #0C5D9E; width:14vw; height:14vw;">'. substr($opor['descricao'], 0, 50) . (strlen($opor['descricao']) > 50 ? ' Ler mais...' : '') .'</div>
                              </div>
                              <div class="col" style="margin-top: 10px;">
                                  <p style="font-weight: 500; font-size: 15px;">'. $opor['titulo'] .'</p>
                                  <p style="font-size:12px"><span style="font-weight: 500; color: #1185E3;">Prazo:</span> '.$opor['tempo_expirar'].'</p>
                                  <p style="font-size:12px"><span style="font-weight: 500; color: #1185E3;">Faixa etária:</span> '.$opor['faixa_etaria'].'</p>
                              </div>
                              <div class="col">
                                  <a href="oportunidade.php?id='. $opor['ID_oportunidade'] .'" class="btn btn-primary col-12" style="padding: 2px 0; font-weight: 500; font-size: 15px; margin-top: 10px;">Saiba mais</a>
                              </div>
                          </div>
                      </div>';
                  }
                  // Verifica se há pelo menos uma oportunidade para exibir a seta
                  if ($estagios->num_rows > 0) {
                      echo '
                      <div class="col-1" style="position: absolute; right:0;">
                          <div class="row-cols-1 justify-content-center align-items-center g-2" style="height: 100%;">
                              <a href="categoria.php?categoria=estagios" style="height: 100%; display: flex; justify-content: center; align-items: center; text-decoration: none; font-size: 40px; color: #1185E3;"><i class="ph ph-caret-right"></i></a>
                          </div>
                      </div>';
                  }else{
                    echo 'Nenhuma oportunidade encontrada.';
                  }
                  ?>
              </div>

              </div>

              <div class="col row-cols-1 justify-content-center align-items-center g-2 op-lista"
                style="margin-top: 30px;">
                <div class="col op-lista-top">
                  <span
                    style="display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 1vw;">
                    <h2 style="margin: 0; color: #1185E3; display: flex; justify-content: center; align-items: center;">
                      Aprendizado</h2>
                    <p
                      style="margin: 0; font-size: 15px; background-color: #0C5D9E; color: #fff; border-radius: 15px; padding: 0 15px; font-weight: 500;">
                      Crescimento Acadêmico</p>
                  </span>
                </div>
                <div class="col op-lista-bottom" style="margin-top: 20px; margin-bottom: 40px; display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 3vw; position: relative;">
                  <?php
                  while ($opor = $aprendizado->fetch_assoc()) {
                      echo '
                      <div>
                          <div class="row-cols-1 justify-content-center align-items-center g-2">
                            <div class="col image-container">
                                <img src="'. $opor['imagem'].'" alt="" style="width:14vw; height:14vw; object-fit:cover;">
                                <div class="overlay" style="color: #0C5D9E; width:14vw; height:14vw;">'. substr($opor['descricao'], 0, 50) . (strlen($opor['descricao']) > 50 ? ' Ler mais...' : '') .'</div>
                            </div>
                            <div class="col" style="margin-top: 10px;">
                                <p style="font-weight: 500; font-size: 15px;">'. $opor['titulo'] .'</p>
                                <p style="font-size:12px"><span style="font-weight: 500; color: #1185E3;">Prazo:</span> '.$opor['tempo_expirar'].'</p>
                                <p style="font-size:12px"><span style="font-weight: 500; color: #1185E3;">Faixa etária:</span> '.$opor['faixa_etaria'].'</p>
                            </div>
                            <div class="col">
                                <a href="oportunidade.php?id='. $opor['ID_oportunidade'] .'" class="btn btn-primary col-12" style="padding: 2px 0; font-weight: 500; font-size: 18px; margin-top: 10px;">Saiba mais</a>
                            </div>
                          </div>
                      </div>';
                  }
                  // Verifica se há pelo menos uma oportunidade para exibir a seta
                  if ($aprendizado->num_rows > 0) {
                      echo '
                      <div class="col-1" style="position: absolute; right:0;">
                      <div class="row-cols-1 justify-content-center align-items-center g-2" style="height: 100%;">
                      <a href="categoria.php?categoria=aprendizado" style="height: 100%; display: flex; justify-content: center; align-items: center; text-decoration: none; font-size: 40px; color: #1185E3;"><i class="ph ph-caret-right"></i></a>
                  </div>
                      </div>';
                  }else{
                    echo 'Nenhuma oportunidade encontrada.';
                  }
                  ?>
                </div>

              </div>

              <div class="col row-cols-1 justify-content-center align-items-center g-2 op-lista"
                style="margin-top: 30px;">
                <div class="col op-lista-top">
                  <span
                    style="display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 1vw;">
                    <h2 style="margin: 0; color: #1185E3; display: flex; justify-content: center; align-items: center;">
                      Bolsas de Estudo</h2>
                    <p
                      style="margin: 0; font-size: 15px; background-color: #0C5D9E; color: #fff; border-radius: 15px; padding: 0 15px; font-weight: 500;">
                      Crescimento Acadêmico</p>
                  </span>
                </div>
                <div class="col op-lista-bottom" style="margin-top: 20px; margin-bottom: 40px; display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 3vw; position: relative;">
                  <?php
                  while ($opor = $bolsas_estudo->fetch_assoc()) {
                      echo '
                      <div>
                          <div class="row-cols-1 justify-content-center align-items-center g-2">
                          <div class="col image-container">
                              <img src="'. $opor['imagem'].'" alt="" style="width:14vw; height:14vw; object-fit:cover;">
                              <div class="overlay" style="color: #0C5D9E; width:14vw; height:14vw;">'. substr($opor['descricao'], 0, 50) . (strlen($opor['descricao']) > 50 ? ' Ler mais...' : '') .'</div>
                          </div>
                          <div class="col" style="margin-top: 10px;">
                              <p style="font-weight: 500; font-size: 15px;">'. $opor['titulo'] .'</p>
                              <p style="font-size:12px"><span style="font-weight: 500; color: #1185E3;">Prazo:</span> '.$opor['tempo_expirar'].'</p>
                              <p style="font-size:12px"><span style="font-weight: 500; color: #1185E3;">Faixa etária:</span> '.$opor['faixa_etaria'].'</p>
                          </div>
                          <div class="col">
                              <a href="oportunidade.php?id='. $opor['ID_oportunidade'] .'" class="btn btn-primary col-12" style="padding: 2px 0; font-weight: 500; font-size: 18px; margin-top: 10px;">Saiba mais</a>
                          </div>
                          </div>
                      </div>';
                  }
                  // Verifica se há pelo menos uma oportunidade para exibir a seta
                  if ($bolsas_estudo->num_rows > 0) {
                      echo '
                      <div class="col-1" style="position: absolute; right:0;">
                      <div class="row-cols-1 justify-content-center align-items-center g-2" style="height: 100%;">
                      <a href="categoria.php?categoria=bolsas_estudo" style="height: 100%; display: flex; justify-content: center; align-items: center; text-decoration: none; font-size: 40px; color: #1185E3;"><i class="ph ph-caret-right"></i></a>
                  </div>
                      </div>';
                  }else{
                    echo 'Nenhuma oportunidade encontrada.';
                  }
                  ?>
              </div>

              </div>

              <div class="col row-cols-1 justify-content-center align-items-center g-2 op-lista"
                style="margin-top: 30px;">
                <div class="col op-lista-top">
                  <span
                    style="display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 1vw;">
                    <h2 style="margin: 0; color: #1185E3; display: flex; justify-content: center; align-items: center;">
                      Concursos e Competições</h2>
                    <p
                      style="margin: 0; font-size: 15px; background-color: #0C5D9E; color: #fff; border-radius: 15px; padding: 0 15px; font-weight: 500;">
                      Crescimento Acadêmico</p>
                  </span>
                </div>
                <div class="col op-lista-bottom" style="margin-top: 20px; margin-bottom: 40px; display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 3vw; position: relative;">
                  <?php
                  while ($opor = $concursos_competicoes->fetch_assoc()) {
                      echo '
                      <div>
                          <div class="row-cols-1 justify-content-center align-items-center g-2">
                          <div class="col image-container">
                              <img src="'. $opor['imagem'].'" alt="" style="width:14vw; height:14vw; object-fit:cover;">
                              <div class="overlay" style="color: #0C5D9E; width:14vw; height:14vw;">'. substr($opor['descricao'], 0, 50) . (strlen($opor['descricao']) > 50 ? ' Ler mais...' : '') .'</div>
                          </div>
                          <div class="col" style="margin-top: 10px;">
                              <p style="font-weight: 500; font-size: 15px;">'. $opor['titulo'] .'</p>
                              <p style="font-size:12px"><span style="font-weight: 500; color: #1185E3;">Prazo:</span> '.$opor['tempo_expirar'].'</p>
                              <p style="font-size:12px"><span style="font-weight: 500; color: #1185E3;">Faixa etária:</span> '.$opor['faixa_etaria'].'</p>
                          </div>
                          <div class="col">
                              <a href="oportunidade.php?id='. $opor['ID_oportunidade'] .'" class="btn btn-primary col-12" style="padding: 2px 0; font-weight: 500; font-size: 18px; margin-top: 10px;">Saiba mais</a>
                          </div>
                          </div>
                      </div>';
                  }
                  // Verifica se há pelo menos uma oportunidade para exibir a seta
                  if ($concursos_competicoes->num_rows > 0) {
                      echo '
                      <div class="col-1" style="position: absolute; right:0;">
                      <div class="row-cols-1 justify-content-center align-items-center g-2" style="height: 100%;">
                      <a href="categoria.php?categoria=conc_comp" style="height: 100%; display: flex; justify-content: center; align-items: center; text-decoration: none; font-size: 40px; color: #1185E3;"><i class="ph ph-caret-right"></i></a>
                  </div>
                      </div>';
                  }else{
                    echo 'Nenhuma oportunidade encontrada.';
                  }
                  ?>
              </div>

              </div>

              <div class="col row-cols-1 justify-content-center align-items-center g-2 op-lista"
                style="margin-top: 30px;">
                <div class="col op-lista-top">
                  <span
                    style="display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 1vw;">
                    <h2 style="margin: 0; color: #1185E3; display: flex; justify-content: center; align-items: center;">
                      Voluntariado</h2>
                    <p
                      style="margin: 0; font-size: 15px; background-color: #0C5D9E; color: #fff; border-radius: 15px; padding: 0 15px; font-weight: 500;">
                      Crescimento Acadêmico</p>
                  </span>
                </div>
                <div class="col op-lista-bottom" style="margin-top: 20px; margin-bottom: 40px; display: flex; flex-direction: row; justify-content: start; align-items: center; gap: 3vw; position: relative;">
                  <?php
                  while ($opor = $voluntariado->fetch_assoc()) {
                      echo '
                      <div>
                          <div class="row-cols-1 justify-content-center align-items-center g-2">
                              <div class="col image-container">
                              <img src="'. $opor['imagem'].'" alt="" style="width:14vw; height:14vw; object-fit:cover;">
                              <div class="overlay" style="color: #0C5D9E; width:14vw; height:14vw;">'. substr($opor['descricao'], 0, 50) . (strlen($opor['descricao']) > 50 ? ' Ler mais...' : '') .'</div>
                          </div>
                          <div class="col" style="margin-top: 10px;">
                              <p style="font-weight: 500; font-size: 15px;">'. $opor['titulo'] .'</p>
                              <p style="font-size:12px"><span style="font-weight: 500; color: #1185E3;">Prazo:</span> '.$opor['tempo_expirar'].'</p>
                              <p style="font-size:12px"><span style="font-weight: 500; color: #1185E3;">Faixa etária:</span> '.$opor['faixa_etaria'].'</p>
                          </div>
                          <div class="col">
                              <a href="oportunidade.php?id='. $opor['ID_oportunidade'] .'" class="btn btn-primary col-12" style="padding: 2px 0; font-weight: 500; font-size: 18px; margin-top: 10px;">Saiba mais</a>
                          </div>
                          </div>
                      </div>';
                  }
                  // Verifica se há pelo menos uma oportunidade para exibir a seta
                  if ($voluntariado->num_rows > 0) {
                      echo '
                      <div class="col-1" style="position: absolute; right:0;">
                      <div class="row-cols-1 justify-content-center align-items-center g-2" style="height: 100%;">
                      <a href="categoria.php?categoria=voluntariado" style="height: 100%; display: flex; justify-content: center; align-items: center; text-decoration: none; font-size: 40px; color: #1185E3;"><i class="ph ph-caret-right"></i></a>
                  </div>
                      </div>';
                  }else{
                    echo 'Nenhuma oportunidade encontrada.';
                  }
                  ?>
              </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-2 rightsidebar p-0 pg-postagens-leftSidebar d-sm-none d-md-flex ms-auto">
        <div id="sidebar-postagens" class="row-cols-1 justify-content-center align-items-center rightsidebar-group d-sm-none d-md-flex ms-auto">
          <div class="col rounded text-center">
            <div class="container rightsidebar-container-1">
            <?php
              include('connect.php');

              $limit = 1; // Defina o limite desejado

              // Consulta para oportunidades com mais acessos
              $destaques_acessos = $conexao->query("
                  SELECT oportunidade.*, COUNT(acessos_oportunidade.ID_acesso) AS num_acessos
                  FROM oportunidade
                  LEFT JOIN acessos_oportunidade ON oportunidade.ID_oportunidade = acessos_oportunidade.ID_oportunidade
                  GROUP BY oportunidade.ID_oportunidade
                  ORDER BY num_acessos DESC
                  LIMIT $limit
              ");

              if ($destaques_acessos->num_rows > 0) {
                  $destaque = $destaques_acessos->fetch_assoc();
                  // Verifica se há resultados
                  if ($destaque) {
           
            ?>
              <div class="row-cols-1 destaques justify-content-center align-items-center g-0">
                <div class="col destaques-top text-nowrap">
                  <p style="color: #1289EA; font-weight: 500;">Destaques da semana</p>
                  <p style="color: #DBAC01; font-weight: 500;">Arraste e confira!</p>
                </div>
                <div class="col text-start destaques-post">
                  <span style="display:flex; flex-direction: collumn;" class="destaques-post-user">
                    <p style="margin: 0; font-weight: 600; font-size: 18px;"><a href="oportunidade.php?id=<?php echo $destaque['ID_oportunidade']; ?>" style="text-decoration: none; color: #1185E3;"><?php echo $destaque['titulo']; ?></a></p>
                    <p style="margin: 0;"><span style="color: #1185E3; font-weight: 500;">Prazo: </span><?php echo $destaque['tempo_expirar']; ?></p>
                    <p style="margin: 0;"><span style="color: #1185E3; font-weight: 500;">Faixa Etária: </span><?php echo $destaque['faixa_etaria']; ?></p>
                  </span>
                  <div style="display:flex; flex-direction: column;" class="destaques-post-text">
                    <p><?php echo substr($destaque['descricao'], 0, 50) . (strlen($destaque['descricao']) > 50 ? '...' : ''); ?></p>
                    <span class="destaques-post-tags">
                      <p style="background-color: #F2C934;">#educação</p>
                      <p style="background-color: #5AB5FF;">#redesocial</p>
                    </span>
                  </div>
                </div>
                <div class="col dots"
                  style="display:flex; flex-direction: row; justify-content: center; align-items: center;">
                  <div class="dot" style="background-color: #1185E3;"></div>
                  <div class="dot" style="background-color: #0C5D9E;"></div>
                  <div class="dot" style="background-color: #DBAC01;"></div>
                </div>
              </div>

              <?php
                  } else {
                      echo 'Nenhum destaque encontrado.';
                  }
                } else {
                    echo 'Erro na consulta ao banco de dados: ' . $conexao->error . ' SQL: ' . $sql;
                }

                // Fechar a conexão com o banco de dados
                $conexao->close();
              ?>
            </div>
          </div>
          <div class="col rounded text-center">
            <div class="container rightsidebar-container-2">
              <div class="row-cols-1 justify-content-center align-items-center g-0">
                <div class="col destaques-bloomigos">
                  <p style="color: #1289EA; font-weight: 500;">Dica da Blu!</p>
                  <p style="color: #DBAC01; font-weight: 500;">Oportunidades sugeridas pela florzinha azul.</p>
                </div>
                <div class="col">
                  <div class="rows-cols-1 justify-content-center align-items-center g-1">
                  <?php
                    include('connect.php');

                    // Consulta SQL para obter as 5 oportunidades mais clicadas
                    $query = "SELECT o.*, COUNT(a.ID_acesso) AS total_cliques
                    FROM oportunidade o
                    LEFT JOIN acessos_oportunidade a ON o.ID_oportunidade = a.ID_oportunidade
                    GROUP BY o.ID_oportunidade
                    LIMIT 5";
                    $result = mysqli_query($conexao, $query);

                    // Exibir as oportunidades
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <a href="oportunidade.php?id=' . $row['ID_oportunidade'] . '" style="text-decoration: none;">
                        <div class="col destaques-bloomigos-user">
                            <span style="display:flex; flex-direction: row;">
                                <img src="' . $row['imagem'] . '" alt="Imagem da Oportunidade" style="border-radius: 100%; width: 3vw; height: 3vw;">
                                <span style="display: flex; flex-direction: column; text-align: start;">
                                    <p style="font-weight: 500;">' . $row['titulo'] . '</p>
                                    <p style="font-size: 1vw;">Saiba mais</p>
                                </span>
                            </span>
                        </div>
                        </a>';
                    }

                    if (!$result) {
                      die("Erro na consulta SQL: " . mysqli_error($conexao));
                  }

                    // Fechar a conexão
                    mysqli_close($conexao);
                  ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="line-division"></div>
      </div>
    </div>

    <!-- Adicione isso ao seu HTML -->
    <nav class="bottom-tab bottom-navigation">
          <a
            href="homepage-oportunidades-nm.php"
            class="text-decoration-none"
          >
            <i class="ph ph-house"></i>
          </a>
          <a href="perfil.php" class="text-decoration-none">
            <i class="ph ph-user"></i>
          </a>
          <div class="bottom-tab-center">
            <div class="bottom-tab-center-inner" id="bottomTabCenter">
              <a href="enviarOportunidade.html">
                <i class="ph ph-plus-circle" id="plusIcon"></i>
              </a>
            </div>
          </div>

          <a href="notificacoesGeral.php" class="text-decoration-none">
            <i class="ph ph-bell"></i>
          </a>

          <a href="configuracoes.php" class="text-decoration-none">
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