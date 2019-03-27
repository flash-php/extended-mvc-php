<?php

/**
 * PDO Database class
 * Create database connections and autobinds data
 * Return datarows if the query is a SELECT query
 * ...
 */


class Database {
  private $host_name = DB_HOST;
  private $port = DB_PORT;
	private $db_name = DB_NAME;
	private $username = DB_USERNAME;
  private $password = DB_PASSWORD;

  private $db_handler;
  

  // Create a db connection
  protected function connect() {
    // dsn (data source name)
    $dsn = "pgsql:host={$this->host_name};port={$this->port};dbname={$this->db_name}";
    $options = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
      $this->db_handler = new PDO($dsn, $this->username, $this->password, $options);
      if ($this->db_handler) IO::console_log("Connecting to the database...");
    }
    catch(PDOException $error) { IO::console_log("Error: {$error->getMessage()}"); }
  }


  // Execute a query
  protected function run_query($query, $params = []) {
    $this->connect();
    
    if ($this->db_handler) {
      IO::console_log("Running query...");
      
      // Prepare and execute
      $this->db_handler = $this->db_handler->prepare( $query );
      foreach ($params as $param) $this->db_handler->bindParam(...$param);
      $this->db_handler->execute();
      
      // Return data if it is a SELECT statement
      return $this->db_handler->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
      IO::console_log('Error: Could not run query ...');
      return false;
    }
  }
}

