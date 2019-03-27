<?php IO::console_log('running Flash Messages...');
/**
 * @author Ingo Andelhofs
 * 
 * Display flash messages (only once) after a redirect
 * Create a flash message 
 * Display a flash message
 */


function flash($name, $message = '', $type = 'succes') {
  // Set flash message
  if (!empty($message) && empty($_SESSION[$name])) {
    $_SESSION[$name] = $message;
    $_SESSION["{$name}_type"] = $type;
  }
  // Display flash message
  else if (!empty($_SESSION[$name] && empty($message))) {
    Component::render('default/message', [
      'message' => $_SESSION[$name],
      'type' => $_SESSION["{$name}_type"]
    ]);
    
    unset($_SESSION[$name]);
    unset($_SESSION["{$name}_type"]);
  }
}