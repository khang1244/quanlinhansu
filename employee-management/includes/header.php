<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Quản lý nhân viên</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <?php if (isAdmin()): ?>
                        <li class="nav-item"><a class="nav-link" href="statistics.php">Thống kê</a></li>
                    <?php endif; ?>
                    <?php if (isUser()): ?>
                        <li class="nav-item"><a class="nav-link" href="search.php">Tìm kiếm</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link text-danger" href="../logout.php">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </nav>
