<?php
require_once 'settings.php';
session_start();

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectDB();
    
    if (!$conn) {
        echo "Database connection error. Please try again later.";
        exit;
    }
    
    // Sanitize inputs
    $firstname = sanitizeInput($conn, $_POST['firstname']);
    $lastname = sanitizeInput($conn, $_POST['lastname']);
    $email = sanitizeInput($conn, $_POST['email']);
    $password = sanitizeInput($conn, $_POST['password']); // Store plain text
    
    // Check if email already exists
    $checkSql = "SELECT * FROM users WHERE email = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['register_error'] = "Email already exists. Please use a different email or login.";
        header("Location: register.php");
        exit;
    }
    
    // Insert the new user with plain text password
    $sql = "INSERT INTO users (email, password, first_name, last_name, role) VALUES (?, ?, ?, ?, 'user')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $password, $firstname, $lastname);
    
    if ($stmt->execute()) {
        // Set success message
        $_SESSION['login_message'] = "Registration successful! Please login with your credentials.";
        header("Location: login.php");
    } else {
        $_SESSION['register_error'] = "Error: " . $stmt->error;
        header("Location: register.php");
    }
    
    $conn->close();
    exit;
}
?>