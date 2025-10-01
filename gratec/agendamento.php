<?php
// agendamento.php - página para criar agendamentos (usuário precisa estar logado)
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // usuário deve estar logado
    if (!isset($_SESSION['user'])) {
        header("Location: index.php");
        exit;
    }
    $user_id = $_SESSION['user']['id'];
    $assunto = trim($_POST['assunto'] ?? '');
    $data_evento = trim($_POST['data_evento'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    $stmt = $pdo->prepare("INSERT INTO agendamentos (user_id, assunto, data_evento, descricao) VALUES (?,?,?,?)");
    $stmt->execute([$user_id, $assunto, $data_evento, $descricao]);
    header("Location: perfil.php");
    exit;
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Agendamento</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="app-header">
    <h1>Agendamento</h1>
    <div class="top-right-actions">
      <a href="index.php" class="btn ghost">Voltar</a>
    </div>
  </header>
  <div class="container">
    <div class="center-box">
      <h2>Solicitar Agendamento</h2>
      <form method="post" onsubmit="return validarFormulario(this)">
        <label>Assunto</label>
        <input name="assunto" required>
        <label>Data / Hora</label>
        <input type="datetime-local" name="data_evento" required>
        <label>Descrição</label>
        <textarea name="descricao" rows="5" required></textarea>
        <button class="primary" type="submit">Enviar pedido</button>
      </form>
    </div>
  </div>
</body>
</html>
