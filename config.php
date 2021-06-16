<?php
//connect to the database
define('DB_SERVER', 'localhost');
define('DB_NAME', 'link');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '12345');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// checking the connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>