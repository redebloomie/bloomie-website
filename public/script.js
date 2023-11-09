$(window).on('load', function () {
  setTimeout(function () {
    $('#splash-screen').fadeOut('slow', function () {
      $(this).remove();
    });
  }, 2800);
});

var swiper = new Swiper(".swiper-container", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  centeredSlides: true,
  compatibility: true,
  initialSlide: 1,
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 100,
    modifier: 10,
    initialSlide: 2,
    slideShadows: true
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true
  }
});

const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#senha');

togglePassword.addEventListener('click', function () {
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);

  this.classList.toggle('ph-eye-slash');
  this.classList.toggle('ph-eye');
});


function toggleText() {
  var contentDiv = document.querySelector('.content');
  var toggleBtn = document.querySelector('.toggle-btn');

  if (contentDiv.classList.contains('expanded')) {
    contentDiv.classList.remove('expanded');
    toggleBtn.textContent = 'Ler mais';
  } else {
    contentDiv.classList.add('expanded');
    toggleBtn.textContent = 'Ler menos';
  }
}

// ALTERNAR ENTRE POSTAGENS E OPORTUNIDADES

// Função para mostrar o conteúdo das oportunidades
// function mostrarOportunidades() {
//   document.getElementById("feed-oportunidades").classList.remove('conteudo');
//   document.getElementById("sidebar-oportunidades").classList.remove('conteudo');
//   document.getElementById("feed-postagens").classList.add('conteudo');
//   document.getElementById("sidebar-postagens").classList.add('conteudo');
//   console.log('oioi');
// }

// Função para mostrar o conteúdo das postagens
// function mostrarPostagens() {
//   document.getElementById("feed-oportunidades").classList.add('conteudo');
//   document.getElementById("sidebar-oportunidades").classList.add('conteudo');
//   document.getElementById("feed-postagens").classList.remove('conteudo');
//   document.getElementById("sidebar-postagens").classList.remove('conteudo');
//   console.log('oioipostagens');
// }

// Adicione ouvintes de eventos aos botões
// document.getElementById("btnOportunidades").addEventListener("click", mostrarOportunidades);
// document.getElementById("btnPostagens").addEventListener("click", mostrarPostagens);

// Mostrar as oportunidades por padrão ao carregar a página
// mostrarPostagens();

// --------------- CIDADES E ESTADOS ------------------
const ulrUF = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados'
const cidade = document.getElementById("cidade");
const uf = document.getElementById("uf");

uf.addEventListener('change', async function () {
  const urlCidades = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + uf.value + '/municipios';
  const request = await fetch(urlCidades);
  const response = await request.json();
  console.log(response.length);
let options = ''
  response.forEach(function (cidades) {
    options += `<option name="cidade">` + cidades.nome + '</option>'
  });
cidade.innerHTML = options;

});

window.addEventListener('load', async ()=> {
  const request = await fetch(ulrUF)
  const response = await request.json()

  console.log(response)
  const options = document.createElement("optgroup")
  options.setAttribute('label', 'UFS')
  response.forEach(function(uf) {
    options.innerHTML += `<option name="estado">` + uf.sigla + '</option>'

  response.forEach(function(uf) {
    console.log(uf.sigla)
  });
})

uf.append(options);

})

// TESTE DISC

var answers = {};

var question_one = document.getElementById('question-1');
var question_two = document.getElementById('question-2');
var question_three = document.getElementById('question-3');
var question_four = document.getElementById('question-4');
var question_five = document.getElementById('question-5');

function storeAnswer(question_number, event){
    if(event.target.type === 'radio'){
        console.log(event.target.value);
        answers['question'+question_number] = parseInt(event.target.value);
        console.log(answers);
    }
}

question_one.addEventListener('click', function(event){
    storeAnswer(1, event)
})
question_two.addEventListener('click', function(event){
    storeAnswer(2, event)
})
question_three.addEventListener('click', function(event){
    storeAnswer(3, event)
})
question_four.addEventListener('click', function(event){
    storeAnswer(4, event)
})
question_five.addEventListener('click', function(event){
    storeAnswer(5, event)
})

function totalScore(){
    var total_score = 
    answers.question1+
    answers.question2+
    answers.question3+
    answers.question4+ 
    answers.question5;
    
    return total_score;
}

function getInfoBasedOnScore(){
    if(totalScore() < 7){
        var score_info = "Você precisa tomar mais cuidado com a segurança!";
    } else if(totalScore() > 7){
        var score_info = "Parabéns! Você está bem de segurança!"
    }

    return score_info;
}

var submit1 = document.getElementById('submit1');
var submit2 = document.getElementById('submit2');
var submit3 = document.getElementById('submit3');
var submit4 = document.getElementById('submit4');
var submit5 = document.getElementById('submit5');

function nextQuestion(question_number){
    var current_question_number = question_number - 1;
    var question_number = question_number.toString();
    var current_question_number = current_question_number.toString();

    var el = document.getElementById('question-'+question_number);
    var el2 = document.getElementById('question-'+current_question_number);

    el.style.display = "block";
    el2.style.display = "none";
}

submit1.addEventListener('click', function(){
    nextQuestion(2);
    growProgressBar('40%');
})
submit2.addEventListener('click', function(){
    nextQuestion(3);
    growProgressBar('60%');
})
submit3.addEventListener('click', function(){
    nextQuestion(4);
    growProgressBar('80%');
})
submit4.addEventListener('click', function(){
    nextQuestion(5);
    growProgressBar('100%');
})
submit5.addEventListener('click', function(){
    nextQuestion(6);
})

submit5.addEventListener('click', function(){
    document.getElementById("printtotalscore").innerHTML = totalScore();
    document.getElementById("printscoreinfo").innerHTML = getInfoBasedOnScore();
})

function growProgressBar(percentage_width){
    var bar = document.getElementById("progress_bar");
    bar.style.width = percentage_width;
}

// TAGS INSERT



