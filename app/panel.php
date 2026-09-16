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
body{font-family:monospace;background:#0d0d0d;color:#eee;margin:0;padding:30px;}
.container{max-width:700px;margin:0 auto;}
h1{color:#e63946;}
.flag{background:#1a1a1a;border:2px dashed #4dff9e;color:#4dff9e;padding:12px;border-radius:6px;margin:12px 0;}
.card{background:#1a1a1a;border:1px solid #333;padding:15px;border-radius:6px;margin-bottom:15px;}
textarea{width:100%;background:#0d0d0d;color:#eee;border:1px solid #555;border-radius:4px;padding:8px;box-sizing:border-box;font-family:monospace;}
button{padding:8px 16px;background:#c61b28;color:#fff;border:none;border-radius:4px;cursor:pointer;font-family:monospace;margin-top:8px;}
.note{border-bottom:1px solid #333;padding:8px 0;font-size:13px;}
nav a{color:#e63946;margin-right:15px;font-size:13px;}
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
