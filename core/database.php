<?php
/**
 * Sets the connection variables.
 */
if(ENVIRONMENT === 'DEV') {
  /**
   * Database's connection data for development environment
   */
  $db_name = 'dbname'; // Database's name
  $db_servername = "localhost"; // Database's server (default: localhost)
  $db_username = "dbuser"; // Database's user
  $db_password = "dbpassword"; // Database's user's password
} else if (ENVIRONMENT === 'LIVE') {
  /**
   * Database's connection data for live environment
   */
  $db_name = 'dbname'; // Database's name
  $db_servername = "localhost"; // Database's server (default: localhost)
  $db_username = "dbuser"; // Database's user
  $db_password = "dbpassword"; // Database's user's password
}

/**
 * Connects to the database.
 */
try {
  $db_connection = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
  // set the PDO error mode to exception
  $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
}
