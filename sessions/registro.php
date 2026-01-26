<?php
session_start();
include '../includes/db_conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptación segura
    $rol = $_POST['rol'];
    try {
        $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nom, :em, :pass, :rol)");
        $stmt->bindValue(':nom', $nombre, SQLITE3_TEXT);
        $stmt->bindValue(':em', $email, SQLITE3_TEXT);
        $stmt->bindValue(':pass', $password, SQLITE3_TEXT);
        $stmt->bindValue(':rol', $rol, SQLITE3_TEXT);

        if ($stmt->execute()) {
            header("Location: login.php?registro=exito");
            exit();
        }
    } catch (Exception $e) {
        $mensaje = "Error: El email ya está registrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../styles/style.css">
    <title>Registro - GYM</title>
</head>

<body>
    <form method="POST">
        <h2>Únete al GYM</h2>
        <?php echo $mensaje; ?>
        <input type="text" name="nombre" placeholder="Nombre completo" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <select name="rol">
            <option value="basic">Plan Básico</option>
            <option value="premium">Plan Premium</option>
        </select>
        <button type="submit">Registrarme</button>
    </form>
</body>

</html>