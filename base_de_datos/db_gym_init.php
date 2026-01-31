<?php
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
    imagen TEXT, 
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
    $passSegura = password_hash('1234', PASSWORD_DEFAULT);

    $sql_users = "INSERT INTO usuarios (nombre, email, password, rol) VALUES
    ('Aaron', 'admin@gym.com', '$passSegura', 'admin'),
    ('Juan', 'juan@gym.com', '$passSegura', 'profe'),
    ('Zhen', 'zhen@gym.com', '$passSegura', 'premium'),
    ('Pepe', 'pepe@gym.com', '$passSegura', 'basic'),
    ('Sarah', 'sarah@gym.com', '$passSegura', 'profe'),
    ('David', 'david@gym.com', '$passSegura', 'profe'),
    ('Luna', 'luna@gym.com', '$passSegura', 'profe'),
    ('Max', 'max@gym.com', '$passSegura', 'profe')";

    $db->exec($sql_users);
    echo "✅ Usuarios y Profesores creados.<br>";
}

$check_clases = $db->querySingle("SELECT count(*) FROM clases");

if ($check_clases == 0) {

    $sql_insert_clases = "INSERT INTO clases (nombre, descripcion, dia_semana, hora_inicio, hora_fin, sala, id_profesor, aforo_maximo, solo_premium, imagen) VALUES
    ('Zumba Power', 'Baile aeróbico para quemar calorías.', 'Lunes', '10:00', '11:00', 'Sala 1', 2, 20, 0, 'https://media.istockphoto.com/id/1067011906/es/foto/fitness-danza.jpg?s=2048x2048&w=is&k=20&c=jFWflFkMLfj9Ydv0fztR4VEXrnpOFLf60nuTt6gYh2c='),
    ('Yoga', 'Relajación y meditación profunda.', 'Martes', '18:00', '19:00', 'Sala Zen', 7, 10, 1, 'https://media.istockphoto.com/id/1472059271/es/foto/hatha-yoga-en-casa.jpg?s=2048x2048&w=is&k=20&c=jS3Vky6e4avBAd_I7vMCGX6pgF0nVVb4QY3g25OYn3Y='),
    ('Crossfit', 'Entrenamiento de alta intensidad.', 'Miércoles', '19:00', '20:00', 'Sala Box', 8, 15, 0, 'https://media.istockphoto.com/id/503416862/es/foto/gimnasio-gimnasio-ejercicio-hombre-listo-para-ejercicio-con-tetera-bell.jpg?s=2048x2048&w=is&k=20&c=Oip8qYCfBLSINuoW2JTwfEZJq1ZUsrIslRVtyQlvLRY='),
    ('Natacion', 'Clases de natación intensiva.', 'Jueves', '08:00', '09:00', 'Piscina A', 6, 25, 0, 'https://media.istockphoto.com/id/622003802/es/foto/entrenamiento-de-nadador-en-forma-en-la-piscina.jpg?s=2048x2048&w=is&k=20&c=4a-6xKXnJVebgDYrjrd27tiC4CTy_Z0jAnmrWfudD2s='),
    ('Boxeo', 'Técnicas de combate y cardio.', 'Viernes', '20:00', '21:00', 'Ring 1', 5, 12, 1, 'https://media.istockphoto.com/id/140376185/es/foto/agresivos-combate-de-boxeo.jpg?s=2048x2048&w=is&k=20&c=w0WxHl7hosmL7F_SWRSJ1jqgsUpCigkVOlKNJL3Lz4g=')";

    $db->exec($sql_insert_clases);
    echo " Clases insertadas.<br>";
}

echo "<hr>";
echo "<h3>Base de datos REINICIADA correctamente.</h3>";
echo "<a href='../index.php' style='background: #00cfd1; color: black; padding: 10px; text-decoration: none; font-weight: bold;'>Ir al Inicio</a>";
