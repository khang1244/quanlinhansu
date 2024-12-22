<?php
include '../includes/auth.php';
checkRole('admin');
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM employees WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: employees.php');
exit;
?>
