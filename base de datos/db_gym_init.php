<?php
// creacion de la db
$db = new SQLite3('gym_db.db');

$db->exec("PRAGMA foreign_keys = ON;");


$db->exec("CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    rol TEXT NOT NULL DEFAULT 'basic' 
)");


$db->exec("CREATE TABLE IF NOT EXISTS clases (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    dia_semana TEXT NOT NULL,
    hora_inicio TEXT NOT NULL,
    hora_fin TEXT NOT NULL,
    sala TEXT,
    id_profesor INTEGER,
    aforo_maximo INTEGER DEFAULT 20,
    solo_premium INTEGER DEFAULT 0, 
    FOREIGN KEY (id_profesor) REFERENCES usuarios(id) ON DELETE SET NULL
)");


$db->exec("CREATE TABLE IF NOT EXISTS reservas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_usuario INTEGER NOT NULL,
    id_clase INTEGER NOT NULL,
    fecha_reserva TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_clase) REFERENCES clases(id) ON DELETE CASCADE,
    UNIQUE(id_usuario, id_clase)
)");

$check_users = $db->querySingle("SELECT count(*) FROM usuarios");

if ($check_users == 0) {
    $pass = password_hash('1234', PASSWORD_DEFAULT);

    $sql_insert_users = "INSERT INTO usuarios (nombre, email, password, rol) VALUES
    ('Jefe Gym', 'admin@gym.com', '$pass', 'admin'),
    ('Profe Juan', 'juan@gym.com', '$pass', 'profe'),
    ('Ana Premium', 'ana@gym.com', '$pass', 'premium'),
    ('Pepe Basico', 'pepe@gym.com', '$pass', 'basic')";

    if ($db->exec($sql_insert_users)) {
        echo "Usuarios insertados correctamente.<br>";
    } else {
        echo "Error al insertar usuarios: " . $db->lastErrorMsg() . "<br>";
    }
}


$check_clases = $db->querySingle("SELECT count(*) FROM clases");

if ($check_clases == 0) {
    $sql_insert_clases = "INSERT INTO clases (nombre, descripcion, dia_semana, hora_inicio, hora_fin, sala, id_profesor, aforo_maximo, solo_premium) VALUES
    ('Zumba Power', 'Clase de baile intenso para quemar calorias.', 'Lunes', '10:00', '11:00', 'Sala 1', 2, 20, 0),
    ('Yoga Elite', 'Relajacion y estiramientos .', 'Martes', '18:00', '19:00', 'Sala Zen', 2, 5, 1),
    ('Crossfit', 'Entrenamiento de alta intensidad.', 'Miercoles', '19:00', '20:00', 'Sala Box', 2, 15, 0)";

    if ($db->exec($sql_insert_clases)) {
        echo "Clases insertadas correctamente.<br>";
    } else {
        echo "Error al insertar clases: " . $db->lastErrorMsg() . "<br>";
    }
}

echo "<h3>Base de datos 'gym_db.db' creada.</h3>";
echo "<a href='../index.php'>Ir al home</a>";
