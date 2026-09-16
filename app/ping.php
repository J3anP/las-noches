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
body{font-family:monospace;background:#0d0d0d;color:#eee;margin:0;padding:30px;}
.container{max-width:650px;margin:0 auto;}
h1{color:#e63946;}
.card{background:#1a1a1a;border:1px solid #333;padding:20px;border-radius:6px;}
input{padding:8px;width:70%;background:#0d0d0d;color:#eee;border:1px solid #555;border-radius:4px;}
button{padding:8px 16px;background:#c61b28;color:#fff;border:none;border-radius:4px;cursor:pointer;font-family:monospace;}
pre{background:#000;padding:12px;border-radius:4px;overflow-x:auto;font-size:12px;color:#4dd9ff;white-space:pre-wrap;word-break:break-all;}
nav a{color:#e63946;}
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
