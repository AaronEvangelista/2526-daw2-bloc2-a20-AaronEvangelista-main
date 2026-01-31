<?php
session_start();
include '../includes/db_conexion.php';
include '../includes/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("<script>window.location.href='../index.php';</script>");
}

$mensaje = "";

if (isset($_GET['borrar'])) {
    $id_borrar = $_GET['borrar'];

    if ($id_borrar == $_SESSION['id']) {
        $mensaje = "<div class='alert alert-danger'>No puedes eliminar tu propia cuenta</div>";
    } else {
        $db->exec("DELETE FROM usuarios WHERE id = $id_borrar");
        $mensaje = "<div class='alert alert-success'>Usuario eliminado correctamente.</div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $rol = $_POST['rol'];

    $check = $db->querySingle("SELECT id FROM usuarios WHERE email = '$email'");

    if ($check) {
        $mensaje = "<div class='alert alert-warning'>Error: Ese correo ya existe</div>";
    } else {
        $passHash = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nom, :em, :pass, :rol)");
        $stmt->bindValue(':nom', $nombre, SQLITE3_TEXT);
        $stmt->bindValue(':em', $email, SQLITE3_TEXT);
        $stmt->bindValue(':pass', $passHash, SQLITE3_TEXT);
        $stmt->bindValue(':rol', $rol, SQLITE3_TEXT);

        if ($stmt->execute()) {
            $mensaje = "<div class='alert alert-success'>Usuario <strong>$nombre</strong> creado como <strong>$rol</strong></div>";
        } else {
            $mensaje = "<div class='alert alert-danger'>Error al crear usuario.</div>";
        }
    }
}
?>

<div class="container mt-5 mb-5">
    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card bg-dark text-white shadow border-success" style="border-radius: 0;">
                <div class="card-header bg-success text-white text-center" style="border-radius: 0;">
                    <h4 style="font-family: 'Oswald', sans-serif; margin:0;">Crar usuarios </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="adminUsuarios.php">
                        <div class="mb-3">
                            <label>Nombre </label>
                            <input type="text" name="nombre" class="form-control" required placeholder="Ej: Pepe Entrenador">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="email@gym.com">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="******">
                        </div>
                        <div class="mb-3">
                            <label>Rol</label>
                            <select name="rol" class="form-select bg-secondary text-white">
                                <option value="basic">Cliente Basic</option>
                                <option value="premium">Cliente Premium</option>
                                <option value="profe">Profesor</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100 fw-bold">crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <?php echo $mensaje; ?>

            <div class="card bg-dark text-white shadow border-secondary" style="border-radius: 0;">
                <div class="card-header border-secondary">
                    <h3 style="font-family: 'Oswald', sans-serif; color: #00cfd1;">LISTADO DE USUARIOS</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0">
                        <thead>
                            <tr class="text-info">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $db->query("SELECT * FROM usuarios ORDER BY id DESC");
                            while ($row = $res->fetchArray(SQLITE3_ASSOC)):
                            ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <?php
                                        $color = 'secondary';
                                        if ($row['rol'] == 'admin') $color = 'danger';
                                        if ($row['rol'] == 'profe') $color = 'warning text-dark';
                                        if ($row['rol'] == 'premium') $color = 'info text-dark';
                                        ?>
                                        <span class="badge bg-<?php echo $color; ?>"><?php echo strtoupper($row['rol']); ?></span>
                                    </td>
                                    <td class="text-end">
                                        <?php if ($row['id'] != $_SESSION['id']): ?>
                                            <a href="adminUsuarios.php?borrar=<?php echo $row['id']; ?>"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Seguro que quieres eliminar a este usuario?');">
                                                Eliminar
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted small">Tu</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>