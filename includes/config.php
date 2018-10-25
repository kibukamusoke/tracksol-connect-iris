<?php
session_start();
ob_start();

require_once($_SERVER['DOCUMENT_ROOT'] .'/libs/parse/autoload.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/index.php');
$site_url = 'http://mmpuchong.mobile-money.com.my:8041'; //'http://mmpuchong.mobile-money.com.my:8003';
$_CONFIG = array(
    'ENVIRONMENT' => 'development', /* development | production */
    'Database' => array( // mysql or postgre
        'DB_host' => '172.17.0.1',
        'DB_user' => 'root',
        'DB_pass' => 'Money123!@#',
        'DB_name' => 'Connect',
        'DB_prefix' => '',
        'DB_port' => 8040
    ),
    'X-Auth-Token' => md5('abc123!@#'),
    'CONSTANTS' => array(
        'slack_url' => 'https://hooks.slack.com/services/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'
    ),
    'CONNECT' => array(
        'APP_ID' => 'connect',
        'HOST' => 'http://mmpuchong.mobile-money.com.my:8011',
        'MASTER_KEY' => 'connect@#123',
        'MOUNT' => '/connect'
    )
);

?>