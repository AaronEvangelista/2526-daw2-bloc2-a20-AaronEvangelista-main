<?php
session_start();
require_once '../includes/db_conexion.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $res = $stmt->execute();
    $user = $res->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id_usuario'] = $user['id'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['rol'] = $user['rol'];

        header("Location: ../index.php");
        exit();
    } else {
        $error = "Email o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Login - GYM</title>
</head>

<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email (admin@gym.com)" required>
            <input type="password" name="password" placeholder="Contraseña (1234)" required>
            <button type="submit">Entrar</button>
        </form>
        <p><a href="../index.php">Volver al inicio</a></p>
    </div>
</body>

</html>