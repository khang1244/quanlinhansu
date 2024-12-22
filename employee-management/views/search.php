<?php
include '../includes/auth.php';
checkRole('user'); // Hoặc 'admin', tùy thuộc vào role
include '../includes/header.php';
include '../includes/db.php';

// Lấy từ khóa tìm kiếm
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Truy vấn dữ liệu
if ($keyword) {
    $stmt = $pdo->prepare("SELECT id, name, gender, address, cccd, position, department, type FROM employees WHERE name LIKE :keyword OR position LIKE :keyword OR department LIKE :keyword");
    $stmt->execute([':keyword' => "%$keyword%"]);
} else {
    $stmt = $pdo->query("SELECT id, name, gender, address, cccd, position, department, type FROM employees");
}

$employees = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2>Quản lý nhân viên</h2>

    <!-- Form tìm kiếm -->
    <form method="GET" action="" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Nhập tên, vị trí hoặc phòng ban" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </div>
    </form>

    <!-- Bảng kết quả tìm kiếm -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giới tính</th>
                <th>Địa chỉ</th>
                <th>CCCD</th>
                <th>Vị trí</th>
                <th>Phòng ban</th>
                <th>Loại</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($employees): ?>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?= $employee['id'] ?></td>
                        <td><?= $employee['name'] ?></td>
                        <td><?= $employee['gender'] ?></td>
                        <td><?= $employee['address'] ?></td>
                        <td><?= $employee['cccd'] ?></td>
                        <td><?= $employee['position'] ?></td>
                        <td><?= $employee['department'] ?></td>
                        <td><?= $employee['type'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Không tìm thấy kết quả nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
