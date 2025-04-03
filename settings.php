<?php


// Defining constants
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');   
define('DB_PASSWORD', '');       
define('DB_NAME', 'workshop');  
define('DB_PORT', 3306);  
function sanitizeInput($conn, $data) {
    $data = trim($data);
    
    $data = stripslashes($data);
    
    $data = htmlspecialchars($data);
    
    if ($conn) {
        $data = $conn->real_escape_string($data);
    }
    
    return $data;
}

function connectDB() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
    
    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        return false;
    }
    
    // Almost forgot this
    $conn->set_charset("utf8mb4");
    
    return $conn;
}
?>