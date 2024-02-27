<?php 

use cgc\Tbk;
use cgc\Err;
use cgc\enums\Method;

$method = $_SERVER['REQUEST_METHOD']??null;

if($method!==Method::POST){
  Err::method_not_allowed();
}

$host = getenv('HOST');
// Params to pass to create_transaction
$return_url = $host.'/index.php?action=confirm';
// get POST data: amount, but_order, session_id
$amount = $_POST['amount'] ?? 0;
$buy_order = $_POST['buy_order'] ?? null;
$session_id = $_POST['session_id'] ?? null;

if($amount===0 || $buy_order===null || $buy_order==='' || $session_id===null || $session_id===''){
  $error=[];
  if($amount===0){
    $error[]='amount';
  }
  if($buy_order===null || $buy_order===''){
    $error[]='buy_order';
  }
  if($session_id===null || $session_id===''){
    $error[]='session_id';
  }

  Err::bad_request('Invalid parameters: '.implode(', ',$error));
}

$tbk = new Tbk();
$result = $tbk->create_transaction($amount, $buy_order, $session_id, $return_url);

if($result===null) {
  Err::internal_server_error();
}

echo json_encode($result);
