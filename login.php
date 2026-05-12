<?php
require_once 'mobil.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth = new Mobil();
    if ($auth->loginUser($_POST['username'], $_POST['password'])) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SEWA MOBIL</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background: #f0f2f5; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 350px; }
        .login-box h2 { text-align: center; margin-bottom: 30px; color: #2c3e50; }
        .form-group { margin-bottom: 20px; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .btn-login { width: 100%; padding: 12px; background: #4e73df; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .error { color: #e74a3b; text-align: center; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>LOGIN ADMIN</h2>
        <?php if($error): ?> <div class="error"><?= $error ?></div> <?php endif; ?>
        <form method="POST">
            <div class="form-group"><input type="text" name="username" placeholder="Username" required></div>
            <div class="form-group"><input type="password" name="password" placeholder="Password" required></div>
            <button type="submit" class="btn-login">MASUK</button>
        </form>
    </div>
</body>
</html>