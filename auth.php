<?php

function requireBasicAuth() {
  $username = $_SERVER['PHP_AUTH_USER'];
  $password = $_SERVER['PHP_AUTH_PW'];

  if ($username !== getenv('BASIC_AUTH_USER') || $password !== getenv('BASIC_AUTH_PASSWORD')) {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Unauthorized';
    exit;
  }
}

?>
