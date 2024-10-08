<?php
$page_title = "Account Statement :: Bank of the Student";
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
            <p>El saldo total disponible en tus cuentas es: <strong>Q<?= number_format($total_balance, 2); ?></strong></p>
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
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?= htmlspecialchars($transaction['transaction_date']); ?></td>
                    <td><?= htmlspecialchars($transaction['transaction_type']); ?></td>
                    <td>Q<?= number_format($transaction['amount'], 2); ?></td>
                    <td>
                        De:
                        <?php
                        if ($transaction['source_account_type'] == 'third_party') {
                            echo "Cuenta de Terceros (" . @htmlspecialchars($transaction['source_account_number']) . ")";
                        } else {
                            echo "Cuenta Bancaria (" . @htmlspecialchars($transaction['source_account_number']) . ")";
                        }
                        ?>
                        <br />
                        a:
                        <?php
                        if ($transaction['destination_account_type'] == 'third_party') {
                            echo "Cuenta de Terceros (" . @htmlspecialchars($transaction['destination_account_number']) . ")";
                        } else {
                            echo "Cuenta Bancaria (" . @htmlspecialchars($transaction['destination_account_number']) . ")";
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>
