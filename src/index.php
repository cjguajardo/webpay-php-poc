<?php

/**
 * Author: Carlos Guajardo C.
 * Email: cj.guajardo@cgcapps.cl
 * Web: https://cgcapps.cl
 *
 * https://[HOST]/index.php?action=[CREATE|CONFIRM]
 **/

require_once __DIR__ . '/autoload.php';

use cgc\Env;
use cgc\Err;

$action = $_GET['action'] ?? null;

Env::load(__DIR__ . '/.env');

$host = $_SERVER['HTTP_HOST'];
$protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
putenv("HOST=$protocol://$host");

if ($action != null) {
  $action = strtoupper($action);
}

switch ($action) {
  case 'CREATE': //POST
    require_once __DIR__ . '/actions/create_transaction.php';
    break;
  case 'CONFIRM': //GET
    require_once __DIR__ . '/actions/confirm_transaction.php';
    break;
  case 'INFO': //GET
    echo json_encode([
      // 'TBK_API_KEY_ID'=>Env::get('TBK_API_KEY_ID'),
      // 'TBK_API_KEY_SECRET'=>Env::get('TBK_API_KEY_SECRET'),
      'TBK_ENV' => Env::get('TBK_ENV'),
      'HOST' => $protocol . '://' . $host
    ]);
    break;
  default:
    Err::action_not_found();
    break;
}
