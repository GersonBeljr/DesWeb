<?php
session_start();
$conn = mysqli_connect($servername, $username, $password);

require('TRABFINAL CREDS.php');

if (!isset($_SESSION['usuario_nome'])) {
    http_response_code(403);
    echo "Usuário não autenticado";
    exit;
}

$conn = mysqli_connect($servername, $username, $password, $dbTRABFINAL);
if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

$nome = $_SESSION['usuario_nome'];
$sql = "UPDATE USER SET pontos = pontos + 1 WHERE nome = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome);

if ($stmt->execute()) {
    echo "Ponto atualizado";
} else {
    echo "Erro ao atualizar: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);
?>