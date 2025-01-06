<?php
require_once '../includes/dbh-inc.php';
require_once '../includes/config_session-inc.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch current address
$stmt = $pdo->prepare("SELECT * FROM user_address WHERE uid = ?");
$stmt->execute([$userId]);
$address = $stmt->fetch();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $street = $_POST['address_street'];
    $city = $_POST['address_city'];
    $state = $_POST['address_state'];
    $zip = $_POST['address_zip'];
    $country = $_POST['address_country'];

    if ($address) {
        // Update existing address
        $updateStmt = $pdo->prepare("UPDATE user_address SET address_street = ?, address_city = ?, 
            address_state = ?, address_zip = ?, address_country = ? WHERE uid = ?");
        $updateStmt->execute([$street, $city, $state, $zip, $country, $userId]);
    } else {
        // Insert new address
        $insertStmt = $pdo->prepare("INSERT INTO user_address (uid, address_street, address_city, 
            address_state, address_zip, address_country) VALUES (?, ?, ?, ?, ?, ?)");
        $insertStmt->execute([$userId, $street, $city, $state, $zip, $country]);
    }

    $_SESSION['message'] = "Address updated successfully!";
    header("Location: ../Profile/profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Address</title>
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <div class="management-container">
        <h2>Edit Address</h2>

        <form method="POST" onsubmit="return validateForm('edit-address-form')" id="edit-address-form">
            <div class="form-group">
                <label for="address_street">Street Address</label>
                <input type="text" id="address_street" name="address_street"
                    value="<?php echo htmlspecialchars($address['address_street'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="address_city">City</label>
                <input type="text" id="address_city" name="address_city"
                    value="<?php echo htmlspecialchars($address['address_city'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="address_state">State</label>
                <input type="text" id="address_state" name="address_state"
                    value="<?php echo htmlspecialchars($address['address_state'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="address_zip">ZIP Code</label>
                <input type="text" id="address_zip" name="address_zip"
                    value="<?php echo htmlspecialchars($address['address_zip'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="address_country">Country</label>
                <input type="text" id="address_country" name="address_country"
                    value="<?php echo htmlspecialchars($address['address_country'] ?? ''); ?>" required>
            </div>

            <button type="submit" class="edit-btn">Save</button>
            <button type="button" class="edit-btn" onclick="window.location.href='../Profile/profile.php';">Cancel</button>
        </form>
    </div>

    <script src="profile.js"></script>
</body>

</html>