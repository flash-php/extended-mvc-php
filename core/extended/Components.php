<?php IO::console_log('running Components...');
/**
 * Components class
 * Render components
 * 
 * TODO:
 * Give default values 
 * Conditionals
 */

 
class Component {
  private static $path = 'app/components/';

  /**
   * Render components 
   * @param comp_name   The name of the component you want to render
   * @param data        The data that you want to render the component with
   */
  public static function render($comp_name, $data = []) {
    // Check if the component exists
    if (file_exists(self::$path . "$comp_name.php")) {
      $component = file_get_contents(self::$path . "/$comp_name.php");
      
      // Replace all {{_data_}} with data
      foreach ($data as $key => $value) {
        if (is_string($value))
          $component = str_replace("{{{$key}}}", $value, $component);
      }
      
      echo $component;
    }    
  }
}