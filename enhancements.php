<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'header.inc';
    ?>
    <title>Enhancements - W.O.R.K_Shop</title>
</head>

<body>
    <div class="container">
        <h1>Assignment Enhancements</h1>
        
        <section class="enhancement">
            <h2>User Login and Role-Based Access</h2>
            
            <div class="enhancement-details">
                <h3>What We Did</h3>
                <p>
                    We've created a login and registration system that gives different types of users different access to the website. 
                    Regular users can apply for jobs and check their application status, while HR users can access a special 
                    dashboard to manage all job applications.<br>
                    Unfortunately, at this time, passwords are still not hashed due to authentication issues, but the system works.
                </p>
                
                <h3>How It Works</h3>
                <ul>
                    <li><strong>Registration:</strong> New users can create an account with their email and password</li>
                    <li><strong>Different User Roles:</strong> The system knows if you're a regular user or an HR user</li>
                    <li><strong>Dashboard Control:</strong> Only HR users can access the management dashboard</li>
                    <li><strong>Personalized Experience:</strong> Regular users see their own applications and status</li>
                </ul>
                
                <h3>Technical Aspects</h3>
                <p>
                    This enhancement uses PHP sessions to remember who is logged in and their role. When someone tries to 
                    access the HR dashboard, the system checks if they have the HR role before letting them in. The system 
                    uses a database table to store user information and connects user accounts to their job applications.
                </p>
                
                <h3>Why This Goes Beyond Basic Requirements</h3>
                <p>
                    The assignment only required creating forms and processing data, but I added:
                </p>
                <ul>
                    <li>A complete user account system with login and registration</li>
                    <li>Different interfaces based on user role (HR vs. regular users)</li>
                    <li>Protection so only authorized users can access certain pages</li>
                    <li>A way to connect user accounts with their job applications</li>
                </ul>
                
            </div>
        </section>
                
    </div>

    <?php
    include 'footer.inc';
    ?>
</body>
</html>