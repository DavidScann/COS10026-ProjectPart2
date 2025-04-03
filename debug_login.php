<?php
require_once 'settings.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Login Debugging Script</h2>";

// Test database connection
echo "<h3>1. Testing Database Connection</h3>";
$conn = connectDB();
if (!$conn) {
    die("Database connection failed. Check your settings.php file.");
} else {
    echo "✓ Database connection successful<br>";
}

// Test user query
echo "<h3>2. Testing User Query</h3>";
$email = 'admin@workshophr.com';
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "❌ No user found with email: $email<br>";
    echo "This means either:<br>
          1. The users table doesn't exist or<br>
          2. No user with this email exists in the table<br>";
    
    // Check if users table exists
    $tables_result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($tables_result->num_rows === 0) {
        echo "❌ The 'users' table does not exist in the database!<br>";
    } else {
        echo "✓ The 'users' table exists in the database<br>";
    }
} else {
    echo "✓ User found in database<br>";
    $user = $result->fetch_assoc();
    echo "User ID: " . $user['user_id'] . "<br>";
    echo "Role: " . $user['role'] . "<br>";
    
    // Test password verification
    echo "<h3>3. Testing Password Verification</h3>";
    $testPassword = 'admin123';
    if (password_verify($testPassword, $user['password'])) {
        echo "✓ Password verification successful<br>";
    } else {
        echo "❌ Password verification failed<br>";
        echo "Stored hash: " . $user['password'] . "<br>";
        echo "Expected hash for 'admin123': $2y$10$H9TfT5UUOgX.ZVx44VBIs.3vOy4xF7O4XMD4nNLWB7XmucE/LMgRa<br>";
    }
}

// Test session functionality
echo "<h3>4. Testing Session Functionality</h3>";
session_start();
$_SESSION['test'] = 'working';
if (isset($_SESSION['test']) && $_SESSION['test'] === 'working') {
    echo "✓ Session functionality is working<br>";
} else {
    echo "❌ Session functionality is not working<br>";
}

echo "<br><strong>Next Steps:</strong><br>";
echo "1. If any tests failed, fix those issues<br>";
echo "2. If all tests passed but login still fails, check the process_login.php file for errors<br>";
echo "3. Make sure the form action in login.php points to process_login.php<br>";
?>