<?php
session_start();
include '../includes/db_conexion.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../sessions/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_clase = $_GET['id'];
    $id_usuario = $_SESSION['id'];
    $rol_usuario = $_SESSION['rol'];

    $stmt_check = $db->prepare("SELECT id FROM reservas WHERE id_usuario = :user AND id_clase = :clase");
    $stmt_check->bindValue(':user', $id_usuario, SQLITE3_INTEGER);
    $stmt_check->bindValue(':clase', $id_clase, SQLITE3_INTEGER);
    $res_check = $stmt_check->execute();

    if ($res_check->fetchArray()) {
        echo "<script>alert('Ya tienes reservada esta clase.'); window.location.href='perfil.php';</script>";
        exit();
    }

    $stmt_info = $db->prepare("SELECT solo_premium FROM clases WHERE id = :id");
    $stmt_info->bindValue(':id', $id_clase, SQLITE3_INTEGER);
    $res_info = $stmt_info->execute();
    $clase_info = $res_info->fetchArray(SQLITE3_ASSOC);

    if ($clase_info) {
        if ($clase_info['solo_premium'] == 1 && $rol_usuario == 'basic') {
            echo "<script>alert('Error: Esta clase es exclusiva para usuarios Premium.'); window.location.href='verClases.php';</script>";
            exit();
        }

        $stmt_insert = $db->prepare("INSERT INTO reservas (id_usuario, id_clase, fecha_reserva) VALUES (:user, :clase, DATE('now'))");
        $stmt_insert->bindValue(':user', $id_usuario, SQLITE3_INTEGER);
        $stmt_insert->bindValue(':clase', $id_clase, SQLITE3_INTEGER);

        if ($stmt_insert->execute()) {
            header("Location: perfil.php");
            exit();
        } else {
            echo "<script>alert('Error al reservar.'); window.location.href='verClases.php';</script>";
        }
    } else {
        header("Location: verClases.php");
    }
} else {
    header("Location: verClases.php");
}
