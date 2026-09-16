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
body{font-family:monospace;background:#0d0d0d;color:#eee;margin:0;padding:30px;}
.container{max-width:600px;margin:0 auto;}
h1{color:#e63946;}
.card{background:#1a1a1a;border:1px solid #333;padding:20px;border-radius:6px;}
button{padding:8px 16px;background:#c61b28;color:#fff;border:none;border-radius:4px;cursor:pointer;font-family:monospace;margin-top:10px;}
a{color:#4dd9ff;}
.msg{margin-top:12px;font-size:13px;}
nav a{color:#e63946;}
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
