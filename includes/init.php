<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 5:22 PM
 */

date_default_timezone_set('Asia/Kuala_Lumpur');


require_once('config.php');

define('ENVIRONMENT', isset($_CONFIG['ENVIRONMENT']) ? $_CONFIG['ENVIRONMENT'] : 'production');
switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;
    case 'testing':
        break;
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}


/********************** INITIALIZE PARSE ***************************************/


Parse\ParseClient::initialize( $_CONFIG['CONNECT']['APP_ID'], null, $_CONFIG['CONNECT']['MASTER_KEY'] );
Parse\ParseClient::setServerURL($_CONFIG['CONNECT']['HOST'],$_CONFIG['CONNECT']['MOUNT']);

$health = Parse\ParseClient::getServerHealth();
if($health['status'] === 200) {
    //print_r('healthy system');
} else {
    print_r('Failed to connect to API');
    print_r($health);
}


/********************** INITIALIZE PARSE DONE **********************************/


/********************** INITIALIZE CLASSES ***************************************/
require_once($_SERVER [ 'DOCUMENT_ROOT' ] .'/core/Database.php');
require_once($_SERVER [ 'DOCUMENT_ROOT' ].'/core/Security.php');
require_once($_SERVER [ 'DOCUMENT_ROOT' ].'/core/General.php');
require_once($_SERVER [ 'DOCUMENT_ROOT' ].'/core/Factory.php');

$__DB = new Database($_CONFIG['Database']);
$__DB->connect();
$__DB->select_db();

$__Sec 	= new Security($__DB);
$__GB 	= new General($__DB,$__Sec, $_CONFIG['CONSTANTS']);

// manufacture class instances
$__CONNECT = Factory::Connect($__DB, $__GB, $__Sec);

$__Auth = Factory::Auth($__DB, $__GB, $__Sec);
$__CUSTOMER = Factory::Customer($__DB, $__GB, $__Sec);
$__SUPPLIER = Factory::Supplier($__DB, $__GB, $__Sec);
$__STORE = Factory::Store($__DB, $__GB, $__Sec);
$__STAFF = Factory::Staff($__DB, $__GB, $__Sec, $__CONNECT);
$__SALES = Factory::Sales($__DB, $__GB, $__Sec);
$__Online = Factory::TerminalOnline($__DB, $__GB, $__Sec);
$__Offline = Factory::TerminalOffline($__DB, $__GB, $__Sec);


/*********************** ACCEPT FORM POSTED DATA *********************************/
// handle json post data posted as a form ..
$json = file_get_contents('php://input');
if(empty($_POST)){
    $_POST = json_decode($json , true);
}
/*********************** ACCEPT FORM POSTED DATA DONE *****************************/


?>