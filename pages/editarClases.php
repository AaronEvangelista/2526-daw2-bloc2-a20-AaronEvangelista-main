<?php
session_start();
include '../includes/db_conexion.php';
include '../includes/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("<div class='container mt-5'><div class='alert alert-danger'>Acceso denegado.</div></div>");
}

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $dia = $_POST['dia_semana'];
    $inicio = $_POST['hora_inicio'];
    $fin = $_POST['hora_fin'];
    $sala = $_POST['sala'];
    $imagen = $_POST['imagen'];
    $aforo = $_POST['aforo_maximo'];

    $sql = "UPDATE clases SET 
            nombre = '$nombre', 
            descripcion = '$descripcion', 
            dia_semana = '$dia', 
            hora_inicio = '$inicio', 
            hora_fin = '$fin', 
            sala = '$sala',
            aforo_maximo = $aforo,
            imagen = '$imagen' 
            WHERE id = $id";

    if ($db->exec($sql)) {
        echo "<div class='alert alert-success text-center mt-3'>Clase actualizada correctamente</div>";
    }
}

if (isset($_GET['id'])):
    $id_editar = $_GET['id'];
    $clase = $db->querySingle("SELECT * FROM clases WHERE id = $id_editar", true);
?>

    <div class="container mt-5">
        <div class="card shadow border-warning">
            <div class="card-header bg-warning text-dark">
                <h3 class="mb-0">Editar Clase: <?php echo htmlspecialchars($clase['nombre']); ?></h3>
            </div>
            <div class="card-body">
                <form method="POST" action="editarClases.php">
                    <input type="hidden" name="id" value="<?php echo $clase['id']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Nombre de la Clase</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($clase['nombre']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripcion</label>
                        <textarea name="descripcion" class="form-control" rows="2"><?php echo htmlspecialchars($clase['descripcion']); ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dia de la semana</label>
                            <select name="dia_semana" class="form-select">
                                <option value="Lunes" <?php if ($clase['dia_semana'] == 'Lunes') echo 'selected'; ?>>Lunes</option>
                                <option value="Martes" <?php if ($clase['dia_semana'] == 'Martes') echo 'selected'; ?>>Martes</option>
                                <option value="Miercoles" <?php if ($clase['dia_semana'] == 'Miercoles') echo 'selected'; ?>>Miercoles</option>
                                <option value="Jueves" <?php if ($clase['dia_semana'] == 'Jueves') echo 'selected'; ?>>Jueves</option>
                                <option value="Viernes" <?php if ($clase['dia_semana'] == 'Viernes') echo 'selected'; ?>>Viernes</option>
                                <option value="Sabado" <?php if ($clase['dia_semana'] == 'Sabado') echo 'selected'; ?>>Sabado</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Aforo Maximo</label>
                            <input type="number" name="aforo_maximo" class="form-control" value="<?php echo $clase['aforo_maximo']; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hora Inicio</label>
                            <input type="time" name="hora_inicio" class="form-control" value="<?php echo $clase['hora_inicio']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hora Fin</label>
                            <input type="time" name="hora_fin" class="form-control" value="<?php echo $clase['hora_fin']; ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sala</label>
                        <input type="text" name="sala" class="form-control" value="<?php echo htmlspecialchars($clase['sala']); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">URL de la Imagen</label>
                        <input type="text" name="imagen" class="form-control" value="<?php echo $clase['imagen']; ?>">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="actualizar" class="btn btn-warning text-dark fw-bold">Guardar Cambios</button>
                        <a href="editarClases.php" class="btn btn-secondary">Cancelar y Volver a la Lista</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
else:
    $resultado = $db->query("SELECT * FROM clases");
?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Selecciona la Clase que quieres Editar</h2>
        <div class="row">
            <?php while ($fila = $resultado->fetchArray(SQLITE3_ASSOC)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-warning">
                        <img src="<?php echo $fila['imagen']; ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="fw-bold"><?php echo htmlspecialchars($fila['nombre']); ?></h5>
                            <p class="text-muted mb-1"><?php echo $fila['dia_semana']; ?></p>
                            <p class="small text-secondary"><?php echo $fila['hora_inicio']; ?> - <?php echo $fila['hora_fin']; ?></p>
                            <a href="editarClases.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning w-100 text-dark">Editar Datos</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="text-center mt-3 mb-5">
            <a href="perfil.php" class="btn btn-outline-secondary">Volver al Panel</a>
        </div>
    </div>

<?php
endif;
include '../includes/footer.php';
?>