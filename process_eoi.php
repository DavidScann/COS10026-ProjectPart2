<?php
require_once 'settings.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectDB();
    
    if (!$conn) {
        echo "Database connection error. Please try again later.";
        exit;
    }
    
    // Sanitize and collect form inputs
    $jobref = sanitizeInput($conn, $_POST['jobref']);
    $firstname = sanitizeInput($conn, $_POST['firstname']);
    $lastname = sanitizeInput($conn, $_POST['lastname']);
    $address = sanitizeInput($conn, $_POST['address']);
    $suburb = sanitizeInput($conn, $_POST['suburb']);
    $state = sanitizeInput($conn, $_POST['state']);
    $postcode = sanitizeInput($conn, $_POST['postcode']);
    $email = sanitizeInput($conn, $_POST['email']);
    $phone = sanitizeInput($conn, $_POST['phone']);
    $otherskills = sanitizeInput($conn, $_POST['otherskills']);
    
    // Initialize skills as all FALSE
    $skill1 = $skill2 = $skill3 = $skill4 = $skill5 = $skill6 = $skill7 = $skill8 = $skill9 = $skill10 = $skill11 = $skill12 = 0;
    
    // Check which skills are selected
    if (isset($_POST['skills']) && is_array($_POST['skills'])) {
        foreach ($_POST['skills'] as $skill) {
            switch($skill) {
                case 'html':
                    $skill1 = 1;
                    break;
                case 'javascript':
                    $skill2 = 1;
                    break;
                case 'php':
                    $skill3 = 1;
                    break;
                case 'python':
                    $skill4 = 1;
                    break;
                case 'hardware':
                    $skill5 = 1;
                    break;
                case 'network':
                    $skill6 = 1;
                    break;
                case 'pcb':
                    $skill7 = 1;
                    break;
                case 'embedded':
                    $skill8 = 1;
                    break;
                case 'iot':
                    $skill9 = 1;
                    break;
                case 'server':
                    $skill10 = 1;
                    break;
                case 'cloud':
                    $skill11 = 1;
                    break;
                case 'cyber':
                    $skill12 = 1;
                    break;
            }
        }
    }
    
    // Insert application data into EOI table
    $sql = "INSERT INTO eoi (job_reference, first_name, last_name, street_address, suburb, state, postcode, 
                          email, phone, skill1, skill2, skill3, skill4, skill5, skill6, 
                          skill7, skill8, skill9, skill10, skill11, skill12, other_skills, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssiiiiiiiiiiiss", $jobref, $firstname, $lastname, $address, $suburb, $state, $postcode, 
                     $email, $phone, $skill1, $skill2, $skill3, $skill4, $skill5, $skill6, 
                     $skill7, $skill8, $skill9, $skill10, $skill11, $skill12, $otherskills);
    
    if ($stmt->execute()) {
        // Redirect to success page
        header("Location: apply_success.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $conn->close();
}
?>