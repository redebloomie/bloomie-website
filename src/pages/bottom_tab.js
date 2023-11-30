$(document).ready(function () {
  // Inicialmente, ocultar o Bottom Tab se a largura da tela for maior que 768
  if ($(window).width() > 768) {
    $(".bottom-tab").hide();
  }

  // Mostrar ou ocultar Bottom Tab ao redimensionar a tela
  $(window).on("resize", function () {
    if ($(window).width() <= 768) {
      $(".bottom-tab").show();
    } else {
      $(".bottom-tab").hide();
      $("#bottomTabOptions").hide();
    }
  });

  // Exibir ou ocultar o menu pop-up ao clicar no ícone de "+"
  $("#bottomTabCenter").on("click", function () {
    $("#bottomTabOptions").toggle();
  });
});
$(document).ready(function () {
  // Mostrar ou ocultar bottom tab com base na largura da tela
  $(window).on("resize", function () {
    if ($(window).width() <= 768) {
      $(".bottom-tab").show();
    } else {
      $(".bottom-tab").hide();
      $("#bottomTabOptions").hide();
    }
  });

  // Exibir ou ocultar o menu pop-up ao clicar no ícone de "+"
  $("#bottomTabCenter").on("click", function () {
    $("#bottomTabOptions").toggle();
  });
});
$(document).on("click", function (e) {
  if (
    !$(e.target).closest("#bottomTabOptions").length &&
    !$(e.target).is("#plusIcon")
  ) {
    $("#bottomTabOptions").hide();
  }
});
