<?php
session_start(); // Add this at the top
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
    $gender = isset($_POST['gender']) ? sanitizeInput($conn, $_POST['gender']) : '';
    $dobInput = sanitizeInput($conn, $_POST['dob']);

    // Convert date format from dd/mm/yyyy to yyyy-mm-dd for MySQL
    $dobParts = explode('/', $dobInput);
    if (count($dobParts) === 3) {
        $dob = $dobParts[2] . '-' . $dobParts[1] . '-' . $dobParts[0]; // yyyy-mm-dd
    } else {
        $dob = NULL;
    }
    
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
    $sql = "INSERT INTO eoi (job_reference, first_name, last_name, gender, dob, street_address, suburb, state, postcode, 
                          email, phone, skill1, skill2, skill3, skill4, skill5, skill6, 
                          skill7, skill8, skill9, skill10, skill11, skill12, other_skills, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssiiiiiiiiiiiiss", $jobref, $firstname, $lastname, $gender, $dob, $address, $suburb, $state, $postcode, 
                     $email, $phone, $skill1, $skill2, $skill3, $skill4, $skill5, $skill6, 
                     $skill7, $skill8, $skill9, $skill10, $skill11, $skill12, $otherskills);
    
    if ($stmt->execute()) {
        // Set success message in session
        $_SESSION['success_message'] = "Thank you for applying! Your application has been successfully submitted.";
        
        // Redirect to success page
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $conn->close();
}
?>