<?php
/**
 * @author Ingo Andelhofs
 * User model
 */

class User extends Database {

  /**
   * Register a user
   */
  public function register($data) {
    IO::console_log("Inserting user into database...");

    $query = "INSERT INTO users VALUES (DEFAULT, :firstname, :lastname, :email, :password)";
    return $this->run_query($query, [
      [':firstname', $data['firstname'], PDO::PARAM_STR],
      [':lastname', $data['lastname'], PDO::PARAM_STR],
      [':email', $data['email'], PDO::PARAM_STR],
      [':password', $data['password'], PDO::PARAM_STR]
    ]);
  }
  
  
  /**
   * Log a user in
   */
  public function login($email, $password) {
    IO::console_log("Logging user in...");
    $query = "SELECT * FROM users WHERE email = :email";
    $result = $this->run_query($query, [
      [':email', $email, PDO::PARAM_STR] 
    ]);

    if(Authenticate::compareHash($password, $result[0]['password']))
      return $result;
  }
  

  /**
   * Check if a email exists
   */
  public function doesEmailExist($email) {
    IO::console_log("Checking if email exists...");
    
    if (!Validator::hasErrors()) {
      $query = "SELECT * FROM users WHERE email = :email";
      if (!empty( $this->run_query($query, [[':email', $email, PDO::PARAM_STR]]) ))
        Validator::newError('Email does already exist');      
    }
  }
}