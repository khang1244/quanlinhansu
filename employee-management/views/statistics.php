<?php
include '../includes/auth.php';
checkRole('admin');
include '../includes/header.php';
include '../includes/db.php';

// Lấy thống kê từ cơ sở dữ liệu
$stmt = $pdo->query("SELECT type, COUNT(*) as count FROM employees GROUP BY type");
$statistics = $stmt->fetchAll();

$totalEmployees = array_sum(array_column($statistics, 'count'));

// Tính phần trăm
foreach ($statistics as &$stat) {
    $stat['percentage'] = round(($stat['count'] / $totalEmployees) * 100, 2);
}
unset($stat); // Xóa tham chiếu
?>

<div class="container mt-5">
    <h2 class="text-center">Thống kê nhân viên</h2>
    <div class="row">
        <div class="col-md-6">
            <canvas id="employeeChart"></canvas>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Loại nhân viên</th>
                        <th>Số lượng</th>
                        <th>Phần trăm (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($statistics as $stat): ?>
                        <tr>
                            <td><?= htmlspecialchars($stat['type']) ?></td>
                            <td><?= $stat['count'] ?></td>
                            <td><?= $stat['percentage'] ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Lấy dữ liệu từ PHP
const labels = <?= json_encode(array_column($statistics, 'type')) ?>;
const data = <?= json_encode(array_column($statistics, 'count')) ?>;
const percentages = <?= json_encode(array_column($statistics, 'percentage')) ?>;

// Cấu hình biểu đồ
const ctx = document.getElementById('employeeChart').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: labels,
        datasets: [{
            label: 'Thống kê nhân viên',
            data: data,
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return `${labels[tooltipItem.dataIndex]}: ${percentages[tooltipItem.dataIndex]}%`;
                    }
                }
            }
        }
    }
});
</script>

<?php include '../includes/footer.php'; ?>
