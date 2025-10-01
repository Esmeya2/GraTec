<?php
// index.php - página inicial com opções de login/cadastro
session_start();
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Minha Empresa - Início</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
</head>
<body>
  <header class="app-header">
    <h1>Minha Empresa</h1>
    <div class="top-right-actions">
      <a href="#" class="btn ghost" data-show="loginForm">Login</a>
      <a href="#" class="btn" data-show="registerForm">Cadastro</a>
    </div>
  </header>

  <div class="container">
    <div class="center-box">
      <h2>Bem-vindo</h2>
      <p class="small">Acesse sua área, agende serviços e peça orçamentos.</p>
      <?php if(isset($_SESSION['user'])): ?>
        <p>Olá, <strong><?=htmlspecialchars($_SESSION['user']['full_name'] ?? $_SESSION['user']['username'])?></strong></p>
        <p><a href="perfil.php" class="btn">Ver Perfil</a> <a href="logout.php" class="btn ghost">Sair</a></p>
      <?php else: ?>
        <p class="small">Use os botões no canto superior para entrar ou se cadastrar.</p>
      <?php endif; ?>
    </div>

    <div class="center-box">
      <h3>Serviços</h3>
      <p class="small">Aqui você pode ver uma lista de serviços e solicitar orçamento ou agendar.</p>
      <div class="space-between" style="width:100%; margin-top:12px;">
        <a href="agendamento.php" class="btn">Agendar</a>
        <a href="orcamento.php" class="btn ghost">Pedir Orçamento</a>
      </div>
    </div>
  </div>

  <!-- forms (simples) -->
  <div id="loginForm" class="modal-form" style="display:none; padding:20px;">
    <div class="container">
      <div class="center-box">
        <h2>Login</h2>
        <form method="post" action="login.php" onsubmit="return validarFormulario(this)">
          <label for="login_user">Usuário ou e-mail</label>
          <input id="login_user" name="user" type="text" required>
          <label for="login_pass">Senha</label>
          <input id="login_pass" name="pass" type="password" required>
          <button class="primary" type="submit">Entrar</button>
          <a href="#" class="link" data-show="registerForm">Quero me cadastrar</a>
        </form>
      </div>
    </div>
  </div>

  <div id="registerForm" class="modal-form" style="display:none; padding:20px;">
    <div class="container">
      <div class="center-box">
        <h2>Cadastro</h2>
        <form method="post" action="register.php" onsubmit="return validarFormulario(this)">
          <label>Nome completo</label>
          <input name="full_name" type="text" required>
          <label>Usuário</label>
          <input name="username" type="text" required>
          <label>Email</label>
          <input name="email" type="email" required>
          <label>Senha</label>
          <input name="password" type="password" required>
          <button class="primary" type="submit">Cadastrar</button>
          <a href="#" class="link" data-show="loginForm">Já tenho conta</a>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
