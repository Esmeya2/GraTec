<?php
// admin.php - painel simplificado para admin
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
require_once 'db.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Painel Admin</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="app-header">
    <h1>Painel Administrativo</h1>
    <div class="top-right-actions">
      <a href="logout.php" class="btn ghost">Sair</a>
    </div>
  </header>
  <div class="container">
    <div class="center-box">
      <h2>Usuários cadastrados</h2>
      <?php
      $stmt = $pdo->query("SELECT id,username,email,full_name,role,created_at FROM users ORDER BY created_at DESC");
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if ($users): ?>
        <table>
          <thead><tr><th>Nome</th><th>Usuário</th><th>Email</th><th>Perfil</th><th>Criado</th></tr></thead>
          <tbody>
            <?php foreach($users as $row): ?>
            <tr>
              <td><?=htmlspecialchars($row['full_name'])?></td>
              <td><?=htmlspecialchars($row['username'])?></td>
              <td><?=htmlspecialchars($row['email'])?></td>
              <td><?=htmlspecialchars($row['role'])?></td>
              <td><?=htmlspecialchars($row['created_at'])?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      <?php else: ?>
        <p class="small">Nenhum usuário cadastrado ainda.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
