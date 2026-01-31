<?php
include '../includes/header.php';
include '../includes/db_conexion.php';

if (!isset($_SESSION['rol'])) {
    header("Location: ../sessions/login.php");
    exit();
}
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-dark text-white p-4 shadow border-info text-center h-100" style="border-radius: 0;">
                <h3 style="font-family: 'Oswald', sans-serif;">MI PERFIL</h3>
                <hr class="border-info">

                <div class="mb-4">
                    <img src="../img/perfilFoto.jpg"
                        class="rounded-circle border border-info shadow"
                        alt="Avatar"
                        style="width: 150px; height: 150px; object-fit: cover;">
                </div>

                <p style="font-family: 'Montserrat', sans-serif;">
                    <strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['nombre']); ?>
                </p>
                <p style="font-family: 'Montserrat', sans-serif;">
                    <strong>Rol:</strong>
                    <span class="badge bg-info text-dark"><?php echo strtoupper($_SESSION['rol']); ?></span>
                </p>
                <p style="font-family: 'Montserrat', sans-serif;">
                    <strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?>
                </p>
            </div>
        </div>

        <div class="col-md-8">

            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <div class="card bg-dark text-white p-4 shadow border-secondary" style="border-radius: 0;">
                    <h3 style="font-family: 'Oswald', sans-serif; color: #00cfd1;">PANEL DE ADMIN</h3>

                    <div class="row mt-4 mb-3">
                        <div class="col-12">
                            <a href="adminUsuarios.php" class="btn btn-outline-info w-100 py-3 fw-bold" style="border-radius: 0; border-width: 2px;">
                                GESTIONAR USUARIOS (CREAR / BORRAR)
                            </a>
                        </div>
                    </div>

                    <h5 class="mt-2 text-muted" style="font-family: 'Oswald', sans-serif;">GESTION DE CLASES</h5>
                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <a href="crearClases.php" class="btn btn-success w-100 py-3 mb-2" style="border-radius: 0;"> Anadir Clase</a>
                        </div>
                        <div class="col-sm-4">
                            <a href="eliminarClases.php" class="btn btn-danger w-100 py-3 mb-2" style="border-radius: 0;"> Eliminar Clases</a>
                        </div>
                        <div class="col-sm-4">
                            <a href="editarClases.php" class="btn btn-warning w-100 py-3 mb-2" style="border-radius: 0;"> Editar Clases</a>
                        </div>
                    </div>
                </div>

            <?php elseif ($_SESSION['rol'] === 'profe'): ?>
                <div class="card bg-dark text-white p-4 shadow border-secondary" style="border-radius: 0;">
                    <h3 style="font-family: 'Oswald', sans-serif; color: #00cfd1;">GESTION DE MIS CLASES</h3>
                    <p class="text-white-50">Actualizar los horarios de clases</p>

                    <div class="table-responsive">
                        <table class="table table-dark table-hover border-secondary">
                            <thead>
                                <tr class="text-info">
                                    <th>Clase</th>
                                    <th>Horario Actual</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id_profe = $_SESSION['id'];
                                $query = "SELECT * FROM clases WHERE id_profesor = $id_profe";
                                $res = $db->query($query);
                                $tiene_clases = false;

                                while ($clase = $res->fetchArray(SQLITE3_ASSOC)):
                                    $tiene_clases = true;
                                ?>
                                    <tr>
                                        <td class="align-middle fw-bold"><?php echo htmlspecialchars($clase['nombre']); ?></td>
                                        <td class="align-middle">
                                            <?php echo $clase['dia_semana']; ?><br>
                                            <small class="text-muted"><?php echo $clase['hora_inicio'] . ' - ' . $clase['hora_fin']; ?></small>
                                        </td>
                                        <td class="align-middle">
                                            <a href="gestionClases.php?id=<?php echo $clase['id']; ?>" class="btn btn-outline-info btn-sm">
                                                Modificar Horario
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>

                                <?php if (!$tiene_clases): ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-3">No tienes clases asignadas actualmente.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php else: ?>
                <div class="card bg-dark text-white p-4 shadow border-secondary" style="border-radius: 0;">
                    <h3 style="font-family: 'Oswald', sans-serif;">MIS RESERVAS</h3>

                    <?php
                    $id_user = $_SESSION['id'];
                    $sql_reservas = "SELECT r.id as id_reserva, c.nombre, c.dia_semana, c.hora_inicio 
                                     FROM reservas r 
                                     JOIN clases c ON r.id_clase = c.id 
                                     WHERE r.id_usuario = $id_user";
                    $res_reservas = $db->query($sql_reservas);
                    $hay_reservas = false;
                    ?>

                    <ul class="list-group list-group-flush mt-3 bg-dark">
                        <?php while ($reserva = $res_reservas->fetchArray(SQLITE3_ASSOC)):
                            $hay_reservas = true;
                        ?>
                            <li class="list-group-item bg-dark text-white border-secondary d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="text-info"><?php echo $reserva['nombre']; ?></strong>
                                    <span class="d-block small text-muted"><?php echo $reserva['dia_semana'] . ' ' . $reserva['hora_inicio']; ?></span>
                                </div>
                                <a href="../sessions/cancelarReserva.php?id=<?php echo $reserva['id_reserva']; ?>" class="btn btn-sm btn-danger">Cancelar</a>
                            </li>
                        <?php endwhile; ?>
                    </ul>

                    <?php if (!$hay_reservas): ?>
                        <p class="text-muted mt-3">Aun no tienes reservas activas.</p>
                        <a href="verClases.php" class="btn btn-info py-3 mt-2" style="border-radius: 0; font-family: 'Oswald', sans-serif;">VER HORARIOS PARA RESERVAR</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>