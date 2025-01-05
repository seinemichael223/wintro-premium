<?php
require_once '../includes/dbh-inc.php';
require_once '../includes/config_session-inc.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch current user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    
    // Update user information
    $updateStmt = $pdo->prepare("UPDATE users SET full_name = ?, username = ?, email = ?, phone_number = ? WHERE id = ?");
    
    try {
        $updateStmt->execute([$fullName, $email, $phone, $userId]);
        $_SESSION['message'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } catch (PDOException $e) {
        $error = "Error updating profile: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="management-container">
        <h2>Edit Profile Information</h2>
        
        <form method="POST" onsubmit="return validateForm('edit-profile-form')" id="edit-profile-form">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="username">Full Name</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            </div>
            
            <button type="submit" class="edit-btn">Save Changes</button>
            <button type="button" class="edit-btn" onclick="window.location.href='profile.php'">Cancel</button>
        </form>
    </div>
    
    <script src="profile.js"></script>
</body>
</html>