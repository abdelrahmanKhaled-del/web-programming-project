<!DOCTYPE html>
<html>
<head>
    <title>MENUS ADMIN</title>
    <link rel="stylesheet" href="../css/admin_login.css"> 
</head>
<body>
<div class="container"> 
    <div class="upper-part"> 
        <img src="/MENUS/images/logo.png" alt="Logo" class="logo">
        <h2>Welcome Admin, please enter your information</h2>
    </div>

    <div class="form"> 
        <?php  if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post" action="../php/admin_login.php"> 
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter your username" required>

            <label>Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your Password" required>

            <input type="checkbox" onclick="showPassword()"> Show Password <br>

            <input type="submit" name="submit_button" value="Login">
        </form>
    </div>
</div>

<script>
function showPassword() { 
    var pwd = document.getElementById("password");
    pwd.type = (pwd.type === "password") ? "text" : "password"; 
}
</script>
</body>
</html>
