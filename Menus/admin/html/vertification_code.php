<!DOCTYPE html>
<html>
<head>
    <title>Verification Page</title>
    <link rel="stylesheet" href="../css/vertification_code.css">
</head>
<body>
    <div class="container">
        <img src="/MENUS/images/logo.png" alt="MENUS logo" class="logo">
        <h2>Enter Verification Code</h2>

        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

        <p>Your verification code is: 
            <strong><?php echo $_SESSION["verification_code"]; ?></strong>
        </p>

        <form method="post" action="../php/vertification_code.php">
            <input type="text" name="code" placeholder="Enter verification code" required>
            <button type="submit">Verify</button>
        </form>
    </div>
</body>
</html>
