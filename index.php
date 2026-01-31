<?php
session_start();
include 'includes/header.php';
?>

<section class="hero-section text-center text-white d-flex align-items-center" style="min-height: 80vh; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('img/fondo.jpg'); background-size: cover; background-position: center;">
    <div class="container">
        <h1 class="display-2 fw-bold" style="font-family: 'Oswald', sans-serif;">ENTRENA SIN LIMITES</h1>
        <p class="lead mb-4" style="font-family: 'Montserrat', sans-serif;">El gimnasio mas completo para alcanzar tus objetivos fitness</p>

        <?php if (!isset($_SESSION['rol'])): ?>
            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                <a href="sessions/registro.php" class="btn btn-info btn-lg px-5 py-3 shadow">UNIRSE AHORA</a>
                <a href="sessions/login.php" class="btn btn-outline-light btn-lg px-5 py-3">INICIAR SESION</a>
            </div>
        <?php else: ?>
            <a href="pages/perfil.php" class="btn btn-info btn-lg px-5 py-3 shadow">IR A MI PANEL</a>
        <?php endif; ?>
    </div>
</section>

<section class="py-5 bg-dark">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow border-info">
                    <h3 class="text-info">MAQUINARIA</h3>
                    <p class="text-muted">Equipamiento de ultima generacion para fuerza y cardio</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow border-info">
                    <h3 class="text-info">CLASES</h3>
                    <p class="text-muted">Yoga, CrossFit, Boxeo y mucho mas con los mejores instructores</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow border-info">
                    <h3 class="text-info">PLANES</h3>
                    <p class="text-muted">Suscripciones flexibles que se adaptan a tu ritmo de vida</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-black">
    <div class="container text-center">
        <h2 class="mb-5" style="color: #fff;">NUESTROS SERVICIOS</h2>
        <div class="row justify-content-center">

            <?php if (!isset($_SESSION['rol'])): ?>
                <div class="col-lg-6 mb-4">
                    <div class="p-5 border border-secondary h-100">
                        <h4 style="color: #fff;">PLAN BASICO</h4>
                        <p class="display-4 my-3" style="color: #fff;">29.99€</p>
                        <ul class="list-unstyled mb-4" style="color: #eee;">
                            <li>Acceso zona de pesas</li>
                            <li>Vestuarios y duchas</li>
                        </ul>
                        <a href="sessions/registro.php" class="btn btn-outline-info w-100">SELECCIONAR</a>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="p-5 border border-info h-100">
                        <h4 class="text-info">PLAN PREMIUM</h4>
                        <p class="display-4 my-3" style="color: #fff;">49.99€</p>
                        <ul class="list-unstyled mb-4" style="color: #eee;">
                            <li>Acceso total 24/7</li>
                            <li>Todas las clases incluidas</li>
                        </ul>
                        <a href="sessions/registro.php" class="btn btn-info w-100">SELECCIONAR</a>
                    </div>
                </div>

            <?php elseif ($_SESSION['rol'] == 'basic' || $_SESSION['rol'] == 'user'): ?>
                <div class="col-lg-10">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-5 border border-secondary h-100">
                                <h3 style="color: #fff;">TUS CLASES BASICAS</h3>
                                <p style="color: #bbb;">Consulta los horarios de Yoga y Cardio disponibles para tu plan.</p>
                                <a href="pages/verClases.php" class="btn btn-outline-light w-100">VER HORARIOS</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-5 border border-info h-100" style="background: rgba(0, 207, 209, 0.1);">
                                <h3 class="text-info">PASA AL SIGUIENTE NIVEL</h3>
                                <p style="color: #fff;">Desbloquea nuevas clases y mas.</p>
                                <a href="#" class="btn btn-info w-100">Mejora a Premium</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="col-lg-8">
                    <div class="p-5 border border-info">
                        <h3 class="text-info">ERES MIEMBRO PREMIUM</h3>
                        <p style="color: #eee;">Tienes acceso total a todas nuestras instalaciones y clases dirigidas.</p>
                        <a href="pages/verClases.php" class="btn btn-outline-info">CONSULTAR MIS CLASES</a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>