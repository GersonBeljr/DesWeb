/*--------------------------------------------*/
/* INICIANDO E TERMINANDO O JOGO */

BTNINICIAR.addEventListener("click", ()=>{
    jogadorNome = document.getElementById("nomelog").value.trim();
    tempoImg = (INPDIFICULDADE.value)/10;
    nRodada = 0;
    console.log("INICIOU");
    console.log("jogadorNome:", jogadorNome);
    PGINICIO.style.display = "none";

    rodadaComeco();
});

BTNJOGARNOVAMENTE.addEventListener("click", ()=>{
    window.location.href = window.location.href;
});