<?php IO::console_log('running Authenticate...');
/**
 * @author Ingo Andelhofs
 * 
 * Create a user session
 * Check if the user is logged in
 * Log the user out
 * Check if the user is ('admin', 'organizer', ...)
 * 
 * Create a hashed password
 * Compare a hash with a plain password
 */

 
class Authenticate {
  // User login
  public static function createSession($user) {
    $_SESSION['user'] = [
      'id' => $user['id'],
      'firstname' => $user['firstname'],
      'lastname' => $user['lastname'],
      'email' => $user['email'],
      'type' => '' // $user['type']
    ];
  }

  public static function isUserLoggedIn() { return isset($_SESSION['user']); }

  public static function logUserOut() {
    unset($_SESSION['user']);
    session_destroy();
  }

  public static function isUser($type) {
    if (self::isUserLoggedIn()) return $_SESSION['user']['type'] === $type;
    return false;
  }


  // Password hashing
  public static function createHash(&$password) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    return $password;
  }

  public static function compareHash($password, $hashed_password) {
    return password_verify($password, $hashed_password);
  }

}