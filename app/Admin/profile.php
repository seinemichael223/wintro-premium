<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <?php include 'header.php'; ?>
        
</head>

<body>
    <main>
        <h1>Profile</h1>
        <a href="../Reg_Login/login.html">Log Out</a>
        <div class="edit" id="editButton" onclick="editDetails()">EDIT</div>

        <div class="management-container">
            <div class="manage-account-info" id="info-section">
                <div class="info-content" id="info-content">
                    <table id="infoTable">
                        <tr>
                            <th class="label">Full Name</th>
                            <td class="value" id="fullName">Adam Wong</td>
                        </tr>
                        <tr>
                            <th class="label">Birthday</th>
                            <td class="value" id="birthday">2000-01-01</td>
                        </tr>
                        <tr>
                            <th class="label">Gender</th>
                            <td class="value" id="gender">Male</td>
                        </tr>
                        <tr>
                            <th class="label">Email</th>
                            <td class="value" id="email">useremail@example.com</td>
                        </tr>
                        <tr>
                            <th class="label">Password</th>
                            <td class="value" id="password">********</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>
