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
        <h1>Create an Account</h1>
        <p class="intro-text">Looking to create a W.O.R.K_Shop account?</p>
        
        <?php if (isset($_SESSION['register_error'])): ?>
            <div class="alert alert-error">
                <?php 
                    echo $_SESSION['register_error']; 
                    unset($_SESSION['register_error']);
                ?>
            </div>
        <?php endif; ?>

        <form id="register-form" action="process_register.php" method="post" class="auth-form">
            <div class="form-section">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" pattern="[A-Za-z]{1,20}" maxlength="20" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" pattern="[A-Za-z]{1,20}" maxlength="20" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" 
                           minlength="8" required>
                    <span class="form-hint">Minimum 8 characters</span>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" 
                           minlength="8" required>
                </div>
            
                <div class="form-actions">
                    <button type="submit" class="btn-apply">Create Account</button>
                </div>
                
                <div class="auth-links">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </form>
    </div>

    <?php
    include 'footer.inc';
    ?>
    
    <script>
        // Validate password match
        document.getElementById('register-form').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>