/*--------------------------------------------*/
/* Roda o jogo */

function rodadaFim() {
    PGFIM.style.display = "flex";
    INSTXTFIMJOGADOR.innerText = jogadorNome;
    INSTXTFIMPONTOS.innerText = pontos.toFixed(1);
    atualizarLeaderboard();
}

function recomecando() {
    let novaUrl = "https://picsum.photos/300/200?random=" + Math.floor(Math.random() * 100000);
    INPIMG.src = novaUrl;
}

function rodadaResposta() {
    let tempo = tempoResposta;
    PGRESPOSTA.style.display = "flex";
    INSTXTCRONOMETRORESP.innerText = tempo;

    let intervalo = setInterval(() => {
        tempo -= 1;

        if (tempo <= 0) {
            PGRESPOSTA.style.display = "none";
            clearInterval(intervalo);
            nRodada++;
            
            INPRESPOSTAS.value = '';

            if (nRodada>1) {
                rodadaFim();
            } else {
                limpar()
                rodadaComeco();
            }

        } else {
            INSTXTCRONOMETRORESP.innerText = tempo;
        };

    }, 1000)

}

function rodadaComeco() {
    PGIMAGEM.style.display = "flex";
    let tempo = tempoImg;
    INSTXTCRONOMETROIMG.innerText = tempo;

    let intervalo = setInterval(() => {
        tempo -= 0.1;

        if (tempo <= 0) {
            PGIMAGEM.style.display = "none";
            clearInterval(intervalo);
            recomecando();
            rodadaResposta();      
        } else {
            INSTXTCRONOMETROIMG.innerText = tempo.toFixed(1);
        }
    }, 100);
}

let butlog = document.getElementById("butlog"); //BOTÃO ENVIAR

butlog.addEventListener("click", function(){
    //PEGA OS CAMPOS PREENCHIDOS E ANALISA
    let nome = document.getElementById("nomelog").value;
    let senha = document.getElementById("senhalog").value;
    let rptsenha = document.getElementById("rptsenhalog").value;

    let cardPlayer = document.getElementById("jogador");
    if(nome!="" && senha!="" && rptsenha!=""){
        if(senha===rptsenha){
            //TIRA A DIV DE LOGIN E VOLTA O QUE TINHA
            console.log("name:   "+ nome)
            cardPlayer.innerText += nome;
            butLogin.style.display='flex';
            telaLogin.style.display='none';
            butComecar.style.display="flex";
            return false;
        } else{
            alert("senhas imcompatíveis!")
        }
        
    } else{
        alert("campos não preenhcidos!")
    }
    
})
