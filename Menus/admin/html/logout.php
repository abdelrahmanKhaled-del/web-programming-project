<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logged Out</title>
    <link rel="stylesheet" href="../css/logout.css">
</head>
<body>

<div class="logout-container">
    <h2>✅ You have been logged out</h2>
    <p>Thank you for using the system.</p>

    <a href="admin_login.php" class="login-btn">🔐 Login Again</a>
</div>

</body>
</html>