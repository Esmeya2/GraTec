<?php
// login.php - processa login cliente e admin
session_start();
require_once 'db.php';

$user = trim($_POST['user'] ?? '');
$pass = trim($_POST['pass'] ?? '');

if (!$user || !$pass) {
    header("Location: index.php");
    exit;
}

// admin hard-coded
if (($user === 'esmeya' || $user === 'admin') && $pass === '0073') {
    $_SESSION['user'] = [
        'id' => 0,
        'username' => 'esmeya',
        'full_name' => 'Administrador',
        'role' => 'admin'
    ];
    header("Location: admin.php");
    exit;
}

// procurar usuário por username ou email
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :u OR email = :u LIMIT 1");
$stmt->execute([':u' => $user]);
$u = $stmt->fetch(PDO::FETCH_ASSOC);

if ($u && password_verify($pass, $u['password'])) {
    $_SESSION['user'] = [
        'id' => $u['id'],
        'username' => $u['username'],
        'email' => $u['email'],
        'full_name' => $u['full_name'],
        'role' => $u['role']
    ];
    header("Location: perfil.php");
    exit;
} else {
    $_SESSION['error'] = "Usuário ou senha inválidos.";
    header("Location: index.php");
    exit;
}
