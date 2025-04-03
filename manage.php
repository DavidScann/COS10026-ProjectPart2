<?php
require_once 'settings.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'HR') {
    // Redirect non-HR users to the home page with an error message
    $_SESSION['error'] = "Access denied. You do not have permission to view that page.";
    header("Location: index.php");
    exit;
}

$conn = connectDB();
if (!$conn) {
    die("Connection failed. Please try again later.");
}

// Process application status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update' && isset($_POST['EOInumber']) && isset($_POST['status'])) {
        $eoi_id = sanitizeInput($conn, $_POST['EOInumber']);
        $status = sanitizeInput($conn, $_POST['status']);
        
        $sql = "UPDATE eoi SET status = ? WHERE EOInumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $eoi_id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Application status updated successfully.";
        } else {
            $_SESSION['error'] = "Error updating status: " . $stmt->error;
        }
    } elseif ($_POST['action'] === 'delete' && isset($_POST['EOInumber'])) {
        $eoi_id = sanitizeInput($conn, $_POST['EOInumber']);
        
        $sql = "DELETE FROM eoi WHERE EOInumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $eoi_id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Application deleted successfully.";
        } else {
            $_SESSION['error'] = "Error deleting application: " . $stmt->error;
        }
    }
    
    // This apparently is needed to prevent the form from resubmitting
    // when the user refreshes the pages
    header("Location: manage.php");
    exit;
}

// Get all applications with search/filter
$search = isset($_GET['search']) ? sanitizeInput($conn, $_GET['search']) : '';
$status_filter = isset($_GET['status']) ? sanitizeInput($conn, $_GET['status']) : '';
$job_filter = isset($_GET['job']) ? sanitizeInput($conn, $_GET['job']) : '';

$sql = "SELECT * FROM eoi WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND (first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%')";
}

if (!empty($status_filter)) {
    $sql .= " AND status = '$status_filter'";
}

if (!empty($job_filter)) {
    $sql .= " AND job_reference = '$job_filter'";
}

$sql .= " ORDER BY application_date DESC";
$result = $conn->query($sql);

$job_refs = $conn->query("SELECT DISTINCT job_reference FROM eoi ORDER BY job_reference");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.inc'; ?>
    <title>Manage Applications - W.O.R.K_Shop</title>
</head>
<body>
    <div class="container">
        <h1>Applications Management</h1>
        <p class="intro-text">Manage job applications for W.O.R.K_Shop positions.</p>
        
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
        
        <!-- Search and Filters -->
        <div class="dashboard-controls">
            <form method="GET" action="" class="filter-form">
                <div class="filter-group">
                    <input type="text" name="search" placeholder="Search name or email" value="<?php echo htmlspecialchars($search ?? ''); ?>">
                </div>
                
                <div class="filter-group">
                    <select name="status">
                        <option value="">All Statuses</option>
                        <option value="New" <?php echo $status_filter === 'New' ? 'selected' : ''; ?>>New</option>
                        <option value="Current" <?php echo $status_filter === 'Current' ? 'selected' : ''; ?>>Current</option>
                        <option value="Final" <?php echo $status_filter === 'Final' ? 'selected' : ''; ?>>Final</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <select name="job">
                        <option value="">All Positions</option>
                        <?php while ($job = $job_refs->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($job['job_reference']); ?>" 
                                <?php echo $job_filter === $job['job_reference'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($job['job_reference']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn-filter">Apply Filters</button>
                <a href="manage.php" class="btn-reset-filter">Reset</a>
            </form>
        </div>
        
        <!-- Applications Table -->
        <div class="applications-table">
            <?php if ($result && $result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Job Ref</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Applied</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['EOInumber']); ?></td>
                                <td><?php echo htmlspecialchars($row['job_reference']); ?></td>
                                <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                                <td><?php echo isset($row['gender']) ? htmlspecialchars(ucfirst($row['gender'])) : '-'; ?></td>
                                <td><?php echo isset($row['date_of_birth']) ? date('d/m/Y', strtotime($row['date_of_birth'])) : '-'; ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td><?php echo date('d M Y', strtotime($row['application_date'])); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo strtolower($row['status']); ?>">
                                        <?php echo htmlspecialchars($row['status']); ?>
                                    </span>
                                </td>
                                <td class="actions">
                                    <a href="view_application.php?id=<?php echo $row['EOInumber']; ?>" class="btn-action view">View</a>
                                    
                                    <form method="POST" class="inline-form">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="EOInumber" value="<?php echo $row['EOInumber']; ?>">
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="">Change Status</option>
                                            <option value="New" <?php echo $row['status'] === 'New' ? 'selected' : ''; ?>>New</option>
                                            <option value="Current" <?php echo $row['status'] === 'Current' ? 'selected' : ''; ?>>Current</option>
                                            <option value="Final" <?php echo $row['status'] === 'Final' ? 'selected' : ''; ?>>Final</option>
                                        </select>
                                    </form>
                                    
                                    <form method="POST" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this application? This cannot be undone.');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="EOInumber" value="<?php echo $row['EOInumber']; ?>">
                                        <button type="submit" class="btn-action delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-results">
                    <p>No applications found matching your criteria.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="dashboard-footer">
            <p>
                <a href="index.php" class="btn-back">← Return to Homepage</a>
                <a href="logout.php" class="btn-logout">Logout</a>
            </p>
        </div>
    </div>
    
    <?php include 'footer.inc'; ?>
    
    <script>
    // A bit of JavaScript flair to handle the delete confirmation
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-action.delete');
        deleteButtons.forEach(button => {
            button.closest('form').addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this application? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });
    });
    </script>
</body>
</html>