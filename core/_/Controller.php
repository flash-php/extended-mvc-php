<?php

class Controller {
  protected $header_template = 'header';
  protected $footer_template = 'footer';

  protected function model($model) {
    if (file_exists("app/models/$model.php")) {
      require_once "app/models/$model.php";
      return new $model;
    }
    return null;
  }
  
  protected function view($view, $data = []) {
    if (file_exists("app/views/$view.php")) {

      if (file_exists("app/components/$this->header_template.php")) include "app/components/$this->header_template.php";
      include "app/views/$view.php";
      if (file_exists("app/components/$this->footer_template.php")) include "app/components/$this->footer_template.php";

    }
    else {
      die("View '$view' does not exist.");
    }
  }
}