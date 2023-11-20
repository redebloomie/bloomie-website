<?php
if (mysqli_num_rows($resultPendentes) > 0) {
    while ($row = mysqli_fetch_assoc($resultPendentes)) {
        // Exiba as informações da oportunidade
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<div class="d-flex align-items-center col-6">';
        echo '<img src="' . $row['imagem'] . '" class="bg-black rounded-5 col-4" style="width: 4vw; height: 4vw; object-fit:cover;">';
        echo '<p class="mb-0 h5 text mg">' . $row['titulo'] . '</p>';
        echo '</div>';
        echo '<div class="d-flex p-1 col-6 col-sm-4 col-md-6 justify-content-end">';
        echo '<button class="btn btn-success bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb">Aceitar</button>';
        echo '<button class="btn btn-danger bt1 rounded-3 h6 col-lg-2 col-sm-2 col-md-3 col-4 textb">Negar</button>';
        echo '<button class="btn btn-dark bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb">Inativar</button>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row mb-3">';
        echo '<div class="col-md-4 col-sm-12">';
        echo '<p class="h5 text mb-3" style="color:#66CCCC;">Detalhes:</p>';
        echo '<p class="txtj">' . $row['descricao'] . '</p>';
        echo '</div>';
        echo '<div class="col-md-4 col-sm-12">';
        echo '<p class="h5 text mb-3" style="color:#66CCCC;">Regras:</p>';
        echo '<p class="txtj">' . $row['regras'] . '</p>';
        echo '</div>';
        echo '<div class="col-md-4 col-sm-12">';
        echo '<p class="h5 text mb-3" style="color:#66CCCC;">Data de Expiração:</p>';
        echo '<p class="txtj">' . $row['data_expiracao'] . '</p>';
        echo '</div>';
        echo '</div>';
        $rowCount++;
    }
}elseif (mysqli_num_rows($resultExpiradas) > 0) {
  $rowCount = 0;
  while ($row = mysqli_fetch_assoc($resultExpiradas)) {
      // Exiba as informações da oportunidade
      echo '<div class="d-flex justify-content-between align-items-center">';
      echo '<div class="d-flex align-items-center col-6">';
      echo '<img src="' . $row['imagem'] . '" class="bg-black rounded-5 col-4" style="width: 4vw; height: 4vw; object-fit:cover;">';
      echo '<p class="mb-0 h5 text mg">' . $row['titulo'] . '</p>';
      echo '</div>';
      echo '<div class="d-flex p-1 col-6 col-sm-4 col-md-6 justify-content-end">';
      echo '<button class="btn btn-success bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb">Aceitar</button>';
      echo '<button class="btn btn-danger bt1 rounded-3 h6 col-lg-2 col-sm-2 col-md-3 col-4 textb">Negar</button>';
      echo '<button class="btn btn-dark bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb">Inativar</button>';
      echo '</div>';
      echo '</div>';
      echo '<div class="row mb-3">';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Detalhes:</p>';
      echo '<p class="txtj">' . $row['descricao'] . '</p>';
      echo '</div>';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Regras:</p>';
      echo '<p class="txtj">' . $row['regras'] . '</p>';
      echo '</div>';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Data de Expiração:</p>';
      echo '<p class="txtj">' . $row['data_expiracao'] . '</p>';
      echo '</div>';
      echo '</div>';
      $rowCount++;
  }
}elseif (mysqli_num_rows($resultAceitas) > 0) {
  $rowCount = 0;
  while ($row = mysqli_fetch_assoc($resultAceitas)) {
      // Exiba as informações da oportunidade
      echo '<div class="d-flex justify-content-between align-items-center">';
      echo '<div class="d-flex align-items-center col-6">';
      echo '<img src="' . $row['imagem'] . '" class="bg-black rounded-5 col-4" style="width: 4vw; height: 4vw; object-fit:cover;">';
      echo '<p class="mb-0 h5 text mg">' . $row['titulo'] . '</p>';
      echo '</div>';
      echo '<div class="d-flex p-1 col-6 col-sm-4 col-md-6 justify-content-end">';
      echo '<button class="btn btn-success bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb">Aceitar</button>';
      echo '<button class="btn btn-danger bt1 rounded-3 h6 col-lg-2 col-sm-2 col-md-3 col-4 textb">Negar</button>';
      echo '<button class="btn btn-dark bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb">Inativar</button>';
      echo '</div>';
      echo '</div>';
      echo '<div class="row mb-3">';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Detalhes:</p>';
      echo '<p class="txtj">' . $row['descricao'] . '</p>';
      echo '</div>';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Regras:</p>';
      echo '<p class="txtj">' . $row['regras'] . '</p>';
      echo '</div>';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Data de Expiração:</p>';
      echo '<p class="txtj">' . $row['data_expiracao'] . '</p>';
      echo '</div>';
      echo '</div>';
      $rowCount++;
  }

}elseif (mysqli_num_rows($resultNegadas) > 0) {
  $rowCount = 0;
  while ($row = mysqli_fetch_assoc($resultNegadas)) {
      // Exiba as informações da oportunidade
      echo '<div class="d-flex justify-content-between align-items-center">';
      echo '<div class="d-flex align-items-center col-6">';
      echo '<img src="' . $row['imagem'] . '" class="bg-black rounded-5 col-4" style="width: 4vw; height: 4vw; object-fit:cover;">';
      echo '<p class="mb-0 h5 text mg">' . $row['titulo'] . '</p>';
      echo '</div>';
      echo '<div class="d-flex p-1 col-6 col-sm-4 col-md-6 justify-content-end">';
      echo '<button class="btn btn-success bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb">Aceitar</button>';
      echo '<button class="btn btn-danger bt1 rounded-3 h6 col-lg-2 col-sm-2 col-md-3 col-4 textb">Negar</button>';
      echo '<button class="btn btn-dark bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb">Inativar</button>';
      echo '</div>';
      echo '</div>';
      echo '<div class="row mb-3">';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Detalhes:</p>';
      echo '<p class="txtj">' . $row['descricao'] . '</p>';
      echo '</div>';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Regras:</p>';
      echo '<p class="txtj">' . $row['regras'] . '</p>';
      echo '</div>';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Data de Expiração:</p>';
      echo '<p class="txtj">' . $row['data_expiracao'] . '</p>';
      echo '</div>';
      echo '</div>';
      $rowCount++;
  }
}elseif (mysqli_num_rows($resultInativas) > 0) {
  $rowCount = 0;
  while ($row = mysqli_fetch_assoc($resultInativas)) {
      // Exiba as informações da oportunidade
      echo '<div class="d-flex justify-content-between align-items-center">';
      echo '<div class="d-flex align-items-center col-6">';
      echo '<img src="' . $row['imagem'] . '" class="bg-black rounded-5 col-4" style="width: 4vw; height: 4vw; object-fit:cover;">';
      echo '<p class="mb-0 h5 text mg">' . $row['titulo'] . '</p>';
      echo '</div>';
      echo '<div class="d-flex p-1 col-6 col-sm-4 col-md-6 justify-content-end">';
      echo '<button class="btn btn-success bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb">Aceitar</button>';
      echo '<button class="btn btn-danger bt1 rounded-3 h6 col-lg-2 col-sm-2 col-md-3 col-4 textb">Negar</button>';
      echo '<button class="btn btn-dark bt1 rounded-3 h6 col-lg-2 col-md-3 col-4 textb">Inativar</button>';
      echo '</div>';
      echo '</div>';
      echo '<div class="row mb-3">';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Detalhes:</p>';
      echo '<p class="txtj">' . $row['descricao'] . '</p>';
      echo '</div>';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Regras:</p>';
      echo '<p class="txtj">' . $row['regras'] . '</p>';
      echo '</div>';
      echo '<div class="col-md-4 col-sm-12">';
      echo '<p class="h5 text mb-3" style="color:#66CCCC;">Data de Expiração:</p>';
      echo '<p class="txtj">' . $row['data_expiracao'] . '</p>';
      echo '</div>';
      echo '</div>';
      $rowCount++;
  }

}else {
    echo '<p class="h5 text txtj">Nenhuma oportunidade encontrada.</p>';
}
?>

