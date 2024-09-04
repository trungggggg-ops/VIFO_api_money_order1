<?php

use App\Services\VifoServiceFactory;

require 'vendor/autoload.php';
// II. Accounts and Authenticate 
$test = new VifoServiceFactory('dev');
echo 'Login <br/>';
$test->login('NEWSPACE_sale_demo', 'newspace@vifo123');
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';


// I. Prepare data
//1.Get List of available Banks:
echo 'Get List of available Banks <br/>';
$bank = $test->getHeaderBank();
$bank->getBank();
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
// 2.Get NAPAS Beneficiary Name:
echo 'Get NAPAS Beneficiary Name <br/>';
$bank->getBeneficiaryName();
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';


//III.Create Transfer Money API:
echo 'Create Transfer Money API <br/>';
$transfer = $test->getHeadereTransferMoney();
$data =  $transfer->createTransferMoney();
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';

//IV.Bulk Approve Transfer Money API 
echo 'Bulk Approve Transfer Money API <br/> ';
$test->login('NEWSPACE_admin_demo','newspace@vifo123');
if (isset($data)) {
    $app = $test->ApproveTransferMoney();
    $app->approveTransfers($data);
} else {
    echo "Error: Transfer data not found.";
}
// echo '<br/>';
// echo '<br/>';
// echo '<br/>';
// echo '<br/>';
// echo '<br/>';
// VI.Others request
echo '<Others request <br/>';
$otherRequest =  $test->OtherRequest();
$otherRequest->checkOrderStatus($data);

