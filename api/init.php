<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/18/18
 * Time: 11:13 AM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/init.php');
//65af2bf5f5c7d6802d01bf967917e0cd
// authenticate ::
if(!isset($_SERVER['HTTP_X_AUTH_TOKEN']) || $_SERVER['HTTP_X_AUTH_TOKEN'] !== $_CONFIG['X-Auth-Token']) {
    http_response_code(401);
    die('Unauthorized');
}

?>