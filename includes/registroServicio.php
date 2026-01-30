<?php
session_start();
include '../includes/db_conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = $_POST['rol']; 

    if (!empty($nombre) && !empty($email) && !empty($password)) {

        $check = $db->prepare("SELECT COUNT(*) as total FROM usuarios WHERE email = :em");
        $check->bindValue(':em', $email, SQLITE3_TEXT);
        $res = $check->execute();
        $fila = $res->fetchArray(SQLITE3_ASSOC);

        if ($fila['total'] > 0) {
            header("Location: registro.php?error=existente");
            exit();
        } else {
            $passHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nom, :em, :pass, :rol)");
            $stmt->bindValue(':nom', $nombre, SQLITE3_TEXT);
            $stmt->bindValue(':em', $email, SQLITE3_TEXT);
            $stmt->bindValue(':pass', $passHash, SQLITE3_TEXT);
            $stmt->bindValue(':rol', $rol, SQLITE3_TEXT);

            if ($stmt->execute()) {
                header("Location: login.php?registro=exito");
                exit();
            } else {
                header("Location: registro.php?error=db");
                exit();
            }
        }
    } else {
        header("Location: registro.php?error=vacio");
        exit();
    }
} else {
    header("Location: registro.php");
    exit();
}
