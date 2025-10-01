<?php
// perfil.php - perfil do usuário logado
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
require_once 'db.php';
$user = $_SESSION['user'];
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Perfil - <?=htmlspecialchars($user['username'])?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="app-header">
    <h1>Meu Perfil</h1>
    <div class="top-right-actions">
      <a href="logout.php" class="btn ghost">Sair</a>
    </div>
  </header>
  <div class="container">
    <div class="center-box">
      <h2><?=htmlspecialchars($user['full_name'] ?? $user['username'])?></h2>
      <p><strong>Usuário:</strong> <?=htmlspecialchars($user['username'])?></p>
      <p><strong>Email:</strong> <?=htmlspecialchars($user['email'] ?? '-')?></p>
      <div style="margin-top:12px;">
        <a href="agendamento.php" class="btn">Agendar</a>
        <a href="orcamento.php" class="btn ghost">Pedir Orçamento</a>
      </div>
    </div>
  </div>
</body>
</html>
