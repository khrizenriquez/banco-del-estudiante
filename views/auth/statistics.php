<?php
$page_title = "Banco del estudiante :: Administración, Mantenimiento y Soporte de Servidor Web";
require_once './views/common/logged-header.php';
?>
<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<h1>Estadísticas del Servidor Web</h1>

<div class="box">
    <h2 class="subtitle">Solicitudes por Código de Estado</h2>
    <canvas id="statusCodesChart"></canvas>
</div>

<div class="box">
    <h2 class="subtitle">Páginas Más Visitadas</h2>
    <ul>
        <?php foreach ($mostVisitedPages as $page => $count): ?>
            <li>Página: <?= htmlspecialchars($page); ?> - Visitas: <?= $count; ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de código de estado
    const ctx = document.getElementById('statusCodesChart').getContext('2d');
    const statusCodesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['200 OK', '404 Not Found', '500 Server Error'],
            datasets: [{
                label: 'Solicitudes por Código de Estado',
                data: [<?= $status200Count; ?>, <?= $status404Count; ?>, <?= $status500Count; ?>],
                backgroundColor: ['#4CAF50', '#FFCE56', '#FF0000'],
            }]
        }
    });
</script>

<?php
require_once './views/common/logged-scripts.php';
?>

</body>
</html>
