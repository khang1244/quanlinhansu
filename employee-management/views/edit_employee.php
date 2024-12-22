<?php
include '../includes/auth.php';
checkRole('admin');
include '../includes/header.php';
include '../includes/db.php';

if (!isset($_GET['id'])) {
    header('Location: employees.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT id, name, gender, address, cccd, position, department, type FROM employees WHERE id = :id");
$stmt->execute([':id' => $id]);
$employee = $stmt->fetch();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $cccd = $_POST['cccd'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $type = $_POST['type'];

    $stmt = $pdo->prepare("UPDATE employees SET name = ?, gender = ?, address = ?, cccd = ?, position = ?, department = ?, type = ? WHERE id = ?");
    $stmt->execute([$name, $gender, $address, $cccd, $position, $department, $type, $id]);

    header("Location: employees.php");
    exit;
}

?>

<div class="container mt-5">
    <h2>Sửa thông tin nhân viên</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Tên nhân viên</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $employee['name'] ?>" required>
        </div>
        <div class="mb-3">
        <div class="mb-3">
    <label for="gender" class="form-label">Giới tính</label>
    <select class="form-select" name="gender" id="gender" required>
        <option value="Nam" <?= $employee['gender'] === 'Nam' ? 'selected' : '' ?>>Nam</option>
        <option value="Nữ" <?= $employee['gender'] === 'Nữ' ? 'selected' : '' ?>>Nữ</option>
        <option value="Khác" <?= $employee['gender'] === 'Khác' ? 'selected' : '' ?>>Khác</option>
    </select>
</div>
<div class="mb-3">
    <label for="address" class="form-label">Địa chỉ</label>
    <textarea class="form-control" name="address" id="address" required><?= $employee['address'] ?></textarea>
</div>
<div class="mb-3">
    <label for="cccd" class="form-label">CCCD</label>
    <input type="text" class="form-control" name="cccd" id="cccd" value="<?= $employee['cccd'] ?>" required>
</div>

        <div class="mb-3">
            <label for="position" class="form-label">Vị trí</label>
            <input type="text" class="form-control" id="position" name="position" value="<?= $employee['position'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Phòng ban</label>
            <input type="text" class="form-control" id="department" name="department" value="<?= $employee['department'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Loại nhân viên</label>
            <select class="form-select" id="type" name="type">
                <option value="full-time" <?= $employee['type'] === 'full-time' ? 'selected' : '' ?>>Toàn thời gian</option>
                <option value="part-time" <?= $employee['type'] === 'part-time' ? 'selected' : '' ?>>Bán thời gian</option>
                <option value="contract" <?= $employee['type'] === 'contract' ? 'selected' : '' ?>>Hợp đồng</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
