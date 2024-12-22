<?php
session_start();
include '../includes/auth.php';
include '../includes/header.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// Kiểm tra vai trò và hiển thị nội dung phù hợp
if (isAdmin()) {
    echo "<h2>Chào mừng Admin</h2>";
    echo "<a href='employees.php' class='btn btn-primary'>Quản lý nhân viên</a>";
    echo "<a href='statistics.php' class='btn btn-secondary'>Thống kê</a>";
} elseif (isUser()) {
    echo "<h2>Chào mừng User</h2>";
    echo "<a href='search.php' class='btn btn-primary'>Tìm kiếm nhân viên</a>";
} else {
    echo "<h2>Không xác định vai trò</h2>";
}

include '../includes/footer.php';

