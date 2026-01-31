<?php
session_start();
include '../includes/db_conexion.php';
include '../includes/header.php';

if (!isset($_SESSION['rol'])) {
    die("<div class='container mt-5'><div class='alert alert-danger'>Error: No has iniciado sesion. <a href='../sessions/login.php' class='alert-link'>Ir al Login</a></div></div>");
}

$resultado = $db->query("SELECT * FROM clases");
?>

<div class="container mt-5">
    <h2 class="text-center mb-5 display-4" style="font-family: 'Oswald', sans-serif; color: #00cfd1;">HORARIO DE CLASES</h2>
    <div class="row">
        <?php while ($clase = $resultado->fetchArray(SQLITE3_ASSOC)): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow border-secondary bg-dark">

                    <div class="image-wrapper" style="height: 200px; overflow: hidden; border-bottom: 2px solid #00cfd1;">
                        <img src="<?php echo $clase['imagen']; ?>" class="w-100" style="object-fit: cover; height: 100%; opacity: 0.8;">
                    </div>

                    <div class="card-body text-center p-4">
                        <div class="profile-name text-uppercase">
                            <h3 class="h4 text-info" style="font-family: 'Oswald';"><?php echo htmlspecialchars($clase['nombre']); ?></h3>
                            <p class="small text-white-50"><?php echo htmlspecialchars($clase['descripcion']); ?></p>
                        </div>

                        <div class="mb-3 py-2 border-top border-bottom border-secondary">
                            <span class="d-block small text-uppercase" style="color: #00cfd1;">Dias y Ubicacion</span>
                            <strong class="text-white"><?php echo $clase['dia_semana']; ?></strong> |
                            <strong class="text-white"><?php echo $clase['sala']; ?></strong>
                        </div>

                        <div class="row g-0 mb-4">
                            <div class="col-4">
                                <div class="profile-overview">
                                    <p class="mb-0 small text-muted">INICIO</p>
                                    <h5 class="text-white"><?php echo $clase['hora_inicio']; ?></h5>
                                </div>
                            </div>
                            <div class="col-4 border-start border-end border-secondary">
                                <div class="profile-overview">
                                    <p class="mb-0 small text-muted">SALA</p>
                                    <h5 class="text-white"><?php echo $clase['sala']; ?></h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="profile-overview">
                                    <p class="mb-0 small text-muted">FIN</p>
                                    <h5 class="text-white"><?php echo $clase['hora_fin']; ?></h5>
                                </div>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <?php
                            $es_premium = ($clase['solo_premium'] == 1);

                            $es_basico = ($_SESSION['rol'] == 'basic' || $_SESSION['rol'] == 'user');

                            if ($es_premium && $es_basico):
                            ?>
                                <button type="button" class="btn btn-secondary w-100" disabled style="cursor: not-allowed; opacity: 0.6; background-color: #333; border-color: #444;">
                                    <i class="bi bi-lock-fill"></i> SOLO PREMIUM
                                </button>
                                <p class="text-warning small mt-2 mb-0">
                                    Mejora tu plan para reservar
                                </p>

                            <?php else: ?>
                                <a href="guardarReserva.php?id=<?php echo $clase['id']; ?>" class="btn btn-info w-100 fw-bold">
                                    RESERVAR PLAZA
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>