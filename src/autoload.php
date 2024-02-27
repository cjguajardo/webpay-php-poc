<?php

spl_autoload_register(function ($class) {
  $class = str_replace('\\', '/', $class);
  require_once __DIR__ . "/$class.php";
});

// register error error_handler
set_error_handler(function ($message, $code, $err_number, $err_file, $line) {
  if (headers_sent() === false) {
    header('Content-Type: application/json');
  }
  echo json_encode([
    'error' => [
      'message' => $message,
      'code' => $code,
      'error_number' => $err_number,
      'file' => $err_file,
      'line' => $line
    ]
  ]);
});
