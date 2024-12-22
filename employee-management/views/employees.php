<?php
include '../includes/auth.php';
checkRole('admin');
include '../includes/header.php';
include '../includes/db.php';

// Lấy từ khóa tìm kiếm từ thanh tìm kiếm
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Nếu có từ khóa tìm kiếm, truy vấn sẽ lọc theo tên, vị trí hoặc phòng ban
if ($keyword) {
    $stmt = $pdo->prepare("SELECT id, name, position, department, type, gender, address, cccd 
                           FROM employees 
                           WHERE name LIKE :keyword 
                           OR position LIKE :keyword 
                           OR department LIKE :keyword");
    $stmt->execute([':keyword' => "%$keyword%"]);
} else {
    // Nếu không có từ khóa, hiển thị tất cả nhân viên
    $stmt = $pdo->query("SELECT id, name, position, department, type, gender, address, cccd FROM employees");
}

$employees = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2>Quản lý nhân viên</h2>

    <!-- Form tìm kiếm -->
    <form method="GET" action="" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Nhập tên, vị trí hoặc phòng ban" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </div>
    </form>

    <!-- Nút thêm nhân viên -->
    <a href="add_employee.php" class="btn btn-success mb-3">Thêm nhân viên</a>

    <!-- Bảng danh sách nhân viên -->
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
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($employees): ?>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?= htmlspecialchars($employee['id']) ?></td>
                        <td><?= htmlspecialchars($employee['name']) ?></td>
                        <td><?= htmlspecialchars($employee['gender']) ?></td>
                        <td><?= htmlspecialchars($employee['address']) ?></td>
                        <td><?= htmlspecialchars($employee['cccd']) ?></td>
                        <td><?= htmlspecialchars($employee['position']) ?></td>
                        <td><?= htmlspecialchars($employee['department']) ?></td>
                        <td><?= htmlspecialchars($employee['type']) ?></td>
                        <td>
                            <a href="edit_employee.php?id=<?= htmlspecialchars($employee['id']) ?>" class="btn btn-warning">Sửa</a>
                            <a href="delete_employee.php?id=<?= htmlspecialchars($employee['id']) ?>" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">Không tìm thấy kết quả nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
