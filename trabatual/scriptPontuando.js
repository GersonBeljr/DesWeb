/*--------------------------------------------*/
/* Pontuando */

function atualizarLeaderboard() {
  fetch("leaderboard.php")
    .then(res => res.text())
    .then(html => {
      document.getElementById("leaderb").innerHTML = html;
    });
}

function pontuando() {
    pontosRecebidos = 10/tempoImg;
    pontos = pontosRecebidos;
    
};

function limpar() {
    INSTXTQUADRO.innerHTML = "";
}

function respondendo() {
    resposta = INPRESPOSTAS.value;

    const p = document.createElement("p");
    p.textContent = resposta;
    p.className = arrayRespostas.includes(resposta.toLowerCase()) ? "certo" : "errado";

    if (arrayRespostas.includes(resposta.toLowerCase())) {
        fetch("leaderboard.php", {
  method: "POST"
})
.then(res => res.text())
.then(console.log)
.catch(console.error);
    }

    INSTXTQUADRO.appendChild(p);
}

INPRESPOSTAS.addEventListener("keydown", ()=>{
    if (event.key === "Enter") {
        respondendo();
        INPRESPOSTAS.value = "";
    }
})