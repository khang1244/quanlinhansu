<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkRole($role) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] != $role) {
        header('Location: ../login.php');
        exit;
    }
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isUser() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'user';
}
?>
