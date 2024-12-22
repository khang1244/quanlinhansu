<?php
include '../includes/auth.php';
checkRole('admin');
include '../includes/header.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $cccd = $_POST['cccd'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $type = $_POST['type'];

    $stmt = $pdo->prepare("INSERT INTO employees (name, gender, address, cccd, position, department, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $gender, $address, $cccd, $position, $department, $type]);

    header("Location: employees.php");
    exit;
}

?>

<div class="container mt-5">
    <h2>Thêm nhân viên</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Tên nhân viên</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
    <label for="gender" class="form-label">Giới tính</label>
    <select class="form-select" name="gender" id="gender" required>
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
        <option value="Khác">Khác</option>
    </select>
</div>
<div class="mb-3">
    <label for="address" class="form-label">Địa chỉ</label>
    <textarea class="form-control" name="address" id="address" required></textarea>
</div>
<div class="mb-3">
    <label for="cccd" class="form-label">CCCD</label>
    <input type="text" class="form-control" name="cccd" id="cccd" required>
</div>

        <div class="mb-3">
            <label for="position" class="form-label">Vị trí</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Phòng ban</label>
            <input type="text" class="form-control" id="department" name="department" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Loại nhân viên</label>
            <select class="form-select" id="type" name="type">
                <option value="full-time">Toàn thời gian</option>
                <option value="part-time">Bán thời gian</option>
                <option value="contract">Hợp đồng</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
