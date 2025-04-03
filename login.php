<?php
session_start();
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
        <h1>Login</h1>
        <p class="intro-text">Access your account to manage applications and stay connected with our team.</p>
        
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="alert alert-error">
                <?php 
                    echo $_SESSION['login_error']; 
                    unset($_SESSION['login_error']);
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['login_message'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['login_message']; 
                    unset($_SESSION['login_message']);
                ?>
            </div>
        <?php endif; ?>

        <form id="login-form" action="process_login.php" method="post" class="auth-form">
            <div class="form-section">
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn-apply">Login</button>
                </div>
                
                <div class="auth-links">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </form>
    </div>

    <?php
    include 'footer.inc';
    ?>
</body>
</html>