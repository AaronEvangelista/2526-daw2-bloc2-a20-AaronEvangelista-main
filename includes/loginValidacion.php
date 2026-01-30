<?php
session_start();
include '../includes/db_conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {

        $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :em");
        $stmt->bindValue(':em', $email, SQLITE3_TEXT);
        $resultado = $stmt->execute();
        $usuario = $resultado->fetchArray(SQLITE3_ASSOC);

        if ($usuario) {

            if (password_verify($password, $usuario['password'])) {

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['rol'] = $usuario['rol'];

                header("Location: ../index.php");
                exit();
            } else {

                header("Location: login.php?error=credenciales");
                exit();
            }
        } else {

            header("Location: login.php?error=noexiste");
            exit();
        }
    } else {
        header("Location: login.php?error=vacio");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
