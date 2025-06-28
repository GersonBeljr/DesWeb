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
                mysqli_close($conn);
            }
        ?>

        <!--PARTE DE LOGIN------------------------------------------------------------------------>