<?php
require 'config.php';
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $target = '/var/www/html/uploads/' . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
        $safeName = htmlspecialchars(basename($_FILES['file']['name']));
        $msg = "✅ Archivo subido: <a href='uploads/$safeName' target='_blank'>uploads/$safeName</a>";
    } else {
        $msg = "❌ Error al subir el archivo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>LAS NOCHES · Subir archivo</title>
<style>
body{font-family:'Courier New',monospace;background-color:#07070a;background-image:radial-gradient(ellipse 60% 42% at 50% 0%, rgba(232,234,240,0.13), rgba(232,234,240,0) 65%),url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='4' height='4'><rect width='4' height='4' fill='%230a0a0d'/><rect x='0' y='0' width='1' height='1' fill='%23151518'/><rect x='2' y='1' width='1' height='1' fill='%230d0d10'/><rect x='1' y='3' width='1' height='1' fill='%23181820'/><rect x='3' y='2' width='1' height='1' fill='%230c0c0f'/></svg>");background-size:cover,4px 4px;image-rendering:pixelated;color:#cfcfd6;margin:0;padding:30px;min-height:100vh;position:relative;}
.container{position:relative;z-index:1;max-width:600px;margin:0 auto;}
h1{color:#eceef2;letter-spacing:1px;text-shadow:0 0 10px rgba(236,238,242,0.3);}
.card{background:rgba(17,17,20,0.92);border:1px solid #3a3a42;border-top:2px solid #8f8f98;padding:20px;border-radius:2px;}
button{padding:8px 16px;background:#26262b;color:#eceef2;border:1px solid #55555d;border-radius:2px;cursor:pointer;font-family:inherit;margin-top:10px;}
button:hover{background:#38383f;border-color:#8f8f98;}
a{color:#b9c7d6;}
.msg{margin-top:12px;font-size:13px;}
nav a{color:#c9c9d0;text-decoration:none;border-bottom:1px solid transparent;}
nav a:hover{border-bottom:1px solid #8f8f98;}
</style>
</head>
<body>
<div class="container">
    <h1>📤 Subir archivo — Perfil de administrador</h1>
    <nav><a href="panel.php">← Volver al panel</a></nav>
    <div class="card" style="margin-top:15px;">
        <p>Sube una imagen de perfil para tu cuenta de administrador.</p>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <br><button type="submit">Subir</button>
        </form>
        <?php if ($msg): ?><div class="msg"><?php echo $msg; ?></div><?php endif; ?>
    </div>
</div>
</body>
</html>
