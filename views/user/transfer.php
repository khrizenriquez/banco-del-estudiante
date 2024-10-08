<?php
$page_title = "Transferir a cuentas de terceros :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<section class="container is-max-tablet mt-6">
    <h1 class="title">Transferir a Cuenta de Terceros</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="notification is-danger">
            <?= htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['success']) && $_GET['success'] === 'transfer_completed'): ?>
        <div class="notification is-success">
            ¡La transferencia se ha completado exitosamente!
        </div>
    <?php endif; ?>

    <form action="<?= BASE_PATH; ?>/user/transferir-terceros" method="POST">
        <div class="field">
            <label class="label">Seleccionar Cuenta de Origen</label>
            <div class="control">
                <div class="select">
                    <select name="source_account_id" required>
                        <?php foreach ($user_accounts as $account): ?>
                            <option value="<?= htmlspecialchars($account['account_id'] ?? ''); ?>">
                                <?= htmlspecialchars($account['account_name'] ?? 'Sin alias'); ?> - <?= htmlspecialchars($account['account_number'] ?? 'Sin número'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label">Seleccionar Cuenta de Terceros</label>
            <div class="control">
                <div class="select">
                    <select name="third_party_account_id" required>
                        <?php foreach ($third_party_accounts as $account): ?>
                            <option value="<?= htmlspecialchars($account['third_party_id'] ?? ''); ?>">
                                <?= htmlspecialchars($account['alias'] ?? 'Sin alias'); ?> - <?= htmlspecialchars($account['account_number'] ?? 'Sin número'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label">Cantidad a Transferir</label>
            <div class="control">
                <input class="input" type="number" name="transfer_amount" placeholder="Ingrese la cantidad" step="0.01" required>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary" type="submit">Transferir</button>
            </div>
        </div>
    </form>

</section>

<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>
