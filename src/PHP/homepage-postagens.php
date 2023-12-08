<?php
session_start();
include('connect.php');

$idUsuario = $_SESSION['ID_usuario'];

// Lógica para buscar a foto do perfil ou definir o valor padrão
$fotoPerfil = ''; // Defina um valor padrão inicial

// Exemplo: Se você estiver buscando a foto do perfil do banco de dados
if (isset($_SESSION['ID_usuario'])) {
    $idUsuario = $_SESSION['ID_usuario'];
    $query = "SELECT foto_perfil FROM usuario WHERE ID_usuario = $idUsuario";
    $result = $conexao->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fotoPerfil = $row['foto_perfil'];
    }
}

// Agora, atribua a variável à sessão
$_SESSION['foto_perfil'] = $fotoPerfil;

$pubs = $conexao->query("SELECT ID_post, ID_usuario, usuario, texto, imagem, data_publicacao FROM post ORDER BY data_publicacao DESC");

if (!$pubs) {
  die('Consulta inválida: ' . $conexao->error);
}

if (isset($_POST['add'])) {
  add();
}

function add() {
  global $conexao;

  $idUsuario = $_SESSION['ID_usuario'];
  $idPostUser = $_POST['idPostUser'];

  $saberr = mysqli_query($conexao, "SELECT * FROM usuario WHERE ID_usuario = $idPostUser");
  $saber = mysqli_fetch_assoc($saberr);

  $ins = "INSERT INTO bloomizade (usuario_id_1, usuario_id_2) VALUES (?, ?)";
  $stmt = mysqli_prepare($conexao, $ins);

  if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ii", $idUsuario, $idPostUser);
      $conf = mysqli_stmt_execute($stmt);

      if ($conf) {
          header("Location: homepage-postagens.php");
          exit();
      } else {
          $error_message = "Erro ao adicionar amigo: " . mysqli_error($conexao);
          echo '<script>console.error("' . $error_message . '");</script>';
      }

      mysqli_stmt_close($stmt);
  } else {
      $error_message = "Erro na preparação da consulta: " . mysqli_error($conexao);
      echo '<script>console.error("' . $error_message . '");</script>';
  }
}


if (isset($_POST['cancel'])) {
  cancel($conexao);
}

function cancel($conexao) {
  $idUsuario = $_SESSION['ID_usuario'];
  $idPostUser = $_POST['idPostUser'];

  $saberr = mysqli_query($conexao, "SELECT * FROM usuario WHERE ID_usuario = $idPostUser");
  $saber = mysqli_fetch_assoc($saberr);

  $ins = "DELETE FROM bloomizade WHERE usuario_id_1 = ? AND usuario_id_2 = ?";
  $stmt = mysqli_prepare($conexao, $ins);
  mysqli_stmt_bind_param($stmt, "ii", $idUsuario, $idPostUser);
  $conf = mysqli_stmt_execute($stmt);

  if ($conf) {
      header("Location: homepage-postagens.php");
  } else {
      echo "erro";
  }
}

if (isset($_POST['remover'])) {
  remover($conexao);
}

function remover($conexao) {
  $idUsuario = $_SESSION['ID_usuario'];
  $idPostUser = $_POST['idPostUser'];

  $saberr = mysqli_query($conexao, "SELECT * FROM usuario WHERE ID_usuario = $idPostUser");
  $saber = mysqli_fetch_assoc($saberr);

  $ins = "DELETE FROM bloomizade WHERE (usuario_id_1 = ? AND usuario_id_2 = ?) OR (usuario_id_1 = ? AND usuario_id_2 = ?)";
  $stmt = mysqli_prepare($conexao, $ins);
  mysqli_stmt_bind_param($stmt, "iiii", $idUsuario, $idPostUser, $idPostUser, $idUsuario);
  $conf = mysqli_stmt_execute($stmt);

  if ($conf) {
      header("Location: homepage-postagens.php");
  } else {
      echo "erro";
  }
}

// Configurações de paginação para oportunidades pendentes
$porPagina = 5;
$paginaAtualPendentes = isset($_GET['pagina_pendentes']) ? $_GET['pagina_pendentes'] : 1;
$offsetPendentes = ($paginaAtualPendentes - 1) * $porPagina;

