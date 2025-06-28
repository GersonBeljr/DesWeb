/*--------------------------------------------*/
/* Botões */
const BTNINICIAR = document.getElementById("iniciar");
const BTNJOGARNOVAMENTE = document.getElementById("jogarNovamente");

/*--------------------------------------------*/
/* inputs */
const INPDIFICULDADE = document.getElementById("nivel");
const INPRESPOSTAS = document.getElementById("input_respostas");

/*--------------------------------------------*/
/* paginas */
const PGINICIO = document.getElementById("pgIni");
const PGIMAGEM = document.getElementById("pgImg");
const PGRESPOSTA = document.getElementById("pgResp");
const PGFIM = document.getElementById("pgFim");

/*--------------------------------------------*/
/* inserir texto */
const INSTXTCRONOMETROIMG = document.getElementById("cronometro");
const INSTXTCRONOMETRORESP = document.getElementById("contador");
const INSTXTFIMJOGADOR = document.getElementById("jogador");
const INSTXTFIMPONTOS = document.getElementById("pontuaçãoFinal");
const INSTXTQUADRO = document.getElementById("quadro");

const INPIMG = document.getElementById("imagem");

/*--------------------------------------------*/
/* variaveis */
const tempoResposta = 5;
const arrayRespostas = ["macaco"];

let nRodada = 0;
let tempoImg = 0;
//let jogadorNome = document.getElementById("nomelog").value;
let pontos = 0;