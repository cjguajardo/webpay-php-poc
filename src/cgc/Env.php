<?php

namespace cgc;

/** Reads .env file **/
class Env
{

  public static function load($path = './')
  {
    if (file_exists($path)) {
      $content = file_get_contents($path);
      $lines = explode("\n", $content);

      foreach ($lines as $line) {
        $line = trim($line);
        if ($line !== '' && stripos($line, '=') !== false) {
          putenv($line);
        }
      }
    } else {
      throw new \Exception('File not found: ' . $path);
    }
  }

  /**
   * Retrieves the value of the specified environment variable.
   *
   * @param string $key The name of the environment variable.
   * @return string|null The value of the environment variable, or null if it is not set.
   */
  public static function get($key)
  {
    $value = getenv($key);
    if ($value === false) {
      return null;
    }
    return $value;
  }
}
