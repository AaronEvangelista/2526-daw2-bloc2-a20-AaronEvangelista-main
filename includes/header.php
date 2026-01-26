<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$url_base = (basename($_SERVER['PHP_SELF']) == 'index.php' && !strpos($_SERVER['PHP_SELF'], 'pages')) ? '' : '../';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Ilernitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=Oswald:wght@500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $url_base; ?>styles/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $url_base; ?>index.php">ILERNITAS <span>GYM</span></a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base; ?>index.php">Inicio</a>
                    </li>

                    <?php if (isset($_SESSION['rol'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>pages/verClases.php">Horarios</a>
                        </li>

                        <li class="nav-item ms-lg-3">
                            <a class="nav-link fw-bold text-info" href="<?php echo $url_base; ?>pages/perfil.php">
                                Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-outline-danger ms-lg-2" href="<?php echo $url_base; ?>sessions/logout.php">Salir</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>sessions/login.php">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>