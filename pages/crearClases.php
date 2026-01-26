<?php
session_start();
include '../includes/db_conexion.php';
include '../includes/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("<div class='container mt-5'><div class='alert alert-danger'>Acceso denegado.</div></div>");
}

if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $dia = $_POST['dia_semana'];
    $inicio = $_POST['hora_inicio'];
    $fin = $_POST['hora_fin'];
    $sala = $_POST['sala'];
    $imagen = $_POST['imagen'];
    $aforo = $_POST['aforo_maximo'];

    $sql = "INSERT INTO clases (nombre, descripcion, dia_semana, hora_inicio, hora_fin, sala, aforo_maximo, imagen) 
            VALUES ('$nombre', '$descripcion', '$dia', '$inicio', '$fin', '$sala', $aforo, '$imagen')";

    if ($db->exec($sql)) {
        echo "<div class='alert alert-success text-center mt-3'>Nueva clase creada con exito</div>";
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Error al crear la clase</div>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-success">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Añadir Nueva Actividad</h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="crearClases.php">

                        <div class="mb-3">
                            <label class="form-label">Nombre de la clase</label>
                            <input type="text" name="nombre" class="form-control" placeholder="ejemplo kickbox" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripcion</label>
                            <textarea name="descripcion" class="form-control" rows="2" placeholder="detalle de la actividad"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dia de la semana</label>
                                <select name="dia_semana" class="form-select">
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miercoles">Miercoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                    <option value="Sabado">Sabado</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Aforo Maximo</label>
                                <input type="number" name="aforo_maximo" class="form-control" value="20">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hora Inicio</label>
                                <input type="time" name="hora_inicio" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hora Fin</label>
                                <input type="time" name="hora_fin" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sala</label>
                            <input type="text" name="sala" class="form-control" placeholder="Ej: Sala Fitness">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">URL de la Imagen</label>
                            <input type="text" name="imagen" class="form-control" placeholder="Pega el enlace de la imagen aqui">
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="guardar" class="btn btn-success fw-bold">Guardar Nueva Clase</button>
                            <a href="perfil.php" class="btn btn-secondary">Cancelar y Volver al Panel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>