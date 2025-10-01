<?php
// orcamento.php - solicitar orçamento
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php");
        exit;
    }
    $user_id = $_SESSION['user']['id'];
    $titulo = trim($_POST['titulo'] ?? '');
    $valor_est = trim($_POST['valor_est'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    $stmt = $pdo->prepare("INSERT INTO orcamentos (user_id, titulo, valor_est, descricao) VALUES (?,?,?,?)");
    $stmt->execute([$user_id, $titulo, $valor_est, $descricao]);
    header("Location: perfil.php");
    exit;
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Orçamento</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="app-header">
    <h1>Pedido de Orçamento</h1>
    <div class="top-right-actions">
      <a href="index.php" class="btn ghost">Voltar</a>
    </div>
  </header>
  <div class="container">
    <div class="center-box">
      <h2>Solicitar Orçamento</h2>
      <form method="post" onsubmit="return validarFormulario(this)">
        <label>Título</label>
        <input name="titulo" required>
        <label>Valor Estimado (opcional)</label>
        <input name="valor_est">
        <label>Descrição</label>
        <textarea name="descricao" rows="5" required></textarea>
        <button class="primary" type="submit">Enviar</button>
      </form>
    </div>
  </div>
</body>
</html>
