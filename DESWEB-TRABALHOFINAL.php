
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="DESWEB-TRABALHOFINAL-CSS.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
</head>



<header>
    <h1 id="title">JOGO DO DETRAN!!!</h1>
</header>

<?php
    #include 'TRABFINAL CREDS.php';
    #$conn = mysqli($servername, $username, $password);

    #setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<body>
    
    <div id="corpo">
        <div id="colLogin">
            <button id="butlogin">LOGIN</button>
            <div id="login" >
                <div ><input type="text" id="nomelog" placeholder="Nome"></div>
                <div ><input type="text" id="senhalog" placeholder="Senha"></div>
                <div><button id="butEntrar">entrar</button></div>
            </div>
        </div>

        <div id="part1">
            <div><img src="" id="img"></div>
            <span id="time"></span>
        </div>
        <div id="part2">
            <input type="text" id="resp" hidden>
            <button id="env" hidden onclick="responder()">enviar</button>
            <div><span id="score" hidden>pontuação: </span></div>
        </div> <br>
        <button id="comecar" onclick="comecar()">COMEÇAR</button>
    </div>
</body>

<script id="arq" type="text/javascript" src="DESWEB-TRABALHOFINAL-JS.js"></script>