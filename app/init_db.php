<?php
$db = new PDO('sqlite:/var/www/html/database.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL
)");

$db->exec("CREATE TABLE IF NOT EXISTS notes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    content TEXT NOT NULL,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
)");

$stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->execute(['admin', 'B0ss_2026!']);

$stmt2 = $db->prepare("INSERT INTO notes (content) VALUES (?)");
$stmt2->execute(['Recordatorio: revisar backups pendientes del panel.']);

echo "Base de datos inicializada correctamente.\n";
