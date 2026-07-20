<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="container">
    <img src="../images/logo.png" alt="Menus logo" class="logo">
    <h2>Login</h2>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <form method="post" action="../php/login.php">

        <input type="text" name="email" placeholder="Email" required>

        <input type="password" id="password" name="password" placeholder="Password" required>

        <label class="toggle">
            <input type="checkbox" onclick="togglePassword()">
            <span class="slider"></span>
            <span class="toggle-text">Show Password</span>
        </label>

        <button type="submit">Login</button>
    </form>
</div>

<script>
function togglePassword() {
    var pwd = document.getElementById("password");
    pwd.type = (pwd.type === "password") ? "text" : "password";
}
</script>

</body>
</html>