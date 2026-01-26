<?php
session_start();
include '../includes/db_conexion.php';
include '../includes/header.php';

if (!isset($_SESSION['rol'])) {
    die("<div class='container mt-5'><div class='alert alert-danger'>Error: No has iniciado sesión. <a href='../sessions/login.php' class='alert-link'>Ir al Login</a></div></div>");
}

$resultado = $db->query("SELECT * FROM clases");
?>

<div class="container mt-5">
    <h2 class="text-center mb-5 display-4" style="font-family: 'Bebas Neue', cursive; color: #ff4d05;">Horario de Clases</h2>
    <div class="row">
        <?php while ($clase = $resultado->fetchArray(SQLITE3_ASSOC)): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="profile-card-4 text-center shadow">

                    <div class="image-wrapper" style="height: 200px; overflow: hidden;">
                        <img src="<?php echo $clase['imagen']; ?>" class="img img-responsive w-100" style="object-fit: cover; height: 100%;">
                    </div>

                    <div class="profile-content">
                        <div class="profile-name text-uppercase">
                            <?php echo htmlspecialchars($clase['nombre']); ?>
                            <p><?php echo htmlspecialchars($clase['descripcion']); ?></p>
                        </div>

                        <div class="profile-description">
                            Días: <strong><?php echo $clase['dia_semana']; ?></strong> <br>
                            Ubicación: <strong><?php echo $clase['sala']; ?></strong>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="profile-overview">
                                    <p>INICIO</p>
                                    <h4><?php echo $clase['hora_inicio']; ?></h4>
                                </div>
                            </div>
                            <div class="col-4 border-start border-end">
                                <div class="profile-overview">
                                    <p>SALA</p>
                                    <h4><?php echo $clase['sala']; ?></h4>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="profile-overview">
                                    <p>FIN</p>
                                    <h4><?php echo $clase['hora_fin']; ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <?php if ($clase['solo_premium'] == 1 && $_SESSION['rol'] == 'basic'): ?>
                                <button class="btn btn-secondary w-100 disabled">Solo Premium</button>
                            <?php else: ?>
                                <a href="reservarServicio.php?id=<?php echo $clase['id']; ?>" class="btn btn-success w-100">Reservar Plaza</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>