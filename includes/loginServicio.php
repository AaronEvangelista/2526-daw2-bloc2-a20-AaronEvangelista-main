<?php
session_start();
if (password_verify($password_escrita, $user['password'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['rol'] = $user['rol'];
    $_SESSION['nombre'] = $user['nombre'];
    header("Location: ../index.php");
}
