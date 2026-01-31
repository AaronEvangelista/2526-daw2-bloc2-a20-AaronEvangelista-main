<?php
session_start();
include '../includes/db_conexion.php';

// 1. Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_reserva = $_GET['id'];
    $id_usuario = $_SESSION['id'];

    $stmt = $db->prepare("DELETE FROM reservas WHERE id = :id_reserva AND id_usuario = :id_usuario");
    $stmt->bindValue(':id_reserva', $id_reserva, SQLITE3_INTEGER);
    $stmt->bindValue(':id_usuario', $id_usuario, SQLITE3_INTEGER);

    $stmt->execute();
}

header("Location: ../pages/perfil.php");
exit();
