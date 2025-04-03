<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$isHR = $isLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === 'HR';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>W.O.R.K_Shop</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<header class="site-header">
    <div class="header-container">
        <div class="logo-container">
            <a href="index.php">
                <img src="styles/images/logo.png" alt="Logo" class="header-logo">
                <span class="site-title">W.O.R.K_Shop</span>
            </a>
        </div>
        <nav class="main-nav">
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <label for="nav-toggle" class="nav-toggle-label">
                <span></span>
            </label>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="apply.php">Apply</a></li>
                <li><a href="phpenhancements.php">Enhancements</a></li>
                
                <?php if ($isLoggedIn): ?>
                    <?php if ($isHR): ?>
                        <li><a href="manage.php">Management</a></li>
                    <?php endif; ?>
                    <li><a href="account.php">Account</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>