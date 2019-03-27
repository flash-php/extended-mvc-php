<?php

class Auth Extends Controller {
  public function __construct() {
    $this->userModel = $this->model('User');
  }

  /**
   * @route /home/index
   */
  public function index() {
    Redirect::to('/home/index');
  }


  /**
   * @route /auth/register
   */
  public function register_get() {
    $this->view('auth/register');
  }
  public function register_post() {
    Validator::validate(['firstname', 'lastname', 'email', 'password', 'password2']);
    $this->userModel->doesEmailExist($_POST['email'], Validator::getErrors());
    
    if (Validator::hasErrors()) { $this->view('auth/register', ['errors' => Validator::getErrors(), 'refresh' => []]); }
    else {
      Authenticate::createHash($_POST['password']);
      if ($this->userModel->register($_POST)) Redirect::to("/home/index");
      else die('Registration failed');
    }
  }
  
  
  /**
   * @route /auth/register
   */
  public function login_get() {
    $this->view('auth/login');
  }
  public function login_post() {
    $errors = Validator::validate();

    if ($errors) { $this->view('auth/login', ['errors' => $errors, 'refresh' => []]); }
    else {
      if ($user_data = $this->userModel->login($_POST['email'], $_POST['password'])) {
        Authenticate::createSession($user_data[0]);
      } else {
        $errors = ['Email or password are invalid.'];
        $this->view('auth/login', ['errors' => $errors, 'refresh' => []]);
      }
    }
  }

  /**
   * 
   */
  public function logout() {
    Authenticate::logUserOut();
    Redirect::to('/home/index');
  }
  
}