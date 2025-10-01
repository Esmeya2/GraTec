<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $_SESSION['user'] = $email;
        header("Location: perfil.php");
        exit;
    } else {
        $erro = "Login inválido!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Área do Cliente</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <header><h1>Área do Cliente</h1></header>
  <main>
    <?php if(isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <form method="post">
      <label>Email:</label><br>
      <input type="email" name="email" required><br><br>

      <label>Senha:</label><br>
      <input type="password" name="senha" required><br><br>

      <button type="submit" class="btn">Entrar</button>
    </form>
  </main>
</body>
</html>
