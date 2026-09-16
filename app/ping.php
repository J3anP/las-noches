<?php
require 'config.php';
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$output = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ip'])) {
    $ip = $_POST['ip'];
    $output = shell_exec("ping -c 1 " . $ip . " 2>&1");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>LAS NOCHES · Conectividad</title>
<style>
body{font-family:'Courier New',monospace;background-color:#07070a;background-image:radial-gradient(ellipse 60% 42% at 50% 0%, rgba(232,234,240,0.13), rgba(232,234,240,0) 65%),url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='4' height='4'><rect width='4' height='4' fill='%230a0a0d'/><rect x='0' y='0' width='1' height='1' fill='%23151518'/><rect x='2' y='1' width='1' height='1' fill='%230d0d10'/><rect x='1' y='3' width='1' height='1' fill='%23181820'/><rect x='3' y='2' width='1' height='1' fill='%230c0c0f'/></svg>");background-size:cover,4px 4px;image-rendering:pixelated;color:#cfcfd6;margin:0;padding:30px;min-height:100vh;position:relative;}
.container{position:relative;z-index:1;max-width:650px;margin:0 auto;}
h1{color:#eceef2;letter-spacing:1px;text-shadow:0 0 10px rgba(236,238,242,0.3);}
.card{background:rgba(17,17,20,0.92);border:1px solid #3a3a42;border-top:2px solid #8f8f98;padding:20px;border-radius:2px;}
input{padding:8px;width:70%;background:#0a0a0c;color:#eee;border:1px solid #45454d;border-radius:2px;font-family:inherit;}
button{padding:8px 16px;background:#26262b;color:#eceef2;border:1px solid #55555d;border-radius:2px;cursor:pointer;font-family:inherit;}
button:hover{background:#38383f;border-color:#8f8f98;}
pre{background:#000;padding:12px;border-radius:2px;overflow-x:auto;font-size:12px;color:#c7cdd6;white-space:pre-wrap;word-break:break-all;border:1px solid #2a2a30;}
nav a{color:#c9c9d0;text-decoration:none;border-bottom:1px solid transparent;}
nav a:hover{border-bottom:1px solid #8f8f98;}
</style>
</head>
<body>
<div class="container">
    <h1>🌐 Verificar conectividad</h1>
    <nav><a href="panel.php">← Volver al panel</a></nav>
    <div class="card" style="margin-top:15px;">
        <p>Ingresa una IP para verificar si el servidor puede alcanzarla.</p>
        <form method="POST">
            <input type="text" name="ip" placeholder="ej. 8.8.8.8" autocomplete="off">
            <button type="submit">Ping</button>
        </form>
        <?php if ($output): ?><pre><?php echo htmlspecialchars($output); ?></pre><?php endif; ?>
    </div>
</div>
</body>
</html>
