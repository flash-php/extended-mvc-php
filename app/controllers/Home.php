<?php

class Home Extends Controller {  
  public function __construct() {
    // Global information here...
  }

  public function index() {
    $this->view('home/index', ['name' => "Welcome to the home page!"]);
  }
}