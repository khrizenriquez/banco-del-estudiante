<?php
$page_title = "Agregar cuentas de terceros :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<section class="container is-max-tablet mt-6">
    <div class="container">
        <h1 class="title">Estado de Cuenta</h1>

        <!-- Información adicional del saldo total -->
        <div class="box">
            <h2 class="subtitle">Saldo Total</h2>
            <p>El saldo total disponible en tus cuentas es: <strong>$3,500.00</strong></p>
        </div>

        <table class="table is-fullwidth">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo de Transacción</th>
                <th>Monto</th>
                <th>Cuenta Origen/Destino</th>
            </tr>
            </thead>
            <tbody>
            <!-- Aquí los datos de las transacciones deben generarse dinámicamente -->
            <tr>
                <td>2024-09-23</td>
                <td>Depósito</td>
                <td>$500.00</td>
                <td>Cuenta Personal</td>
            </tr>
            <tr>
                <td>2024-09-22</td>
                <td>Transferencia</td>
                <td>$200.00</td>
                <td>Ahorros</td>
            </tr>
            <tr>
                <td>2024-09-21</td>
                <td>Retiro</td>
                <td>$50.00</td>
                <td>Cuenta Personal</td>
            </tr>
            </tbody>
        </table>
    </div>
</section>



<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>
