<?php IO::console_log('running Redirector...');
/**
 * @author Ingo Andelhofs
 * 
 * Redirector class
 * Redirect to a given url
 * Redirect back to the previous url
 * 
 */

 
class Redirect {
  public static function to($route) { header("Location: $route"); }
  public static function back() { self::to($_SERVER['HTTP_REFERER']); }
}