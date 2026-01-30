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

include '../includes/header.php';
?>

<div class="auth-wrapper">
    <div class="login-card shadow-lg">
        <h2>Acceso Miembros</h2>

        <?php if ($error): ?>
            <div class="alert-error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['registro']) && $_GET['registro'] == 'exito'): ?>
            <div class="alert alert-success text-center" style="border-radius: 0; background: rgba(40, 167, 69, 0.2); color: #28a745; border: 1px solid #28a745;">
                ¡Registro completado! Ya puedes entrar.
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>CORREO ELECTRÓNICO</label>
                <input type="email" name="email" class="custom-input" placeholder="ejemplo@gym.com" required>
            </div>

            <div class="form-group mb-4">
                <label>CONTRASEÑA</label>
                <input type="password" name="password" class="custom-input" placeholder=".............." required>
            </div>

            <button type="submit" class="btn-gym-main shadow">Entrar al Gym</button>
        </form>

        <div class="auth-footer text-center mt-3">
            <p>¿No tienes cuenta? <a href="registro.php" class="text-info">Registrate aqui</a></p>
            <a href="../index.php" class="back-link text-white-50 small">← Volver al inicio</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>