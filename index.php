<?php
session_start();
include 'includes/header.php';
?>

<div class="hero-section text-white d-flex align-items-center" style="position: relative; min-height: 85vh; background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center; background-attachment: fixed;">

    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.65);"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-1 fw-bold mb-3" style="font-family: 'Oswald', sans-serif; letter-spacing: 2px;">
                    ENTRENA SIN <span class="text-info" style="color: #00cfd1 !important;">LIMITES</span>
                </h1>
                <p class="lead fs-3 mb-5" style="font-family: 'Montserrat', sans-serif; font-weight: 300;">
                    Bienvenido a GYM Ilernitas. Gestiona tus clases dirigidas y alcanza tus objetivos con los mejores profesionales.
                </p>

                <div class="card bg-dark bg-opacity-75 border-info p-4 d-inline-block shadow-lg">
                    <h2 class="h4 text-white" style="font-family: 'Oswald', sans-serif;">Hola, <?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : 'Atleta'; ?>!</h2>
                    <p class="text-light" style="font-family: 'Montserrat', sans-serif;">
                        Estado: <span class="badge bg-info text-dark"><?php echo isset($_SESSION['rol']) ? strtoupper($_SESSION['rol']) : 'Invitado'; ?></span>
                    </p>

                    <div class="d-flex gap-3 mt-3">
                        <a href="pages/verClases.php" class="btn btn-info btn-lg fw-bold px-4">Ver Horarios</a>

                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                            <a href="pages/perfil.php" class="btn btn-outline-warning btn-lg px-4">Panel Control</a>
                        <?php elseif (!isset($_SESSION['rol'])): ?>
                            <a href="sessions/login.php" class="btn btn-outline-light btn-lg px-4">Iniciar Sesion</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="py-5 bg-white text-dark shadow-sm">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/69/69840.png" alt="Icono" width="45" class="mb-3">
                    <h6 class="fw-bold uppercase" style="font-family: 'Oswald', sans-serif;">Sin Permanencia</h6>
                    <p class="small text-muted" style="font-family: 'Montserrat', sans-serif;">Libertad total para entrenar cuando quieras.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/2964/2964514.png" alt="Icono" width="45" class="mb-3">
                    <h6 class="fw-bold uppercase" style="font-family: 'Oswald', sans-serif;">Zonas de Fuerza</h6>
                    <p class="small text-muted" style="font-family: 'Montserrat', sans-serif;">Equipamiento de ultima generacion.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/84/84145.png" alt="Icono" width="45" class="mb-3">
                    <h6 class="fw-bold uppercase" style="font-family: 'Oswald', sans-serif;">+100 Clases</h6>
                    <p class="small text-muted" style="font-family: 'Montserrat', sans-serif;">Yoga, HIIT, Spinning y mucho mas.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/2784/2784459.png" alt="Icono" width="45" class="mb-3">
                    <h6 class="fw-bold uppercase" style="font-family: 'Oswald', sans-serif;">Horario Amplio</h6>
                    <p class="small text-muted" style="font-family: 'Montserrat', sans-serif;">Abrimos todos los dias del año.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4" style="font-family: 'Oswald', sans-serif;">¿LISTO PARA EMPEZAR?</h2>
        <p class="text-muted mb-4" style="font-family: 'Montserrat', sans-serif;">Unete a la comunidad de Ilernitas y transforma tu cuerpo.</p>
        <?php if (!isset($_SESSION['rol'])): ?>
            <a href="sessions/registro.php" class="btn btn-dark btn-xl px-5 py-3 fw-bold">REGISTRATE AHORA</a>
        <?php endif; ?>
    </div>
</section>

<?php
include 'includes/footer.php';
?>