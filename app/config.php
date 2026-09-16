<?php
session_start();
$db = new PDO('sqlite:/var/www/html/database.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
