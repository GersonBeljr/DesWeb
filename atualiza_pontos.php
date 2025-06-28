<?php
session_start();
require('TRABFINAL CREDS.php');
//CONECTA
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    http_response_code(500);
    die("Erro de conexão.");
}

mysqli_select_db($conn, $dbTRABFINAL);

$nome = $_SESSION['usuario_nome'] ?? null;

if (!$nome) {
    http_response_code(403);
    die("Usuário não autenticado.");
}
//AUMENTA 1 PONTO TODA VEZ QUE É CHAMADO. SE JOGADOR GANHAR 5 PONTOS TEM QUE CHAMAR 5 VEZES
$sql = "UPDATE USER SET pontos = pontos + 1 WHERE nome = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome);

if ($stmt->execute()) {
    echo "Ponto atualizado!";
} else {
    echo "Erro ao atualizar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
