const spanTxt = $("#hero-txt-span");
const heroBtn = document.getElementById("hero-btn");
const linesBtn = document.getElementById("lines-btn");
const linesContainer = document.getElementById("lines-container");

const words = [
  "Eficiente",
  "Económico",
  "Confortable",
  "Seguro",
  "Rápido",
  "Moderno",
  "Puntual",
  "Fácil",
  "Directo",
  "Conveniente",
  "Conectado",
  "Experiencia",
  "Sencillo",
  "Agradable",
  "Experto",
];
let currentIndex = 0;

const animationSpanTxt = () => {
  spanTxt.animate({ opacity: 0 }, 500, () => {
    currentIndex = Math.floor(Math.random() * words.length); // Elige una palabra aleatoria
    spanTxt.html(words[currentIndex]);
    spanTxt.animate({ opacity: 1 }, 500);
  });
};

const openLinesContainer = () => {
  linesContainer.classList.toggle("lines-container-open");
};

setInterval(animationSpanTxt, 7000);

heroBtn.addEventListener("click", openLinesContainer);
linesBtn.addEventListener("click", openLinesContainer);
