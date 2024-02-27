<?php

namespace cgc;

class Err
{
  private static function set_header()
  {
    if (headers_sent() === false) {
      header('Content-Type: application/json');
    }
  }
  public static function not_found()
  {
    self::set_header();
    header('HTTP/1.1 404 Not Found');
    echo '{"error":"Not Found"}';
    exit;
  }
  public static function action_not_found()
  {
    self::set_header();
    header('HTTP/1.1 404 Not Found');
    echo '{"error":"Action Not Found"}';
    exit;
  }
  public static function method_not_allowed()
  {
    self::set_header();
    header('HTTP/1.1 405 Method Not Allowed');
    echo '{"error":"Method Not Allowed"}';
    exit;
  }
  public static function bad_request($error)
  {
    self::set_header();
    header('HTTP/1.1 400 Bad Request');
    echo '{"error":"' . $error . '"}';
    exit;
  }
  public static function internal_server_error()
  {
    self::set_header();
    header('HTTP/1.1 500 Internal Server Error');
    echo '{"error":"Internal Server Error"}';
    exit;
  }
}
