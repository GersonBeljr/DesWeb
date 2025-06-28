<?php
session_start();

// Inclui as credenciais de conexão (deixe este arquivo fora do htdocs por segurança)
require('TRABFINAL CREDS.php');

// Conecta ao MySQL (sem especificar banco inicialmente)
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Cria o banco de dados
$sql = "CREATE DATABASE IF NOT EXISTS trabalhoFinal";
if (mysqli_query($conn, $sql)) {
  #  echo "Database 'trabalhoFinal' created successfully<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Seleciona o banco de dados
mysqli_select_db($conn, 'trabalhoFinal');

// Cria a tabela USER
$sql = "CREATE TABLE IF NOT EXISTS USER (
    nome VARCHAR(50) NOT NULL PRIMARY KEY,
    senha VARCHAR(50) NOT NULL,
    pontos INT
)";
if (mysqli_query($conn, $sql)) {
 #  echo "Table 'USER' created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

/*
    // SQL para dropar a tabela (usar apenas se for necessário alterar a estrutura da tabela)
    // **DEIXAR COMENTADO SEMPRE, PELO AMOR DE DEUS**
    $sql = "DROP TABLE IF EXISTS USER";
    if (mysqli_query($conn, $sql)) {
        echo "Tabela 'USER' excluída com sucesso.";
    } else {
        echo "Erro ao excluir tabela: " . mysqli_error($conn);
    }
*/

// Fechar conexão
//mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Trabalho WEB </title>
    <link rel="stylesheet" href="styles/styleGeral.css">
    <link rel="stylesheet" href="styles/styleJogoFim.css">
    <link rel="stylesheet" href="styles/styleJogoGeral.css">
    <link rel="stylesheet" href="styles/styleJogoImagem.css">
    <link rel="stylesheet" href="styles/styleJogoIniciar.css">
    <link rel="stylesheet" href="styles/styleJogoRespostas.css">
</head>
<body class="main">
    <div class="header">
        <h4>Jogo das Imagens</h4>
    </div>
    <div class="container">
    <div id="jogador">PLAYER: <?php echo $_SESSION['usuario_nome'] ?? '---'; ?></div>


     <!--PARTE DE LOGIN------------------------------------------------------------------------>
        <div id="colLogin">
            <button id="butlogin">LOGIN</button>
            <div id="login" > 
                <form method="post" action="indexTRAB.php">
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
                $name = $_POST['fname'] ?? '';
                $senha = $_POST['fsenha'] ?? '';
                $rptsenha = $_POST['frptsenha'] ?? '';
                $_SESSION['usuario_nome'] = $name;
                header("Location: " . $_SERVER['PHP_SELF']);//ATUALIZA A PAG PARA MUDAR A DIV JOGADOR (BUG VISUAL)
                //echo "DEU CERTO";
                if (!empty($name)&&!empty($senha)&&!empty($rptsenha)) {
                    verifica_campo($name);
                    verifica_campo($senha);
                    verifica_campo($rptsenha);

                    
                        $stmt = $conn->prepare("SELECT senha FROM USER WHERE nome = ?");
                        $stmt->bind_param("s", $name);
                        $stmt->execute();
                        $stmt->bind_result($senhaBD);
                    // Se já existir o usuário, verifica a senha
                         if ($stmt->fetch()) {
                    // Usuário existe — verifica senha
                    if ($senha === $senhaBD) {
                            setcookie("usuario", $name, time() + 86400, "/"); //1 dia
                            $_SESSION['usuario_nome'] = $name;
                            echo "Login bem-sucedido!";
                        } else {
                            echo "Senha incorreta.";
                        }
                    } else{
                        //NOVO USUÁRIO
                        $stmt->close();

                        if ($senha === $rptsenha) {
                            $stmtInsert = $conn->prepare("INSERT INTO USER (nome, senha, pontos) VALUES (?, ?, 0)");
                            $stmtInsert->bind_param("ss", $name, $senha);
                            if ($stmtInsert->execute()) {
                                setcookie("usuario", $name, time() + 3600, "/");
                                $_SESSION['usuario_nome'] = $name;
                                echo "Cadastro e login feitos com sucesso!";
                            } else {
                                echo "Erro ao inserir usuário.";
                            }
                            $stmtInsert->close();
                        } else {
                            echo "Senhas não coincidem.";
                        }
                    }
                    $stmt->close();
                } else {
                    echo "Preencha todos os campos.";
                }

                // Corrige pontuações NULL
                mysqli_query($conn, "UPDATE USER SET pontos = 0 WHERE pontos IS NULL;");
                //mysqli_close($conn);
            }
        ?>
        <!--PARTE DE LOGIN------------------------------------------------------------------------>
        
        <!--Corpo do jogo-->
        <div class="jogo">
            <!--Jogo--> 
            <div class="iniciar_regras" id="pgIni">
                <div class="regras">
                    <p>
                        Selecione uma dificuldade e clique em iniciar, 
                        você vai ter um tempo limite para visualizar e ela sumirá em seguida, 
                        então escreva o maximo de palavras que puder para ganhar pontos
                    </p>
                </div>
                <div class="iniciar">
                        <label for="dificuldade">Defina a dificulade</label>
                        <div class="selecaoDificuldade">
                            <p >0.2s</p>
                            <input type="range" id="nivel" name="dificuldade" min="2" max="10">
                            <p >1s</p>
                        </div>          
                    <button id="iniciar">Iniciar</button>
                </div>
            </div>
            <div class="imagem" id="pgImg">
                <img id="imagem" src="https://picsum.photos/1920/1080?random=<?= rand() ?>" alt="Imagem aleatória">
                <div class="cronometro">
                    <p>TEMPO: <span id="cronometro">10</span></p>   
                </div>
            </div>
            <div class="respostas" id="pgResp">
                <h4>Digite!:</h4>
                <div class="quadro" id="quadro">
                   
                  <!--<p class="certo">Garfo</p>
                    <p class="errado">Garfo</p>   -->  
                </div>
                <div class="input_contador">
                    <input type="text" class="inputRespostas" id="input_respostas">
                    <p id="contador">0</p>
                </div>
            </div>
            <div class="fim" id="pgFim">
                <p><span id="jogador"></span>, pontuação: <span id="pontuaçãoFinal"></span></p>
                <button id="jogarNovamente">Jogar novamente</button>
            </div>
        </div>
        <div class="leaderboard">
            <!--Leadearboard-->
            <h4>Leaderboard</h4>
               <div id="leaderb">
        <h1>LEADERBOARD</h1>
       
        <table>
            <tr>
            
                <th>Posição</th>
                <th>Jogador</th>
                <th>Pontos</th>
                <?php
                    $sql = "SELECT nome, pontos FROM USER ORDER BY pontos DESC LIMIT 10";
                    $result = mysqli_query($conn, $sql);

                    $posicao = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $posicao++ . "º</td>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td>" . $row['pontos'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tr>
            <?php
            $posicao = 1;
            
            ?>
        </table>

    </div>
            <div class="cards">
                <!--
                <div class="card">
                    <p class="posição"><span id="posicao">1</span>&deg</p>
                    <div class="jogador">
                        <p>Gerson Bel</p>
                        <p>1000000000</p>
                    </div>
                </div>
                <div class="card">
                    <p class="posição"><span id="posicao">1</span>&deg</p>
                    <div class="jogador">
                        <p>Gerson Bel</p>
                        <p>1000000000</p>
                    </div>
                </div> 
                -->
                
            </div>
        </div>
    </div>
    <div class="footer">
        <!--FOOTER-->
        <h5>Responsaveis:</h5>
        <p>Gerson Belniowski - GRR20240439</p>
        <p>João Victor Timoteo - GRR20246658</p>
        <p>Juliano Vidal - GRR2024</p>
        <p>Roberto Rigo - GRR20240574</p>
    </div>
    
    <script src="scripts/scriptVars.js"></script>
    <script src="scripts/scriptPontuando.js"></script>
    <script src="scripts/scriptJogo.js"></script>
    <script src="scripts/scriptInicioFim.js"></script>
    <?php mysqli_close($conn);?>
</body>
</html>