<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/18/18
 * Time: 10:44 AM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/api/init.php');

switch ($_GET['action_id']) {
    case 1000000: //reload :: update
        echo($__Online->terminalUpdate($__DB->escape_string($_GET['tmn_hw_id']), $__DB->escape_string($_GET['action_id'])));
        break;
    case 90108: //register fingerprint
        echo($__Offline->registerFingerPrint($_POST));
        break;
    case 90109: //signin
        echo($__Offline->fingerPrintLog($_POST));
        break;
    case 90110: // signout
        echo($__Offline->fingerPrintLog($_POST));
        break;
    case 90103: //cash sale
        echo($__Offline->processCashSale($_POST));
        break;
    case 90104: //customer sale
        echo($__Offline->processCustomerSale($_POST));
        break;
        case 90111: //check points
            echo($__Online->checkCustomerPoints($_POST));
            break;
    default:
        //http_response_code(404);
        die($__GB->terminalFormulateOutputString('4', 'ERROR', 'Invalid Action', '','', ''));
        break;
}

?>

