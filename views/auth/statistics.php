<?php
$page_title = "Banco del estudiante :: Administración, Mantenimiento y Soporte de Servidor Web";
require_once './views/common/logged-header.php';
?>
<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<section class="container mt-6">
    <h1>Estadísticas del Servidor Web</h1>

    <div class="box">
        <h2 class="subtitle">Páginas Más Visitadas</h2>
        <ul>
            <?php foreach ($mostVisitedPages as $page => $count): ?>
                <li>Página: <?= htmlspecialchars($page); ?> - Visitas: <?= $count; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="box">
        <h2 class="subtitle">Solicitudes por Código de Estado (Hoy)</h2>
        <canvas id="statusCodesChartToday"></canvas>
    </div>

    <div class="box">
        <h2 class="subtitle">Solicitudes por Código de Estado (Últimos 7 días)</h2>
        <canvas id="statusCodesChartWeek"></canvas>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de código de estado para hoy
    const ctxToday = document.getElementById('statusCodesChartToday').getContext('2d');
    const statusCodesChartToday = new Chart(ctxToday, {
        type: 'bar',
        data: {
            labels: ['200 OK', '404 Not Found', '500 Server Error'],
            datasets: [{
                label: 'Solicitudes por Código de Estado (Hoy)',
                data: [<?= $status200TodayCount; ?>, <?= $status404TodayCount; ?>, <?= $status500TodayCount; ?>],
                backgroundColor: ['#4CAF50', '#FFCE56', '#FF0000'],
            }]
        }
    });

    // Gráfico de código de estado para la última semana
    const ctxWeek = document.getElementById('statusCodesChartWeek').getContext('2d');
    const statusCodesChartWeek = new Chart(ctxWeek, {
        type: 'bar',
        data: {
            labels: ['200 OK', '404 Not Found', '500 Server Error'],
            datasets: [{
                label: 'Solicitudes por Código de Estado (Últimos 7 días)',
                data: [<?= $status200WeekCount; ?>, <?= $status404WeekCount; ?>, <?= $status500WeekCount; ?>],
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
