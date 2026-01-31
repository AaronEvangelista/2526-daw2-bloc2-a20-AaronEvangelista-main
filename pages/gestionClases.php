<?php
session_start();
include '../includes/db_conexion.php';
include '../includes/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'profe') {
    die("<script>window.location.href='../index.php';</script>");
}

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_clase = $_POST['id_clase'];
    $nuevo_dia = $_POST['dia_semana'];
    $nueva_inicio = $_POST['hora_inicio'];
    $nueva_fin = $_POST['hora_fin'];
    $id_profe = $_SESSION['id'];

    $stmt = $db->prepare("UPDATE clases SET dia_semana = :dia, hora_inicio = :ini, hora_fin = :fin WHERE id = :cid AND id_profesor = :uid");
    $stmt->bindValue(':dia', $nuevo_dia, SQLITE3_TEXT);
    $stmt->bindValue(':ini', $nueva_inicio, SQLITE3_TEXT);
    $stmt->bindValue(':fin', $nueva_fin, SQLITE3_TEXT);
    $stmt->bindValue(':cid', $id_clase, SQLITE3_INTEGER);
    $stmt->bindValue(':uid', $id_profe, SQLITE3_INTEGER);

    if ($stmt->execute()) {
        echo "<script>window.location.href='perfil.php';</script>";
        exit;
    } else {
        $mensaje = "Error al actualizar. Inténtalo de nuevo.";
    }
}

if (isset($_GET['id'])) {
    $id_clase = $_GET['id'];
    $id_profe = $_SESSION['id'];

    $query = $db->prepare("SELECT * FROM clases WHERE id = :id AND id_profesor = :uid");
    $query->bindValue(':id', $id_clase, SQLITE3_INTEGER);
    $query->bindValue(':uid', $id_profe, SQLITE3_INTEGER);
    $resultado = $query->execute();
    $clase = $resultado->fetchArray(SQLITE3_ASSOC);

    if (!$clase) {
        echo "<div class='container mt-5'><div class='alert alert-danger'>No tienes permiso para editar esta clase.</div><a href='perfil.php' class='btn btn-dark'>Volver</a></div>";
        include '../includes/footer.php';
        exit();
    }
} else {
    header("Location: perfil.php");
    exit();
}
?>

<div class="container mt-5 mb-5" style="max-width: 600px;">
    <div class="card bg-dark text-white shadow border-info">
        <div class="card-header bg-transparent border-info text-center">
            <h3 style="font-family: 'Oswald', sans-serif;">EDITAR HORARIO</h3>
            <h5 class="text-info"><?php echo htmlspecialchars($clase['nombre']); ?></h5>
        </div>
        <div class="card-body p-4">

            <?php if ($mensaje): ?>
                <div class="alert alert-danger"><?php echo $mensaje; ?></div>
            <?php endif; ?>

            <form action="gestionClases.php" method="POST">
                <input type="hidden" name="id_clase" value="<?php echo $clase['id']; ?>">

                <div class="mb-3">
                    <label class="form-label text-white-50">Día de la Semana</label>
                    <select name="dia_semana" class="form-select bg-secondary text-white border-0">
                        <?php
                        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                        foreach ($dias as $dia) {
                            $selected = ($clase['dia_semana'] == $dia) ? 'selected' : '';
                            echo "<option value='$dia' $selected>$dia</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label text-white-50">Hora Inicio</label>
                        <input type="time" name="hora_inicio" class="form-control bg-secondary text-white border-0"
                            value="<?php echo $clase['hora_inicio']; ?>" required>
                    </div>

                    <div class="col-6 mb-3">
                        <label class="form-label text-white-50">Hora Fin</label>
                        <input type="time" name="hora_fin" class="form-control bg-secondary text-white border-0"
                            value="<?php echo $clase['hora_fin']; ?>" required>
                    </div>
                </div>

                <div class="alert alert-secondary mt-2 text-center" style="font-size: 0.9em;">
                    <i class="fas fa-info-circle"></i> Solo puedes modificar el horario.
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-info fw-bold text-dark">GUARDAR CAMBIOS</button>
                    <a href="perfil.php" class="btn btn-outline-light">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>