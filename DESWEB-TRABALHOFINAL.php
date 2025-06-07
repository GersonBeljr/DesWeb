
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="DESWEB-TRABALHOFINAL-CSS.css">
</head>
<script id="arq" type="text/javascript" src="DESWEB-TRABALHOFINAL-JS.js"></script>


<header>
    <h1 id="title">JOGO DO DETRAN!!!</h1>
</header>

<body>
    <div id="corpo">
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