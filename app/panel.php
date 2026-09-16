<?php
require 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$flag1 = 'flag1{primer_golpe_al_boss}';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note'])) {
    $stmt = $db->prepare("INSERT INTO notes (content) VALUES (?)");
    $stmt->execute([$_POST['note']]);
    header('Location: panel.php');
    exit;
}

$notes = $db->query("SELECT content FROM notes ORDER BY id DESC")->fetchAll(PDO::FETCH_COLUMN);

$flag2 = '';
foreach ($notes as $n) {
    if (stripos($n, '<script') !== false || stripos($n, 'onerror=') !== false) {
        $flag2 = 'flag2{grieta_en_la_armadura}';
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>LAS NOCHES · Panel</title>
<style>
body{font-family:'Courier New',monospace;background-color:#07070a;background-image:radial-gradient(ellipse 60% 42% at 50% 0%, rgba(232,234,240,0.13), rgba(232,234,240,0) 65%),url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='4' height='4'><rect width='4' height='4' fill='%230a0a0d'/><rect x='0' y='0' width='1' height='1' fill='%23151518'/><rect x='2' y='1' width='1' height='1' fill='%230d0d10'/><rect x='1' y='3' width='1' height='1' fill='%23181820'/><rect x='3' y='2' width='1' height='1' fill='%230c0c0f'/></svg>");background-size:cover,4px 4px;image-rendering:pixelated;color:#cfcfd6;margin:0;padding:30px;min-height:100vh;position:relative;}
.container{position:relative;z-index:1;max-width:700px;margin:0 auto;}
h1{color:#eceef2;letter-spacing:1px;text-shadow:0 0 10px rgba(236,238,242,0.3);}
.flag{background:rgba(17,17,20,0.92);border:1px dashed #4dff9e;color:#4dff9e;padding:12px;border-radius:2px;margin:12px 0;}
.card{background:rgba(17,17,20,0.92);border:1px solid #3a3a42;border-top:2px solid #8f8f98;padding:15px;border-radius:2px;margin-bottom:15px;}
textarea{width:100%;background:#0a0a0c;color:#eee;border:1px solid #45454d;border-radius:2px;padding:8px;box-sizing:border-box;font-family:inherit;}
button{padding:8px 16px;background:#26262b;color:#eceef2;border:1px solid #55555d;border-radius:2px;cursor:pointer;font-family:inherit;margin-top:8px;}
button:hover{background:#38383f;border-color:#8f8f98;}
.note{border-bottom:1px solid #333;padding:8px 0;font-size:13px;color:#c9c9ce;}
nav a{color:#c9c9d0;margin-right:15px;font-size:13px;text-decoration:none;border-bottom:1px solid transparent;}
nav a:hover{border-bottom:1px solid #8f8f98;}
</style>
</head>
<body>
<div class="container">
    <h1>🌙 Panel de LAS NOCHES</h1>
    <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>.</p>

    <div class="flag">🚩 <?php echo $flag1; ?></div>

    <nav>
        <a href="upload.php">📤 Subir archivo</a>
        <a href="ping.php">🌐 Verificar conectividad</a>
        <a href="?logout=1">🚪 Salir</a>
    </nav>

    <div class="card">
        <h3>📝 Notas internas</h3>
        <form method="POST">
            <textarea name="note" rows="2" placeholder="Escribe una nota..."></textarea><br>
            <button type="submit">Guardar nota</button>
        </form>
        <div style="margin-top:15px;">
            <?php foreach ($notes as $n): ?>
                <div class="note"><?php echo $n; ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if ($flag2): ?>
        <div class="flag">🚩 <?php echo $flag2; ?></div>
    <?php endif; ?>
</div>
<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>
</body>
</html>
