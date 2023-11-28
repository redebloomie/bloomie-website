<?php
session_start();
include('connect.php');

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
          <a href="homepage-postagens.php"><button type="button" id="btnPostagens" class="btn"
            style="background-color: #0C5D9E; color: #fff; font-weight: 500; border-radius: 15px; width: 150px;">Postagens</button></a>
        </li>
        <li class="nav-item">
          <a href="homepage-oportunidades.php"><button type="button" id="btnOportunidades" class="btn"
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
                  <a href="../PHP/perfil.php" class="text-decoration-none text-white">Perfil</a>
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
              <a href="sair.php" class="text-decoration-none text-white">Sair</a>
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
            while ($post = $pubs->fetch_assoc()) {
              $ID_usuario = $post['ID_usuario'];
              $saberr = mysqli_query($conexao, "SELECT * FROM usuario WHERE ID_usuario = $ID_usuario");
              $saber = $saberr->fetch_assoc();
              $id_post = $post['ID_post'];
              $saber_curtidas = mysqli_query($conexao, "SELECT * FROM curtidas WHERE ID_post = $id_post");
              $curtidas = $saber_curtidas->num_rows;
          
              echo '
              <div class="col-12 d-flex justify-content-center post-container" id="feed" style="display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 30px;">
                  <div class="row-cols-1 justify-content-center align-items-center col-10  p-3 post-container-item" style="position: relative;">
                      <div class="col">
                          <div class="postagem-user">
                              <img src="' . $fotoPerfil . '" alt="Imagem do usuário">
                              <span>
                                  <p style="font-weight: 700; font-size: 18px;"><a href="perfil.php?idUsuario=' . $post['ID_usuario'] . '">' . $post['usuario'] . '</a></p>
                                  <p style="color: #45abff;">'. $post['data_publicacao'] . '</p>
                              </span>
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
                                      <i class="ph ph-heart"></i>
                                      <div id="like">
                                          <p>';
          
              // Verifica se o usuário já curtiu a postagem
              $userLiked = hasUserLikedPost($conexao, $post['ID_post'], $_SESSION['ID_usuario']);
          
              if ($userLiked) {
                  echo '<a href="homepage-postagens.php?unlike=' . $post['ID_post'] . '">Gostei</a> | ';
              } else {
                  echo '<a href="homepage-postagens.php?like=' . $post['ID_post'] . '">Gostar</a> | ';
              }
          
              // Exibir a contagem de curtidas
              echo $curtidas . ' gostaram</p>
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

      
      <div class="col-2 rightsidebar p-0 pg-postagens-leftSidebar ">
        <div id="sidebar-postagens" class="row-cols-1 justify-content-center align-items-center rightsidebar-group">
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

    <!-- Adicione isso ao seu HTML -->
      <div class="bottom-navigation">
              <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">
                <i class="ph ph-house"></i>
              </a>
              <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">
                <img src="../assets/bluBloomie.png" alt="" style="width: 5vw;">
              </a>
              <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">
                <i class="ph ph-plus"></i>
              </a>
              <a href="../pages/homepage-postagens.html" class="text-decoration-none text-white">
                <i class="ph ph-bell"></i>
              </a>
              <a href="../pages/perfil.html" class="text-decoration-none text-white">
                <i class="ph ph-user"></i>
              </a>
              <!-- Adicione mais itens de navegação conforme necessário -->
      </div>
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


    $(document).ready(function () {
        // Manipulador de envio do formulário
        $('form').submit(function (event) {
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
            var novoPostHTML = `
            <div class="row-cols-1 justify-content-center align-items-center col-10  p-3 post-container-item">
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
`; // Substitua pelo HTML real
            feedElement.prepend(novoPostHTML);
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

  <script src="/public/script.js"></script>

</body>

</html>