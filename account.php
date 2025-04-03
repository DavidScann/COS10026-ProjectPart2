<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'header.inc';
    ?>
</head>

<body>
    <div class="container">
        <h1>Your Account</h1>
        <p class="intro-text">Welcome, <?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?>!</p>
        
        <div class="form-section">
            <h2>Account Information</h2>
            <div class="account-details">
                <div class="detail-row">
                    <div class="detail-label">Name:</div>
                    <div class="detail-value"><?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value"><?php echo htmlspecialchars($_SESSION['email']); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Account Type:</div>
                    <div class="detail-value"><?php echo htmlspecialchars($_SESSION['role']); ?></div>
                </div>
            </div>
            
            <div class="account-actions">
                <a href="logout.php" class="btn-logout-account">Logout</a>
            </div>
        </div>
    </div>

    <?php
    include 'footer.inc';
    ?>
</body>
</html>