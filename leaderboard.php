<div id="leaderb">
        <h1>LEADERBOARD</h1>
       
        <table>
            <tr>
            
                <th>Posição</th>
                <th>Jogador</th>
                <th>Pontos</th>
                <?php
                    $sql = "SELECT nome, pontos FROM USER ORDER BY pontos DESC LIMIT 10"; //SELCIONA OS 10 PRIMEIROS EM PONTOS
                    $result = mysqli_query($conn, $sql);

                    $posicao = 1;
                    while ($row = mysqli_fetch_assoc($result)) { //CRIA UMA NOVA LINHA PARA CADA POSIÇÃO
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