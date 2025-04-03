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
    $email = sanitizeInput($conn, $_POST['email']);
    $password = sanitizeInput($conn, $_POST['password']); // Now we can sanitize the password
    
    // Check if user exists with matching password (plain text comparison)
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['role'] = $user['role'];
        
        // Redirect based on role
        if ($user['role'] === 'HR') {
            header("Location: manage.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $_SESSION['login_error'] = "Invalid email or password";
    }
    
    $conn->close();
    header("Location: login.php");
    exit;
}
?>