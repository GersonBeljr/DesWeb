//LISTA DE RESPOSTAS AINDA VAZIA PQ AINDA N DEFINIU QUAL IMAGEM VAI SER
  let list= [];
   let pontos;
    let butComecar = document.getElementById("comecar");
    let pontosTotal;
function comecar(){
    pontos = 0;
    //console.log("deu");
    //RETIRA A MARGEM E O BOTÃO COMECAR
        document.getElementById("butlogin").style.display='none';
        butComecar.style.display="none";
        document.getElementById("corpo").style.margin = "2%";
        let img = document.getElementById("img");
   
    //SORTEAR IMG
        let sort = Math.floor((Math.random()*3));
        console.log("bla"+sort);
        if(sort === 0){
            //COLOCA IMG
                    img.src="https://ogimg.infoglobo.com.br/epoca/24838907-38a-e25/FT1086A/000_Hkg10257970.jpg";
                    img.style.height='500px';

            //LISTA DE RESPOSTAS. SUJEITO A ALTERAÇÕES
                    list = ["gato", "2 gato", "3 gato", "4 gato"];
        }
        if(sort === 1){
            //COLOCA IMG
                    img.src="https://fly.metroimg.com/upload/q_85,w_700/https://uploads.metroimg.com/wp-content/uploads/2023/06/07181116/Design-sem-nome-2023-06-07T180626.475.jpg";
                    img.style.height='500px';

            //LISTA DE RESPOSTAS. SUJEITO A ALTERAÇÕES
                    list = ["cachorro", "2 cachorro", "3 cachorro", "4 cachorro"];
        } 
        if(sort === 2){
            //COLOCA IMG
                    img.src="https://i.ytimg.com/vi/nqvlc_8anxk/maxresdefault.jpg";
                    img.style.height='500px';
            //LISTA DE RESPOSTAS. SUJEITO A ALTERAÇÕES
                    list = ["passaro", "2 passaro", "3 passaro", "4 passaro"];
        } 
        



    
    //TEMPO PRA PESSOA VER A IMG
        let time = 5.1;
        let timeInt = setInterval(() => {
            time-=0.1;
            document.getElementById("time").innerText="Tempo: "+time.toFixed(1);
            if(time <= 0){
                clearInterval(timeInt);
                //REMOVE A IMG
                    img.src="";
                    img.style.height='';
                //MOSTRA INPUT, ENVIAR E PONTUAÇÃO
                    document.getElementById("resp").style.display="flex";
                    document.getElementById("env").style.display="flex";
                    document.getElementById("score").style.display="flex";
                    
                //TEMPO SOME
                    document.getElementById("time").innerText="";
                //BOTÃO COMEÇAR VOLTA
                document.getElementById("comecar").innerText="Tentar denovo";
                document.getElementById("comecar").style.display="flex";
                
            } else{
                //VOLTA TUDO SE APERTAR EM TENTAR DENOVO
                document.getElementById("resp").setAttribute("hidden", true);
                document.getElementById("resp").value="";
                document.getElementById("env").setAttribute("hidden", true);
                document.getElementById("score").setAttribute("hidden", true);
                document.getElementById("score").innerHTML ="pontuação: ";
            }
        }, 100);
}


function responder(){
    let resp = document.getElementById("resp").value;

    //ANDA A LISTA DE RESPOSTA E VE SE ACERTOU
        for(let i=0; i<list.length; i++){
            if(resp===list[i]){
                list.splice(i,1);
                pontos++;
                pontosTotal++;
                document.getElementById("score").innerHTML ="pontuação: "+ pontos;
            }
        }
} 


//PARTE DE LOGIN
let butLogin = document.getElementById("butlogin"); //BOTÃO LOGIN
let telaLogin = document.getElementById("login");

//APARECE A DIV DE LOGIN
butLogin.addEventListener('click',function(event){
    //console.log("cuceta")
    document.getElementById("comecar").style.display='none';
    butLogin.style.display='none';
    telaLogin.style.display='flex';
    telaLogin.setAttribute('class', 'w3-container w3-center w3-animate-left');
})


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
            cardPlayer.innerText += "\n" + nome;
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