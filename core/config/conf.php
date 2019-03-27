<?php

  // Database information
  define('DB_HOST', 'localhost');
  define('DB_PORT', '[DB_PORT]');
  define('DB_NAME', '[DB_NAME]');
  define('DB_USERNAME', '[DB_USERNAME]');
  define('DB_PASSWORD', '[DB_PASSWORD]');

  
  // Validate Configuartion
  define('VALIDATE_CONF', [
    "firstname" => [1, 64],
    "lastname" => [1, 64],
    "password" => [6, 64],
    "email" => [1, 64, null, "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}]/"],
    "default" => [1, 128, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"]
    ]);
  
    
  // Path information
  // ...