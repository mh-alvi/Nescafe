<?php
// starting session
session_start();
// create contants for store non repeating values
define('SITEURL', 'http://localhost/nescafe/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'nescafe_db');
// Execute query to save data in database
$conn = new mysqli(LOCALHOST, 'root', '') or die(mysqli_error($conn)); // Database connection
$db_select = mysqli_select_db($conn, 'nescafe_db') or die(mysqli_error($conn)); // Selecting database
