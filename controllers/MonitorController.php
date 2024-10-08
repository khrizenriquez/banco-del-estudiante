<?php
require_once 'session_check.php';
require_once 'models/MonitorModel.php';

class MonitorController {
    public function showMonitor() {
        $monitorModel = new MonitorModel();

        $accountsCreatedToday = $monitorModel->getAccountsCreatedToday();
        $customersRegisteredToday = $monitorModel->getCustomersRegisteredToday();
        $transactionsToday = $monitorModel->getTransactionsToday();
        $depositsToday = $monitorModel->getDepositsToday();
        $withdrawalsToday = $monitorModel->getWithdrawalsToday();

        $accountsCreatedThisMonth = $monitorModel->getAccountsCreatedThisMonth();
        $customersRegisteredThisMonth = $monitorModel->getCustomersRegisteredThisMonth();
        $transactionsThisMonth = $monitorModel->getTransactionsThisMonth();
        $depositsThisMonth = $monitorModel->getDepositsThisMonth();
        $withdrawalsThisMonth = $monitorModel->getWithdrawalsThisMonth();

        include 'views/admin/monitor_transfers.php';
    }
}


?>