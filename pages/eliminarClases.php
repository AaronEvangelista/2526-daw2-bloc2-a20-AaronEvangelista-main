<?php
session_start();
include '../includes/db_conexion.php';
include '../includes/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("<div class='container mt-5'><div class='alert alert-danger'>Acceso denegado. Solo admins.</div></div>");
}

if (isset($_GET['eliminar_id'])) {
    $id_a_borrar = $_GET['eliminar_id'];
    $db->exec("DELETE FROM clases WHERE id = $id_a_borrar");
    echo "<div class='alert alert-success text-center'>Clase eliminada correctamente</div>";
}

$resultado = $db->query("SELECT * FROM clases");
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gestionar Clases - Eliminar</h2>

    <div class="table-responsive">
        <table class="table table-dark table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dia</th>
                    <th>Horario</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($clase = $resultado->fetchArray(SQLITE3_ASSOC)): ?>
                    <tr>
                        <td><?php echo $clase['id']; ?></td>
                        <td><?php echo htmlspecialchars($clase['nombre']); ?></td>
                        <td><?php echo $clase['dia_semana']; ?></td>
                        <td><?php echo $clase['hora_inicio'] . " - " . $clase['hora_fin']; ?></td>
                        <td>
                            <a href="eliminarClases.php?eliminar_id=<?php echo $clase['id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Seguro que quieres borrar esta clase')">
                                Borrar
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="perfil.php" class="btn btn-secondary">Volver al Panel</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>