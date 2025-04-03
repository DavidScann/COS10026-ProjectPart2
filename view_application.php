<?php
require_once 'settings.php';
session_start();

// Check if user is logged in as HR
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'HR') {
    $_SESSION['error'] = "Access denied. You do not have permission to view that page.";
    header("Location: index.php");
    exit;
}

// Connect to database
$conn = connectDB();
if (!$conn) {
    die("Connection failed. Please try again later.");
}

// Get application ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: manage.php");
    exit;
}

$eoi_id = sanitizeInput($conn, $_GET['id']);

// Get application details
$sql = "SELECT * FROM eoi WHERE EOInumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $eoi_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: manage.php");
    exit;
}

$application = $result->fetch_assoc();

// Process status update if submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update_status' && isset($_POST['status'])) {
        $status = sanitizeInput($conn, $_POST['status']);
        
        $sql = "UPDATE eoi SET status = ? WHERE EOInumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $eoi_id);
        
        if ($stmt->execute()) {
            // Update the status in our current view
            $application['status'] = $status;
            $_SESSION['message'] = "Status updated successfully.";
        } else {
            $_SESSION['error'] = "Error updating status: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.inc'; ?>
    <title>View Application - W.O.R.K_Shop</title>
</head>
<body>
    <div class="container">
        <div class="application-detail-header">
            <h1>Application Details</h1>
            <a href="manage.php" class="btn-back">← Back to Applications</a>
        </div>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
        
        <div class="application-detail">
            <div class="form-section">
                <h2>
                    <?php echo htmlspecialchars($application['first_name'] . ' ' . $application['last_name']); ?>
                    <span class="job-ref">Job Ref: <?php echo htmlspecialchars($application['job_reference']); ?></span>
                </h2>
                
                <div class="status-row">
                    <span class="status-badge status-<?php echo strtolower($application['status']); ?>">
                        <?php echo htmlspecialchars($application['status']); ?>
                    </span>
                    
                    <form method="POST" action="" class="status-update-form">
                        <input type="hidden" name="action" value="update_status">
                        <select name="status">
                            <option value="">Change Status</option>
                            <option value="New" <?php echo $application['status'] === 'New' ? 'selected' : ''; ?>>New</option>
                            <option value="Current" <?php echo $application['status'] === 'Current' ? 'selected' : ''; ?>>Current</option>
                            <option value="Final" <?php echo $application['status'] === 'Final' ? 'selected' : ''; ?>>Final</option>
                        </select>
                        <button type="submit" class="btn-update">Update</button>
                    </form>
                </div>
                
                <div class="detail-section">
                    <h3>Personal Information</h3>
                    <div class="detail-grid">
                        <div class="detail-row">
                            <div class="detail-label">Full Name:</div>
                            <div class="detail-value"><?php echo htmlspecialchars($application['first_name'] . ' ' . $application['last_name']); ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h3>Contact Information</h3>
                    <div class="detail-grid">
                        <div class="detail-row">
                            <div class="detail-label">Email:</div>
                            <div class="detail-value"><?php echo htmlspecialchars($application['email']); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Phone:</div>
                            <div class="detail-value"><?php echo htmlspecialchars($application['phone']); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Address:</div>
                            <div class="detail-value">
                                <?php echo htmlspecialchars($application['street_address']); ?><br>
                                <?php echo htmlspecialchars($application['suburb']); ?>, 
                                <?php echo htmlspecialchars($application['state']); ?> 
                                <?php echo htmlspecialchars($application['postcode']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h3>Skills</h3>
                    <div class="skills-container">
                        <?php if ($application['skill1'] || $application['skill2'] || $application['skill3'] || $application['skill4'] || 
                                 $application['skill5'] || $application['skill6'] || $application['skill7'] || $application['skill8'] || 
                                 $application['skill9'] || $application['skill10'] || $application['skill11'] || $application['skill12']): ?>
                            
                            <?php if ($application['skill1']): ?>
                                <span class="skill-badge">HTML/CSS</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill2']): ?>
                                <span class="skill-badge">JavaScript</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill3']): ?>
                                <span class="skill-badge">PHP</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill4']): ?>
                                <span class="skill-badge">Python</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill5']): ?>
                                <span class="skill-badge">Hardware Troubleshooting</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill6']): ?>
                                <span class="skill-badge">Network Administration</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill7']): ?>
                                <span class="skill-badge">PCB Design</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill8']): ?>
                                <span class="skill-badge">Embedded Systems</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill9']): ?>
                                <span class="skill-badge">IoT Development</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill10']): ?>
                                <span class="skill-badge">Server Management</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill11']): ?>
                                <span class="skill-badge">Cloud Infrastructure</span>
                            <?php endif; ?>
                            
                            <?php if ($application['skill12']): ?>
                                <span class="skill-badge">Cybersecurity</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <p>No specific skills selected.</p>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (!empty($application['other_skills'])): ?>
                        <div class="other-skills">
                            <h4>Other Skills:</h4>
                            <p><?php echo nl2br(htmlspecialchars($application['other_skills'])); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="detail-section">
                    <h3>Application Info</h3>
                    <div class="detail-grid">
                        <div class="detail-row">
                            <div class="detail-label">Date Applied:</div>
                            <div class="detail-value"><?php echo date('F j, Y \a\t g:i a', strtotime($application['application_date'])); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Application ID:</div>
                            <div class="detail-value"><?php echo htmlspecialchars($application['EOInumber']); ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="application-actions">
                    <a href="mailto:<?php echo htmlspecialchars($application['email']); ?>" class="btn-contact">Contact Applicant</a>
                    
                    <form method="POST" action="manage.php" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this application? This cannot be undone.');">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="EOInumber" value="<?php echo $eoi_id; ?>">
                        <button type="submit" class="btn-delete">Delete Application</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'footer.inc'; ?>
</body>
</html>