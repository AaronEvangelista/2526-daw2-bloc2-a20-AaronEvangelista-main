<?php
include '../includes/header.php';

if (!isset($_SESSION['rol'])) {
    header("Location: ../sessions/login.php");
    exit();
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-dark text-white p-4 shadow border-info text-center" style="border-radius: 0;">
                <h3 style="font-family: 'Oswald', sans-serif;">MI PERFIL</h3>
                <hr class="border-info">

                <!-- para poder tener un avatar una img de perfil -->
                <div class="mb-4">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['nombre']); ?>&background=00cfd1&color=000&size=150&bold=true"
                        class="rounded-circle border border-info shadow"
                        alt="Avatar">
                </div>

                <p style="font-family: 'Montserrat', sans-serif;">
                    <strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['nombre']); ?>
                </p>
                <p style="font-family: 'Montserrat', sans-serif;">
                    <strong>Rango:</strong>
                    <span class="badge bg-info text-dark"><?php echo strtoupper($_SESSION['rol']); ?></span>
                </p>
            </div>
        </div>

        <div class="col-md-8">
            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <div class="card bg-dark text-white p-4 shadow border-secondary" style="border-radius: 0;">
                    <h3 style="font-family: 'Oswald', sans-serif; color: #00cfd1;">PANEL DE ADMIN</h3>
                    <div class="row mt-4">
                        <div class="col-sm-4">
                            <a href="crearClases.php" class="btn btn-success w-100 py-3 mb-2" style="border-radius: 0; font-family: 'Oswald', sans-serif;"> Añadir Clase</a>
                        </div>
                        <div class="col-sm-4">
                            <a href="eliminarClases.php" class="btn btn-danger w-100 py-3 mb-2" style="border-radius: 0; font-family: 'Oswald', sans-serif;"> Eliminar Clases</a>
                        </div>
                        <div class="col-sm-4">
                            <a href="editarClases.php" class="btn btn-warning w-100 py-3 mb-2" style="border-radius: 0; font-family: 'Oswald', sans-serif;"> Editar Clases</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="card bg-dark text-white p-4 shadow border-secondary" style="border-radius: 0;">
                    <h3 style="font-family: 'Oswald', sans-serif;">MIS PROXIMAS CLASES</h3>
                    <p class="text-muted">Aun no tienes reservas activas.</p>
                    <a href="verClases.php" class="btn btn-info py-3" style="border-radius: 0; font-family: 'Oswald', sans-serif;">VER HORARIOS PARA RESERVAR</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>