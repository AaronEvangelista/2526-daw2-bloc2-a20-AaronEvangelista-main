<?php
try {
    if (file_exists('base_de_datos/gym_db.db')) {
        $db = new SQLite3('base_de_datos/gym_db.db');
    } else {
        $db = new SQLite3('../base_de_datos/gym_db.db');
    }
    $db->exec("PRAGMA foreign_keys = ON;");
} catch (Exception $e) {
    die("no se ecnontro la basa de datos.");
}
