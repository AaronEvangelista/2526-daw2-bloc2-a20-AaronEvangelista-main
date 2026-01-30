<?php
session_start();
include '../includes/db_conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    $checkEmail = $db->prepare("SELECT COUNT(*) as cuenta FROM usuarios WHERE email = :em");
    $checkEmail->bindValue(':em', $email, SQLITE3_TEXT);
    $res = $checkEmail->execute();
    $fila = $res->fetchArray(SQLITE3_ASSOC);

    if ($fila['cuenta'] > 0) {
        $mensaje = "Error: El email ya esta registrado.";
    } else {
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
            $mensaje = "Error critico al registrar el usuario.";
        }
    }
}

include '../includes/header.php';
?>

<div class="auth-wrapper">
    <div class="login-card shadow-lg">
        <h2>UNETE AL GYM</h2>

        <?php if ($mensaje): ?>
            <div class="alert-error"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>NOMBRE COMPLETO</label>
                <input type="text" name="nombre" class="custom-input" placeholder="Tu nombre" required>
            </div>

            <div class="form-group">
                <label>CORREO ELECTRONICO</label>
                <input type="email" name="email" class="custom-input" placeholder="correo@gym.com" required>
            </div>

            <div class="form-group">
                <label>CONTRASEÑA</label>
                <input type="password" name="password" class="custom-input" placeholder="********" required>
            </div>

            <div class="form-group mb-4">
                <label>SELECCIONA TU PLAN</label>
                <select name="rol" class="custom-input">
                    <option value="user">PLAN BASICO</option>
                    <option value="premium">PLAN PREMIUM</option>
                </select>
            </div>

            <button type="submit" class="btn-gym-main shadow">REGISTRARME</button>
        </form>

        <div class="auth-footer text-center mt-3">
            <p>Ya tienes cuenta? <a href="login.php" class="text-info">Inicia sesion</a></p>
            <a href="../index.php" class="back-link text-white-50 small"><- Volver al inicio</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>