// Consulta para obter amigos do usuário
$queryAmigos = "SELECT usuario_id_2 FROM bloomizade WHERE usuario_id_1 = $idUsuario AND status_soli = 'aceito'";
$resultAmigos = mysqli_query($conexao, $queryAmigos);

$amigosIDs = [];

while ($row = mysqli_fetch_assoc($resultAmigos)) {
    $amigosIDs[] = $row['usuario_id_2'];
}

// Defina o número desejado de amigos de amigos a serem exibidos
$numAmigosDeAmigosExibidos = 5;

// Inicialize a lista de amigos de amigos
$amigosDeAmigos = [];

// Verifique se há amigos de amigos suficientes para exibir
if (count($amigosIDs) >= $numAmigosDeAmigosExibidos) {
    // Se há amigos de amigos suficientes, liste-os
    $amigosIDsStr = implode(",", $amigosIDs);
    $queryAmigosDeAmigos = "SELECT DISTINCT u.ID_usuario, u.nome, u.usuario, u.foto_perfil, u.sobrenome
                            FROM bloomizade b
                            JOIN usuario u ON b.usuario_id_2 = u.ID_usuario
                            WHERE b.usuario_id_1 IN ($amigosIDsStr)
                            AND b.usuario_id_2 != $idUsuario
                            LIMIT $numAmigosDeAmigosExibidos";

    $resultAmigosDeAmigos = mysqli_query($conexao, $queryAmigosDeAmigos);

    // Adicione os amigos de amigos à lista
    while ($rowAmigoDeAmigo = mysqli_fetch_assoc($resultAmigosDeAmigos)) {
        $amigosDeAmigos[] = $rowAmigoDeAmigo;
    }
} else {
    // Se não houver amigos de amigos suficientes, liste usuários específicos
    $numUsuariosEspecificosExibidos = $numAmigosDeAmigosExibidos - count($amigosIDs);

    if ($numUsuariosEspecificosExibidos > 0) {
        $usuariosEspecificos = [6, 32, 33, 34, 35]; // IDs dos usuários específicos
        $usuariosEspecificosStr = implode(",", $usuariosEspecificos);

        $queryUsuariosEspecificos = "SELECT ID_usuario, nome, usuario, foto_perfil, sobrenome
                                    FROM usuario
                                    WHERE ID_usuario IN ($usuariosEspecificosStr)
                                    LIMIT $numUsuariosEspecificosExibidos";

        $resultUsuariosEspecificos = mysqli_query($conexao, $queryUsuariosEspecificos);

        // Adicione os usuários específicos à lista de amigos de amigos
        while ($rowEspecifico = mysqli_fetch_assoc($resultUsuariosEspecificos)) {
            $amigosDeAmigos[] = $rowEspecifico;
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Homepage - Postagens</title>
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
  <nav class="navbar navbar-expand-sm navbar-dark bg-white" id="nav-principal">
    <a class="navbar-brand" href="homepage-postagens.php"><img src="../assets/logoBloomie-blu.png" alt="" width="150px" style="margin-left: 20px;"></a>
    <div class="botoes-nav">
      <ul class="navbar-nav me-auto mt-2 mt-lg-0" style="display: flex; flex-direction: row; gap: 10px;">
        <li class="nav-item">
          <a href="homepage-postagens.php"><button type="button" id="btnPostagens" class="btn"
            style="background-color: #0C5D9E; color: #fff; font-weight: 500; border-radius: 15px; width: 150px;">Postagens</button></a>
        </li>
        <li class="nav-item">
          <a href="homepage-oportunidades-nm.php"><button type="button" id="btnOportunidades" class="btn"
            style="color: #5AB5FF; font-weight: 500;">Oportunidades</button></a>
        </li>
      </ul>
    </div>
  </nav>

  <main>
    <div class="row g-0" id="feed-all-container" style="display: flex; flex-direction: row; justify-content: start; align-items: start;">
      <div class="col-md-2 col-sm-0 d-sm-none d-md-flex bg-primary sidebar-container">
        <div class="container text-center sidebar">
          <div class="row row-cols-1 justify-content-around align-items-center g-5">
            <div class="col">
            <span class="searchbar rounded-4">
                <button class="ph ph-magnifying-glass" id="button_busca" onclick="fazerBusca()"></button>
                <input type="text" name="barra_busca" id="barra_busca" placeholder="Buscar...">
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
              <a href="sair.php" class="text-decoration-none text-white">Sair</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8 col-sm-10 d-flex justify-content-center pg-postagens" id="feed-all-container1" style="position: absolute; top: 5rem;">
        <div id="feed-postagens" class="row-cols-1 justify-content-center align-items-center g-0 col-12">
          <div class="col-md-12 col-sm-0 d-sm-none d-md-flex justify-content-center" id="postar">
            <form action="../PHP/post.php" method="post" class="col-10 form-post" enctype="multipart/form-data" id="formPost">
              <div class="col-12 row-cols-1">
                <div class="col form-msg-post">
                  <textarea class="col-12 post-section multiline-input" id="textArea" rows="3" name="texto" wrap="hard"
                    placeholder="Algo para compartilhar? Deixe florescer!"></textarea>
                </div>
                <div class="col" style="position: relative;">
                  <!-- Novo elemento para mostrar a pré-visualização da imagem -->
                  <img id="previewImage" src="#" alt="Pré-visualização da imagem"
                    style="width: 200px; height: 200px; object-fit: cover; position: relative;">
                  <button id="removeImageButton"
                    style="display: flex; border: none; background-color: #cfcfcf; position: absolute; top: 10px; left: 175px; border-radius: 100%; width: 20px; height: 20px; justify-content: center; align-items: center; text-align: center;"
                    type="button"><i class="ph ph-x" style="color: #fff; font-weight: 600; font-size: 12px; margin: 0; margin-top: -10px;"></i></button>
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
                  <!-- Seu campo de input para upload de imagem -->
                  <input type="file" name="uploadImagem" accept="image/*" id="uploadImagem"
                      onchange="previewImage(this);">
                  </span>
                  <input type="submit" id="submit" name="submit" value="Postar" class="btn btn-primary rounded-4"
                    style="font-weight: 500;">
                </div>
              </div>
            </form>
          </div>
          
          <?php
          if(!empty($_GET['busca'])){
            $data = $_GET['busca'];
            $pubs = $conexao->query("SELECT ID_post, ID_usuario, usuario, texto, imagem, data_publicacao FROM post WHERE texto LIKE '%$data%' ORDER BY data_publicacao DESC");

            while ($post = $pubs->fetch_assoc()) {
              $ID_usuario = $post['ID_usuario'];
              $saberr = mysqli_query($conexao, "SELECT * FROM usuario WHERE ID_usuario = $ID_usuario");
              $saber = $saberr->fetch_assoc();
              $id_post = $post['ID_post'];
              $saber_curtidas = mysqli_query($conexao, "SELECT * FROM curtidas WHERE ID_post = $id_post");
              $curtidas = $saber_curtidas->num_rows;
              $saber_comentarios = mysqli_query($conexao, "SELECT * FROM comentarios WHERE ID_post = $id_post");
              $comentarios = $saber_comentarios->num_rows;
          
              echo '
              <div class="col-12 d-flex justify-content-center post-container mb-3" id="feed" style="display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 30px;">
                  <div class="row-cols-1 justify-content-center align-items-center col-10  p-3 post-container-item" style="position: relative;">
                      <div class="col">
                          <div class="postagem-user">
                              <img src="' . $saber['foto_perfil'] . '" alt="Imagem do usuário">
                              <span>
                                  <p style="font-weight: 700; font-size: 18px;"><a href="perfilUsuario.php?idUsuario=' . $post['ID_usuario'] . '">' . $post['usuario'] . '</a></p>
                                  <p style="color: #45abff;">'. $post['data_publicacao'] . '</p>
                              </span>
                              <form method="POST">
                              <input type="hidden" name="idPostUser" value="' . $post['ID_usuario'] . '">';
                              
                              $idPostUser = $post['ID_usuario'];
                              $amigos = mysqli_query($conexao, "SELECT * FROM bloomizade WHERE usuario_id_1 = $ID_usuario OR usuario_id_2 = $idPostUser");
                              $amigoss = mysqli_fetch_assoc($amigos);

                              // Verifica se o post é do próprio usuário
                              $postDoProprioUsuario = $post['ID_usuario'] == $_SESSION['ID_usuario'];

                              // Exibe os botões apenas se o post não for do próprio usuário
                              if (!$postDoProprioUsuario) {
                                  if (mysqli_num_rows($amigos) >= 1 AND $amigoss['status_soli'] == 'aceito') {
                                      echo '
                                      <label for="remover" style="position: absolute; right: 20px; top: 20px; cursor: pointer"><i class="ph ph-user-minus" style="color: #45abff; font-weight: 600; font-size: 40px;"></i></label>
                                      <input type="submit" id="remover" name="remover" value="Remover"  style="display: none">';
                                  } else if (mysqli_num_rows($amigos) >= 1 AND $amigoss['status_soli'] == 'pendente') {
                                      echo '
                                      <label for="cancel" style="position: absolute; right: 20px; top: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; font-size: 18px; color: #45abff"><i class="ph ph-user-minus" style="color: #45abff; font-weight: 600; font-size: 40px;"></i> Pendente</label>
                                      <input type="submit" id="cancel" name="cancel" value="Cancelar"  style="display: none">';
                                  } else {
                                      echo '
                                      <label for="add" style="position: absolute; right: 20px; top: 20px; cursor: pointer";><i class="ph ph-user-plus" style="color: #45abff; font-weight: 600; font-size: 40px;"></i></label>
                                      <input type="submit" id="add" name="add" value="Seguir"  style="display: none">';
                                  }
                              }

                        echo'
                        </form>
                        </div>
                      </div>
                      <div class="col">
                          <p style="font-size: 18px;">' . $post['texto'] . ' ' . (strlen($post['texto']) > 100 ? '<span style="font-weight: 500;">Ler mais.</span>' : '') . '</p>
                      </div>
                      ' . ($post['imagem'] ? '<div class="col img-post"><img src="' . $post['imagem'] . '" alt=""></div>' : '') . '
                      <div class="col-12 interacoes-post">
                          <div class="options-post">
                              <div class="rightside-op-post">
                              <span class="like-btn" data-post-id="' . $post['ID_post'] . '" data-user-id="' . $_SESSION['ID_usuario'] . '">
                                <div id="like" style="display: flex; align-items: center; flex-direction: row; justify-content: center;">
                                    <p style="margin: 0; display: flex; align-items: center; flex-direction: row; justify-content: center;">';

                                    // Verifica se o usuário já curtiu a postagem
                                    $userLiked = hasUserLikedPost($conexao, $post['ID_post'], $_SESSION['ID_usuario']);

                                    if ($userLiked) {
                                        echo '<a href="homepage-postagens.php?unlike=' . $post['ID_post'] . '" style="display: flex; align-items: center;"><i class="ph ph-heart" style="margin-right: 5px;"></i></a>';
                                    } else {
                                        echo '<a href="homepage-postagens.php?like=' . $post['ID_post'] . '" style="display: flex; align-items: center;"><i class="ph ph-heart" style="margin-right: 5px;"></i></a>';
                                    }

                                    // Exibir a contagem de curtidas
                                    echo $curtidas . '</p>
                                </div>
                              </span>
                                <span class="comment-btn" onclick="toggleCommentBox(\'commentBox-' . $post['ID_post'] . '\')">
                                <i class="ph ph-chat-circle"></i>
                                <p>'; echo $comentarios;
                                echo '</p>
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
                      <div id="commentBox-' . $post['ID_post'] . '" style="display: none;">
                            <!-- Caixa de texto para comentários -->
                            <textarea class="form-control" rows="3" placeholder="Digite seu comentário"></textarea>
                            <button class="btn btn-primary mt-2" onclick="postComment(' . $post['ID_post'] . ')">
                                Comentar
                            </button>
                      </div>
                  </div>
              </div>';
          }
        }else if(empty($_GET['busca'])){
            while ($post = $pubs->fetch_assoc()) {
              $ID_usuario = $post['ID_usuario'];
              $saberr = mysqli_query($conexao, "SELECT * FROM usuario WHERE ID_usuario = $ID_usuario");
              $saber = $saberr->fetch_assoc();
              $id_post = $post['ID_post'];
              $saber_curtidas = mysqli_query($conexao, "SELECT * FROM curtidas WHERE ID_post = $id_post");
              $curtidas = $saber_curtidas->num_rows;
          
              echo '
              <div class="col-12 d-flex justify-content-center post-container mb-3" id="feed" style="display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 30px;">
                  <div class="row-cols-1 justify-content-center align-items-center col-10  p-3 post-container-item" style="position: relative;">
                      <div class="col">
                          <div class="postagem-user">
                              <img src="' . $saber['foto_perfil'] . '" alt="Imagem do usuário">
                              <span>
                                  <p style="font-weight: 700; font-size: 18px;"><a href="perfilUsuario.php?idUsuario=' . $post['ID_usuario'] . '">' . $post['usuario'] . '</a></p>
                                  <p style="color: #45abff;">'. $post['data_publicacao'] . '</p>
                              </span>
                              <form method="POST">
                              <input type="hidden" name="idPostUser" value="' . $post['ID_usuario'] . '">';
                              
                              $idPostUser = $post['ID_usuario'];
                              $amigos = mysqli_query($conexao, "SELECT * FROM bloomizade WHERE usuario_id_1 = $ID_usuario OR usuario_id_2 = $idPostUser");
                              $amigoss = mysqli_fetch_assoc($amigos);

                              // Verifica se o post é do próprio usuário
                              $postDoProprioUsuario = $post['ID_usuario'] == $_SESSION['ID_usuario'];

                              // Exibe os botões apenas se o post não for do próprio usuário
                              if (!$postDoProprioUsuario) {
                                  if (mysqli_num_rows($amigos) >= 1 AND $amigoss['status_soli'] == 'aceito') {
                                      echo '
                                      <label for="remover" style="position: absolute; right: 20px; top: 20px; cursor: pointer"><i class="ph ph-user-minus" style="color: #45abff; font-weight: 600; font-size: 40px;"></i></label>
                                      <input type="submit" id="remover" name="remover" value="Remover"  style="display: none">';
                                  } else if (mysqli_num_rows($amigos) >= 1 AND $amigoss['status_soli'] == 'pendente') {
                                      echo '
                                      <label for="cancel" style="position: absolute; right: 20px; top: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; font-size: 18px; color: #45abff"><i class="ph ph-user-minus" style="color: #45abff; font-weight: 600; font-size: 40px;"></i> Pendente</label>
                                      <input type="submit" id="cancel" name="cancel" value="Cancelar"  style="display: none">';
                                  } else {
                                      echo '
                                      <label for="add" style="position: absolute; right: 20px; top: 20px; cursor: pointer";><i class="ph ph-user-plus" style="color: #45abff; font-weight: 600; font-size: 40px;"></i></label>
                                      <input type="submit" id="add" name="add" value="Seguir"  style="display: none">';
                                  }
                              }

                        echo'
                        </form>
                        </div>
                      </div>
                      <div class="col">
                          <p style="font-size: 18px;">' . $post['texto'] . ' ' . (strlen($post['texto']) > 100 ? '<span style="font-weight: 500;">Ler mais.</span>' : '') . '</p>
                      </div>
                      ' . ($post['imagem'] ? '<div class="col img-post"><img src="' . $post['imagem'] . '" alt=""></div>' : '') . '
                      <div class="col-12 interacoes-post">
                          <div class="options-post">
                              <div class="rightside-op-post">
                              <span class="like-btn" data-post-id="' . $post['ID_post'] . '" data-user-id="' . $_SESSION['ID_usuario'] . '">
                                <div id="like" style="display: flex; align-items: center; flex-direction: row; justify-content: center;">
                                    <p style="margin: 0; display: flex; align-items: center; flex-direction: row; justify-content: center;">';

                            // Verifica se o usuário já curtiu a postagem
                            $userLiked = hasUserLikedPost($conexao, $post['ID_post'], $_SESSION['ID_usuario']);

                            if ($userLiked) {
                                echo '<a href="homepage-postagens.php?unlike=' . $post['ID_post'] . '" style="display: flex; align-items: center;"><i class="ph ph-heart" style="margin-right: 5px;"></i></a>';
                            } else {
                                echo '<a href="homepage-postagens.php?like=' . $post['ID_post'] . '" style="display: flex; align-items: center;"><i class="ph ph-heart" style="margin-right: 5px;"></i></a>';
                            }

                            // Exibir a contagem de curtidas
                            echo $curtidas . '</p>
                                </div>
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
              </div>';
          }
        }
            if (isset($_GET['like'])) {
                like();
            }

            function like() {
                global $conexao;
                $post_id = $_GET['like'];
                $user_id = $_SESSION['ID_usuario'];
                $data = date('Y-m-d');

                // Verifica se o usuário já deu like nesta postagem
                $user_check = mysqli_query($conexao, "SELECT ID_usuario FROM curtidas WHERE ID_post = $post_id AND ID_usuario = $user_id");
                $do_user_check = $user_check->num_rows;

                if ($do_user_check == 0) {
                    // Insere um novo like no banco de dados
                    $inserir = mysqli_query($conexao, "INSERT INTO curtidas (ID_post, ID_usuario, data_curtida) VALUES ('$post_id', '$user_id', '$data')");
                    if (!$inserir) {
                        echo 'Erro ao inserir curtida: ' . mysqli_error($conexao);
                    }
                }
            }

            if (isset($_GET['unlike'])) {
                unlike();
            }

            function unlike() {
                global $conexao;
                $post_id = $_GET['unlike'];
                $user_id = $_SESSION['ID_usuario'];

                // Remove o like do banco de dados
                $del = mysqli_query($conexao, "DELETE FROM curtidas WHERE ID_post = '$post_id' AND ID_usuario = '$user_id'");
                if (!$del) {
                    echo 'Erro ao remover curtida: ' . mysqli_error($conexao);
                }
            }

            // Função para verificar se o usuário curtiu a postagem
            function hasUserLikedPost($conexao, $post_id, $user_id) {
              $query = "SELECT * FROM curtidas WHERE ID_post = $post_id AND ID_usuario = $user_id";
              $result = mysqli_query($conexao, $query);

              return $result->num_rows > 0;
            }

            $conexao->close();
          ?>



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

              // Consultar os posts mais curtidos da semana
              $sql = "SELECT post.*, usuario.*, COUNT(curtidas.ID_curtida) AS num_curtidas
                      FROM post
                      JOIN usuario ON post.ID_usuario = usuario.ID_usuario
                      LEFT JOIN curtidas ON post.ID_post = curtidas.ID_post
                      WHERE post.data_publicacao >= NOW() - INTERVAL 3 WEEK
                      GROUP BY post.ID_post
                      ORDER BY num_curtidas DESC
                      LIMIT 1"; // Ajuste a quantidade ou as condições conforme necessário
              $result = $conexao->query($sql);

              if ($result) {
                  $destaque = $result->fetch_assoc();
                  // Verifica se há resultados
                  if ($destaque) {
            ?>
        <div class="row-cols-1 destaques justify-content-center align-items-center g-0">
            <div class="col destaques-top text-nowrap">
                <p style="color: #1289EA; font-weight: 500;">Destaque da semana</p>
                <p style="color: #DBAC01; font-weight: 500;">Confira o post mais curtido!</p>
            </div>
            <div class="col text-start destaques-post">
                <span style="display:flex; flex-direction: row;" class="destaques-post-user">
                    <img src="<?php echo $destaque['foto_perfil']; ?>" alt="">
                    <span>
                        <p style="font-weight: 500;"><?php echo $destaque['usuario']; ?></p>
                        <p style="font-size: 1vw;"><?php echo date('d/m/Y', strtotime($destaque['data_publicacao'])); ?></p>
                    </span>
                </span>
                <div style="display:flex; flex-direction: column;" class="destaques-post-text">
                    <p><?php echo $destaque['texto']; ?></p>
                    <span class="destaques-post-tags">
                        <!-- Adicione tags aqui, se necessário -->
                    </span>
                    <?php
                    // Verifica se há uma URL de imagem
                    if (!empty($destaque['imagem'])) {
                    ?>
                        <img src="<?php echo $destaque['imagem']; ?>" alt="Imagem do post">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col dots" style="display:flex; flex-direction: row; justify-content: center; align-items: center;">
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
                  <p style="color: #1289EA; font-weight: 500;">Bloomigos sugeridos</p>
                  <p style="color: #DBAC01; font-weight: 500;">Amplie sua rede, conecte-se.</p>
                </div>
                <div class="col">
                  <div class="rows-cols-1 justify-content-center align-items-center g-2">
                  <?php

                  // Verifica se há resultados em $amigosDeAmigos
                  if (!empty($amigosDeAmigos)) {
                      $rowCount = 0;
                      foreach ($amigosDeAmigos as $row) {
                          // Exiba as informações do amigo de amigo
                          echo '
                          <div class="col destaques-bloomigos-user">
                            <span style="display:flex; flex-direction: row;">
                              <img src="'.$row['foto_perfil'].'" alt=""
                                style="border-radius: 100%; width: 3vw; height: 3vw; object-fit: cover;">
                              <span style="display: flex; flex-direction: column; text-align: start;">
                                <p style="font-weight: 500;">'.$row['nome'].' '.$row['sobrenome'].'</p>
                                <p style="font-size: 1vw;">@'.$row['usuario'].'</p>
                              </span>
                            </span>
                          </div>
                          ';

                          $rowCount++;
                      }
                  } else {
                      echo 'Nenhum Bloomigo encontrado.';
                  }
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
              <a href="../pages/postagemmobile.html">
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

  <script>
    const uploadImagem = document.getElementById('uploadImagem');
    const previewImage = document.getElementById('previewImage');
    const removeImageButton = document.getElementById('removeImageButton');
    const textArea = document.getElementById('textArea');
    previewImage.style.display = 'none';
    removeImageButton.style.display = 'none';

    uploadImagem.onchange = evt => {
      const [file] = uploadImagem.files;

      if (file) {
        previewImage.src = URL.createObjectURL(file);
        removeImageButton.style.display = 'block';
        previewImage.style.display = 'block';
      } else {
        previewImage.src = ''; // Define o src como vazio
        previewImage.style.display = 'none';
        removeImageButton.style.display = 'none';
      }
    };

    // Adicione a lógica para remover a imagem e redefinir o campo de arquivo
    removeImageButton.addEventListener('click', () => {
      previewImage.src = ''; // Define o src como vazio
      previewImage.style.display = 'none';
      uploadImagem.value = ''; // Limpa o valor do campo de arquivo
      removeImageButton.style.display = 'none';
    });

  
    textArea.addEventListener('click', () => {
    // Limpa o conteúdo do campo de texto
    textArea.value = '';

    // Limpa o conteúdo do campo de upload de imagem
    uploadImagem.value = '';

    // Esconde a pré-visualização da imagem e o botão de remoção
    previewImage.src = '';
    previewImage.style.display = 'none';
    removeImageButton.style.display = 'none';
});

    function toggleCommentBox(commentBoxId) {
        var commentBox = document.getElementById(commentBoxId);
        if (commentBox.style.display === 'none') {
            commentBox.style.display = 'block';
        } else {
            commentBox.style.display = 'none';
        }
    }

    function postComment(postId) {
      var commentBox = document.getElementById('commentBox-' + postId);
      var commentText = commentBox.querySelector('textarea').value;

      // Verificar se o comentário não está vazio
      if (commentText.trim() === '') {
          alert('Por favor, insira um comentário.');
          return;
      }

      // Criar um objeto XMLHttpRequest
      var xhr = new XMLHttpRequest();

      // Configurar a solicitação POST assíncrona
      xhr.open('POST', 'comentarios.php', true);

      // Configurar o cabeçalho da solicitação
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      // Definir a função de retorno de chamada para tratar a resposta do servidor
      xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
              // Lógica para lidar com a resposta do servidor
              var response = JSON.parse(xhr.responseText);
              if (response.success) {
                  // Comentário enviado com sucesso, realizar ações adicionais se necessário
                  alert('Comentário enviado com sucesso!');
                  commentBox.style.display='none';
                  // Você pode adicionar mais lógica aqui, como atualizar a exibição de comentários na página
              } else {
                  // Tratar erros, se houver
                  alert('Erro ao enviar o comentário. Por favor, tente novamente.');
              }
          }
      };

      // Montar os dados a serem enviados (postId e commentText)
      var data = 'postId=' + postId + '&commentText=' + encodeURIComponent(commentText);

      // Enviar a solicitação
      xhr.send(data);
    }



    $(document).ready(function () {
        // Manipulador de envio do formulário
        $('#formPost').submit(function (event) {
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '../PHP/post.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        // Postagem bem-sucedida, adicione a nova postagem ao feed
                        adicionarPostAoFeed(data.post);

                        // Limpa o conteúdo do campo de texto após o envio
                    textArea.value = '';

                    // Limpa o conteúdo do campo de upload de imagem
                    uploadImagem.value = '';

                    // Esconde a pré-visualização da imagem e o botão de remoção
                    previewImage.src = '';
                    previewImage.style.display = 'none';
                    removeImageButton.style.display = 'none';
                    } else {
                        // Exiba mensagem de erro
                        console.error(data.error);
                    }
                },
                error: function (error) {
                    console.error('Erro ao enviar a solicitação Ajax:', error);
                }
            });

            

        });

       

        // Função para adicionar uma nova postagem ao feed
        function adicionarPostAoFeed(post) {
            // Lógica para adicionar o HTML da nova postagem ao feed
            // ...

            // Exemplo: Adicionando a postagem ao início do feed
            var feedElement = $('#feed');

            // Construir a string HTML
            var novoPostHTML = `
                <div class="row-cols-1 justify-content-center align-items-center col-10 p-3 post-container-item">
                    <div class="col">
                        <div class="postagem-user">
                            <img src="<?php echo $fotoPerfil; ?>" alt="Imagem do usuário">
                            <span>
                                <p style="font-weight: 700; font-size: 18px;">${post.usuario}</p>
                                <p style="color: #45abff;">${post.data_publicacao}</p>
                            </span>
                        </div>
                    </div>
                    <div class="col">
                        <p style="font-size: 18px;">${post.texto} ${post.texto.length > 100 ? '<span style="font-weight: 500;">Ler mais.</span>' : ''}</p>
                    </div>
                    ${post.caminhoImagem ? `<div class="col img-post"><img src="${post.caminhoImagem}" alt=""></div>` : ''}
                    <div class="col-12 interacoes-post">
                        <div class="options-post">
                            <div class="rightside-op-post">
                                <p style="margin: 0; display: flex; align-items: center; flex-direction: row; justify-content: center;">
                                    <a href="homepage-postagens.php?${post.userLiked ? 'unlike' : 'like'}=${post.ID_post}" style="display: flex; align-items: center;">
                                        <i class="ph ph-heart" style="margin-right: 5px;"></i>
                                    </a>
                                    <?php echo $curtidas; ?>
                                </p>
                                <span class="comment-btn" onclick="toggleCommentBox('commentBox-${post.ID_post}')">
                                    <i class="ph ph-chat-circle"></i>
                                    <p><?php echo $comentarios; ?></p>
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
                      <div id="commentBox-${post.ID_post}" style="display: none;">
                          <!-- Caixa de texto para comentários -->
                          <textarea class="form-control" rows="3" placeholder="Digite seu comentário"></textarea>
                          <button class="btn btn-primary mt-2" onclick="postComment(${post.ID_post})">
                              Comentar
                          </button>
                      </div>
                </div>`;

            // Substitua pelo HTML real
            feedElement.prepend(novoPostHTML);
        }


    

    
    });


var busca = document.getElementById('barra_busca');

busca.addEventListener("keydown", function(event){
if(event.key === "Enter"){
  fazerBusca();
}
});

function fazerBusca(){
  window.location = "homepage-postagens.php?busca="+ busca.value;
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