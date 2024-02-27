<?php 

use cgc\Tbk;
use cgc\Err;
use cgc\enums\Method;

$method = $_SERVER['REQUEST_METHOD']??null;

if($method!==Method::GET){
  Err::method_not_allowed();
}

$host = getenv('HOST');
$token = $_GET['token_ws']??null;

if($token===null){}
  Err::bad_request('token_ws is required');
}

$tbk = new Tbk();

$result = $tbk->confirm_transaction($token);

if($result==null){}
  Err::internal_error();
}

header('Content-Type: text/html; charset=utf-8');

if($result['status']==='AUTHORIZED'){
  require_once __DIR__.'/../views/success.php';
}else {
  require_once __DIR__.'/../views/failed.php';
}

