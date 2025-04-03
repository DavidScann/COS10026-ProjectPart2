<?php
session_start();
require_once 'settings.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'header.inc';
    ?>
</head>

<body>
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?php 
                echo $_SESSION['success_message']; 
                unset($_SESSION['success_message']);
            ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <h1>Current Opportunities</h1>
        <p class="intro-text">Join our team of creative problem-solvers and help us turn imagination into reality. We're looking for talented individuals who are passionate about innovation and excellence.</p>
        <p class="intro-text">* Note that some of the content on this website was written with the assistance of AI. It might not be accurate to real world job listings.</p>
        <div class="jobs-list">
            <?php
            // Get jobs from database
            $conn = connectDB();
            if (!$conn) {
                echo "<p>Error connecting to database. Please try again later.</p>";
                exit;
            }
            
            $sql = "SELECT * FROM jobs ORDER BY title";
            $result = $conn->query($sql);
            
            if ($result && $result->num_rows > 0) {
                while ($job = $result->fetch_assoc()) {
                    // Thanks, StackOverflow
                    $responsibilities = json_decode($job['responsibilities']);
                    $requirements = json_decode($job['requirements']);
                    $qualifications = json_decode($job['qualifications']);
                    ?>
                    <div class="job-card">
                        <div class="job-header">
                            <h2><?php echo htmlspecialchars($job['title']); ?></h2>
                            <span class="job-ref">REF: <?php echo htmlspecialchars($job['job_reference']); ?></span>
                        </div>

                        <div class="job-brief">
                            <p><?php echo htmlspecialchars($job['brief']); ?></p>
                        </div>

                        <div class="job-details">
                            <div class="job-meta">
                                <div class="meta-item">
                                    <span class="meta-label">Salary Range:</span>
                                    <span class="meta-value"><?php echo htmlspecialchars($job['salary_range']); ?></span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Reports To:</span>
                                    <span class="meta-value"><?php echo htmlspecialchars($job['reports_to']); ?></span>
                                </div>
                            </div>

                            <div class="job-section">
                                <h3>Key Responsibilities</h3>
                                <ul>
                                    <?php foreach ($responsibilities as $item): ?>
                                        <li><?php echo htmlspecialchars($item); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="job-section">
                                <h3>Essential Requirements</h3>
                                <ul>
                                    <?php foreach ($requirements as $item): ?>
                                        <li><?php echo htmlspecialchars($item); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="job-section">
                                <h3>Preferable Qualifications</h3>
                                <ul>
                                    <?php foreach ($qualifications as $item): ?>
                                        <li><?php echo htmlspecialchars($item); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <a href="apply.php?job=<?php echo htmlspecialchars($job['job_reference']); ?>" class="btn-apply">Apply Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No job openings available at this time. Please check back later.</p>";
            }
            
            $conn->close();
            ?>
        </div>
    </div>

    <?php
    include 'footer.inc';
    ?>
</body>

</html>