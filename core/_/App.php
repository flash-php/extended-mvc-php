<?php

class App {
  // Default routes and params
  protected $controller = 'home';
  protected $method = 'index';
  protected $params = [];

  protected $path = 'app/controllers/';
  protected $request_method;


  /**
   * Constructor to initialize controllers and routing
   */
  public function __construct() {
    // Start a session
    session_start();

    $url = $this->parse_url();
    $this->request_method = strtolower($_SERVER['REQUEST_METHOD']);

    // Check if a controller exists and initiate 
    if (file_exists($this->get_full_path($url[0]))) {
      $this->controller = $url[0];
      unset($url[0]);
    }
    else {
      // Check if default controller exists
    }

    require_once $this->get_full_path($this->controller);
    $this->controller = new $this->controller;


    // Check if the methode exists with request type
    if (isset($url[1])) {
      if (method_exists($this->controller, $this->get_req_func($url[1])))
        $this->method = $this->get_req_func($url[1]);
      else if (method_exists($this->controller, $url[1]))
        $this->method = $url[1];

      unset($url[1]);
    }

    $this->params = $url ? array_values($url) : [];
    call_user_func_array([$this->controller, $this->method], $this->params);
  }



  /**
   * Parse url and put directory's in an url array
   */
  private function parse_url() {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);

      return $url;
    }
  }


  /**
   * Get full path to the controller, request function name
   */
  private function get_full_path($name) {
    return $this->path . $name . '.php';
  }

  private function get_req_func($name) {
    return $name . "_" . $this->request_method;
  }
}