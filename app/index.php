<?php
require 'config.php';

if (isset($_SESSION['user'])) {
    header('Location: panel.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    $query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";

    $row = false;
    try {
        $stmt = $db->query($query);
        $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
    } catch (Exception $e) {
        $row = false;
    }

    if ($row) {
        $_SESSION['user'] = $row['username'];
        header('Location: panel.php');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>LAS NOCHES · Acceso</title>
<style>
body{font-family:monospace;background:#0d0d0d;color:#eee;display:flex;align-items:center;justify-content:center;height:100vh;margin:0;}
.box{background:#1a1a1a;padding:30px 40px;border:2px solid #c61b28;border-radius:6px;width:320px;}
h1{color:#e63946;font-size:18px;text-align:center;}
input{width:100%;padding:8px;margin:6px 0;background:#0d0d0d;border:1px solid #555;color:#eee;border-radius:4px;box-sizing:border-box;}
button{width:100%;padding:9px;margin-top:10px;background:#c61b28;color:#fff;border:none;border-radius:4px;cursor:pointer;font-family:monospace;}
button:hover{background:#e63946;}
.error{color:#ff8a3d;font-size:13px;text-align:center;margin-top:8px;}
.sub{color:#888;font-size:11px;text-align:center;margin-bottom:15px;}
</style>
</head>
<body>
<div class="box">
    <h1>🌙 LAS NOCHES</h1>
    <div class="sub">Panel de administración — acceso restringido</div>
    <form method="POST">
        <input type="text" name="username" placeholder="Usuario" autocomplete="off">
        <input type="password" name="password" placeholder="Contraseña" autocomplete="off">
        <button type="submit">Entrar</button>
    </form>
    <?php if ($error): ?><div class="error"><?php echo $error; ?></div><?php endif; ?>
</div>
</body>
</html>
