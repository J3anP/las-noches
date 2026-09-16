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
body{font-family:'Courier New',monospace;background-color:#07070a;background-image:radial-gradient(ellipse 60% 42% at 50% 12%, rgba(232,234,240,0.15), rgba(232,234,240,0) 70%),url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='4' height='4'><rect width='4' height='4' fill='%230a0a0d'/><rect x='0' y='0' width='1' height='1' fill='%23151518'/><rect x='2' y='1' width='1' height='1' fill='%230d0d10'/><rect x='1' y='3' width='1' height='1' fill='%23181820'/><rect x='3' y='2' width='1' height='1' fill='%230c0c0f'/></svg>");background-size:cover,4px 4px;image-rendering:pixelated;color:#cfcfd6;display:flex;align-items:center;justify-content:center;height:100vh;margin:0;position:relative;overflow:hidden;}
body::before{content:"";position:fixed;top:9%;left:50%;transform:translateX(-50%);width:64px;height:64px;border-radius:50%;background:#f0eee6;box-shadow:0 0 25px 8px rgba(240,238,230,0.5),0 0 70px 24px rgba(240,238,230,0.15);-webkit-mask-image:radial-gradient(circle at 66% 40%,transparent 42%,#000 43%);mask-image:radial-gradient(circle at 66% 40%,transparent 42%,#000 43%);pointer-events:none;z-index:0;}
.box{position:relative;z-index:1;background:rgba(17,17,20,0.92);padding:30px 40px;border:1px solid #3a3a42;border-top:3px solid #8f8f98;border-radius:2px;width:320px;box-shadow:0 12px 40px rgba(0,0,0,0.65);}
h1{color:#eceef2;font-size:18px;text-align:center;letter-spacing:2px;text-shadow:0 0 12px rgba(236,238,242,0.35);}
input{width:100%;padding:8px;margin:6px 0;background:#0a0a0c;border:1px solid #45454d;color:#eee;border-radius:2px;box-sizing:border-box;font-family:inherit;}
button{width:100%;padding:9px;margin-top:10px;background:#26262b;color:#eceef2;border:1px solid #55555d;border-radius:2px;cursor:pointer;font-family:inherit;letter-spacing:1px;}
button:hover{background:#38383f;border-color:#8f8f98;}
.error{color:#ff8a3d;font-size:13px;text-align:center;margin-top:8px;}
.sub{color:#7a7a82;font-size:11px;text-align:center;margin-bottom:15px;letter-spacing:1px;}
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
