<?php
$page_title = "Gestionar cuentas :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">
<?php require_once './views/common/logged-menu.php'; ?>

<section class="container is-max-tablet mt-6">
    <h1 class="title">Cuentas de Usuario</h1>

    <div class="box">
        <h2 class="subtitle">Cuentas Personales</h2>
        <?php if (!empty($user_accounts)): ?>
            <table class="table is-fullwidth">
                <thead>
                <tr>
                    <th>Número de Cuenta</th>
                    <th>Nombre de la Cuenta</th>
                    <th>Saldo</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($user_accounts as $account): ?>
                    <tr>
                        <td><?= isset($account['account_number']) ? htmlspecialchars($account['account_number'], ENT_QUOTES, 'UTF-8') : 'No definido'; ?></td>
                        <td><?= isset($account['account_name']) ? htmlspecialchars($account['account_name'], ENT_QUOTES, 'UTF-8') : 'Sin nombre'; ?></td>
                        <td>Q<?= isset($account['balance']) ? number_format($account['balance'], 2) : '0.00'; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tienes cuentas personales.</p>
        <?php endif; ?>
    </div>

    <div class="box">
        <h2 class="subtitle">Cuentas de Terceros</h2>
        <?php if (!empty($third_party_accounts)): ?>
            <table class="table is-fullwidth">
                <thead>
                <tr>
                    <th>Número de Cuenta</th>
                    <th>Alias</th>
                    <th>Monto Máximo</th>
                    <th>Transacciones Diarias Permitidas</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($third_party_accounts as $third_party_account): ?>
                    <tr>
                        <td><?= isset($third_party_account['account_number']) ? htmlspecialchars($third_party_account['account_number'], ENT_QUOTES, 'UTF-8') : 'No definido'; ?></td>
                        <td><?= isset($third_party_account['alias']) ? htmlspecialchars($third_party_account['alias'], ENT_QUOTES, 'UTF-8') : 'Sin alias'; ?></td>
                        <td>Q<?= isset($third_party_account['max_amount']) ? number_format($third_party_account['max_amount'], 2) : '0.00'; ?></td>
                        <td><?= isset($third_party_account['daily_transaction_limit']) ? htmlspecialchars($third_party_account['daily_transaction_limit'], ENT_QUOTES, 'UTF-8') : 'No definido'; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tienes cuentas de terceros agregadas.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once './views/common/logged-scripts.php'; ?>
</body>
</html>
