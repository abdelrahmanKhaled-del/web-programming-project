<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <link rel="stylesheet" href="../css/logout.css">
</head>
<body>

<div class="logout-box">
    <h2>👋 You have been logged out</h2>
    <p>See you again soon.</p>

    <a href="login.php" class="btn">🔐 Login Again</a>
</div>

</body>
</html>