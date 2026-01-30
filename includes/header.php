<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$ruta_base = file_exists('styles/style.css') ? "" : "../";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo $ruta_base; ?>img/FotoWeb.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=Oswald:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $ruta_base; ?>styles/style.css">

    <title>NOVA GYM</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $ruta_base; ?>index.php">
                NOVA <span>GYM</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta_base; ?>index.php">Inicio</a>
                    </li>

                    <?php if (isset($_SESSION['rol'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $ruta_base; ?>pages/perfil.php">Mi Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="<?php echo $ruta_base; ?>sessions/logout.php">Cerrar Sesion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $ruta_base; ?>sessions/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $ruta_base; ?>sessions/registro.php">Registro</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>