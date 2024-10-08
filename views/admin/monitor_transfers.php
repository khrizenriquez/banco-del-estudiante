<?php
$page_title = "Monitor de transferencias :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
require_once './views/common/logged-menu.php';
?>

<section class="container is-max-tablet mt-6">
    <h1 class="title">Monitor de Transferencias</h1>

    <div class="box">
        <h2 class="subtitle">Estadísticas Diarias</h2>
        <p>Cantidad de cuentas creadas hoy: <b><?= $accountsCreatedToday; ?></b></p>
        <p>Cantidad de usuarios cliente registrados hoy: <b><?= $customersRegisteredToday; ?></b></p>
        <p>Cantidad de transacciones hoy: <b><?= $transactionsToday; ?></b></p>
        <p>Cantidad de depósitos hoy: <b><?= $depositsToday; ?></b></p>
        <p>Cantidad de retiros hoy: <b><?= $withdrawalsToday; ?></b></p>
    </div>

    <div class="box">
        <h2 class="subtitle">Estadísticas Mensuales</h2>
        <p>Cantidad de cuentas creadas del mes: <b><?= $accountsCreatedThisMonth; ?></b></p>
        <p>Cantidad de usuarios cliente registrados del mes: <b><?= $customersRegisteredThisMonth; ?></b></p>
        <p>Cantidad de transacciones del mes: <b><?= $transactionsThisMonth; ?></b></p>
        <p>Cantidad de depósitos del mes: <b><?= $depositsThisMonth; ?></b></p>
        <p>Cantidad de retiros del mes: <b><?= $withdrawalsThisMonth; ?></b></p>
    </div>

    <div class="box">
        <h2 class="subtitle">Depósitos vs Retiros</h2>
        <div class="chart-container">
            <canvas id="depositsVsWithdrawalsChart"></canvas>
        </div>
        <script>
            const ctx1 = document.getElementById('depositsVsWithdrawalsChart').getContext('2d');
            const depositsVsWithdrawalsChart = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: ['Depósitos', 'Retiros'],
                    datasets: [{
                        data: [15000, 8000], // Datos temporales
                        backgroundColor: ['#4CAF50', '#FF0000'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>
    </div>

    <div class="box">
        <h2 class="subtitle">Ubicaciones de Conexiones (Último Mes)</h2>
        <div class="chart-container">
            <canvas id="locationsChart"></canvas>
        </div>
        <script>
            const ctx2 = document.getElementById('locationsChart').getContext('2d');
            const locationsChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['Guatemala', 'México', 'El Salvador', 'Honduras'],
                    datasets: [{
                        data: [45, 25, 15, 15], // Datos temporales
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>
    </div>

    <div class="box">
        <h2 class="subtitle">Navegadores Utilizados (Último Mes)</h2>
        <div class="chart-container">
            <canvas id="browsersChart"></canvas>
        </div>
        <script>
            const ctx3 = document.getElementById('browsersChart').getContext('2d');
            const browsersChart = new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: ['Chrome', 'Firefox', 'Safari', 'Edge'],
                    datasets: [{
                        data: [60, 25, 10, 5], // Datos temporales
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>
    </div>

    <div class="box">
        <h2 class="subtitle">Usuarios Activos (Clientes, Cajeros, Administradores)</h2>
        <div class="chart-container">
            <canvas id="activeUsersChart"></canvas>
        </div>
        <script>
            const ctx4 = document.getElementById('activeUsersChart').getContext('2d');
            const activeUsersChart = new Chart(ctx4, {
                type: 'pie',
                data: {
                    labels: ['Clientes', 'Cajeros', 'Administradores'],
                    datasets: [{
                        data: [70, 20, 10], // Datos temporales
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>
    </div>
</section>

<?php
require_once './views/common/logged-scripts.php';
?>

</body>
</html>
