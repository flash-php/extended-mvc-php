<?php

class IO {
  public static function console_log($str) {
    echo "<script>";
    echo "console.log('$str')";
    echo "</script>";
  }

  public static function pre_print_r($var) {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
  }

}
