<?php
// Database Configuration for MySQL Workbench
define('DB_SERVER', '127.0.0.1'); // using a local ip instead of localhost makes workbench connect faster
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root123'); //workbench password
define('DB_NAME', 'sharesphere_db');
define('DB_PORT', 3306); //default port number of MySQL Workbench 
// Connect to MySQL Database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

// Check Connection
if($conn === false){
    die("ERROR: Could not connect to Workbench. " . mysqli_connect_error());
}
?>