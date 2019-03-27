<?php IO::console_log("running Validator...");
/**
 * @author Ingo Andelhofs
 * 
 * Validate $_POST variables based on config
 */


class Validator {
  private static $config = VALIDATE_CONF;
  private static $errors = [];
  
  public static function getErrors() { 
    return self::$errors; 
  }
  public static function newError($error_name = "") { 
    self::$errors[] = $error_name;
  }
  public static function hasErrors() {
    return self::$errors !== [];
  }

  
  /**
   * Validate all post variables based on the config
   */
  public static function validate($input_fields = []) {
    self::$errors = [];
    
    // foreach ($_POST as $name => $value) { $_POST[$name] = htmlspecialchars($value); } // ALTERNATIVE
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    foreach ($input_fields as $field)
      if (!isset($_POST[$field])) return ["Don't remove html attributes ..."];

    if (isset($_POST['password']) && isset($_POST['password2']) && $_POST['password'] !== $_POST['password2'])
      self::$errors[] = "Passwords do not match.";

    foreach ($_POST as $key => $value) {
      if ($key === 'password2') continue;

      $conf = isset(self::$config[$key]) ? (self::$config[$key]) : (self::$config['default']);
      self::validateOne($key, $value, ...$conf);
    }

    return self::$errors;
  }


  /**
   * Validates only a single input field
   */
  private static function validateOne($name, $input, $min_len, $max_len, $valid_chars = null, $pattern = null) {
    $name = ucfirst($name);
    
    if (!self::validateMin($input, $min_len)) {
      self::$errors[] = empty($input) ? "$name is required." : "$name must be at least $min_len characters long.";
    }

    if (!self::validateMax($input, $max_len)) {
      self::$errors[] = "$name must be at most $max_len characters long.";
    }

    if (self::$errors) {
      $_POST[$name] = '';
      return;
    }
    
    if (!self::validateChars($input, $valid_chars)) {
      self::$errors[] = "$name contains unvalid characters.";
    }

    // if (!self::validatePattern($input, $pattern)) {
    //   self::$errors[] = "$name is invalid.";
    // }

    if (self::$errors) $_POST[$name] = '';
  } 

  private static function validateMin($value, $min) {
    if (is_null($min)) return true;
    return strlen($value) > $min;
  }

  private static function validateMax($value, $max) {
    if (is_null($max)) return true;
    return strlen($value) < $max;
  }

  private static function validateChars($value, $chars) {
    if (is_null($chars) || empty($value)) return true;
    
    foreach (str_split($value) as $letter) if (strpos($chars, $letter) === false) return false;
    return true;
  }

  private static function validatePattern($value, $pattern) {
    if (is_null($pattern)) return true;
    return preg_match($pattern, $value);
  }
}