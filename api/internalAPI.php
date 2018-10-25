<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/22/18
 * Time: 9:23 PM
 */


include_once($_SERVER['DOCUMENT_ROOT'] . '/api/init.php');

switch ($_GET['action']) {
    case 'deleteStock':
        $_POST['status'] = 0;
        echo($__STORE->updateStockItem($_POST));
        break;
    case 'deleteStore':
        $_POST['status'] = 0;
        echo($__STORE->updateStore($_POST));
        break;
    case 'deleteCategory':
        $_POST['status'] = 0;
        echo($__STORE->updateCategory($_POST));
        break;
    case 'deleteCustomer':
        $_POST['status'] = 0;
        echo($__CUSTOMER->updateCustomer($_POST));
        break;
    case 'deleteSupplier':
        $_POST['status'] = 0;
        echo($__SUPPLIER->updateSupplier($_POST));
        break;
    case 'deleteStaff':
        $_POST['status'] = 0;
        echo($__STAFF->updateStaff($_POST));
        break;
    case 'deletePaymentMode':
        $_POST['status'] = 0;
        echo($__SALES->updatePaymentMode($_POST));
        break;
    default:
        die('Unknown action');
        break;
}