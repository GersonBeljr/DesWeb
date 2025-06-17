
<head>
    <meta charset="UTF-8">
    <title>JOGASSO DO DETRAN</title>
    <link rel="stylesheet" href="DESWEB-TRABALHOFINAL-CSS.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">

    <?php
    #SANITIZAÇÃO
        function verifica_campo($texto){
        $texto = trim($texto);
        $texto = stripslashes($texto);
        $texto = htmlspecialchars($texto);
        return $texto;
        }
    ?>
</head>



<header>
    <h1 id="title">JOGO DO DETRAN!!!</h1>
</header>

<?php
    require('TRABFINAL CREDS.php'); #fica fora do htdocs????

    $conn = mysqli_connect($servername, $username, $password);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  #CRIA DB
       /* BD JÁ FOI CRIADO, NÃO DESCOMENTAR
            $sql = "CREATE DATABASE $dbTRABFINAL";
            #echo $sql;
            if (mysqli_query($conn, $sql)) {
                echo "Database created successfully<br>";
            } else {
                echo "Error creating database: " . mysqli_error($conn) . "<br>";
            }
        */
    #USA DB
        $sql = "use $dbTRABFINAL";
        if (mysqli_query($conn, $sql)) {
            #echo "Database selected successfully<br>";
        } else {
            echo "Error creating database: " . mysqli_error($conn) . "<br>";
        }

        // SQL para dropar a tabela
        /* SOMENTE CASO NECESSITE ALTERAR ALGO NA TABLE USERS*** 
            *****************DEIXAR COMENTADO SEMPRE PELO AMOR DE DEUS****************
        $sql = "DROP TABLE IF EXISTS user";

        if ($conn->query($sql) === TRUE) {
            echo "Tabela excluída com sucesso.";
        } else {
            echo "Erro ao excluir tabela: " . $con->error;
        }
        */

    #CRIA TABLE USERS
    /*TBM JA FOI CRIADA, NÃO DESCOMENTAR
        $sql = "CREATE TABLE USER (
        nome VARCHAR(50) NOT NULL PRIMARY KEY,
        senha varchar(50) not null,
        pontos integer
        );";

        #TESTA
        if (mysqli_query($conn, $sql)) {
            echo "Table user created successfully <br>";
        } else {
            echo "Error creating table: " . mysqli_error($conn) . "<br>";
        }*/


//FINALIZA
mysqli_close($conn);

    #setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<body>
    
    <div id="corpo">

    <div id="jogador">PLAYER </div>

        <!--PARTE DE LOGIN------------------------------------------------------------------------>

        
        <div id="colLogin">
            <button id="butlogin">LOGIN</button>
            <div id="login" > 
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return false">
                    <div ><input type="text" id="nomelog" placeholder="Nome" name="fname"></div>
                    <div ><input type="text" id="senhalog" placeholder="Senha" name="fsenha"></div>
                    <div ><input type="text" id="rptsenhalog" placeholder="Repetir Senha" name="frptsenha"></div>
                    <div><input id="butlog" type="submit"></div> 
                </form>
            </div>
        </div>
        
        <?php
            $logado= false;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['fname'];
                $senha = $_POST['fsenha'];
                $rptsenha = $_POST['frptsenha'];
                if (!empty($name)&&!empty($senha)&&!empty($rptsenha)) {
                    verifica_campo($name);
                    verifica_campo($senha);
                    verifica_campo($rptsenha);

                    $logado=true;
                    #echo $name, $senha, $rptsenha; 

                    if($senha===$rptsenha){
                        #COLOCA USER NO BD
                        $sql= "INSERT INTO USERS (nome, senha) VALUES('$name', '$senha')";
                        echo "senhas iguais";
                    } else{
                        echo "Senhas não compactíveis";
                    }
                    
                } else {
                    echo "Existem campos não preenchidos";
                }
            }
        ?>



        <!--PARTE DE LOGIN------------------------------------------------------------------------>




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