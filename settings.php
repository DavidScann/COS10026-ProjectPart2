<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');   
define('DB_PASSWORD', '');       
define('DB_NAME', 'workshop');  
define('DB_PORT', 3306);  
function sanitizeInput($conn, $data) {
    // Remove whitespace from beginning and end
    $data = trim($data);
    
    // Remove backslashes
    $data = stripslashes($data);
    
    // Convert special HTML characters to entities
    $data = htmlspecialchars($data);
    
    // Escape special characters in a string for use in an SQL statement
    if ($conn) {
        $data = $conn->real_escape_string($data);
    }
    
    return $data;
}

function connectDB() {
    // Create connection using MySQLi
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
    
    // Check connection
    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        return false;
    }
    
    // Set character set to UTF-8
    $conn->set_charset("utf8mb4");
    
    return $conn;
}
?>