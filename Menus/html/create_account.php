<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Account - MENUS</title>
  <link rel="stylesheet" href="../css/registeration.css?v=10">
</head>
<body>
  <div class="container">
    <img src="../images/logo.png" alt="MENUS Logo" class="logo">
    <h2>Create Account</h2>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <form action="../php/registeration.php" method="POST">
      <input type="text" name="firstName" placeholder="First Name" required>
      <input type="text" name="lastName" placeholder="Last Name" required>
      <input type="text" name="phone" placeholder="Phone Number" maxlength="11" pattern="[0-9]{11}" required>
      <input type="text" name="address" placeholder="Address" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="Confirm_Password" placeholder="Confirm Password" required>

      <div class="show-password">
        <input type="checkbox" onclick="togglePassword()"> Show Password
      </div>

      <input type="submit" value="Register">
    </form>
  </div>

  <script>
    function togglePassword() {
      const pw = document.querySelector('input[name="password"]');
      const cpw = document.querySelector('input[name="Confirm_Password"]');
      const type = pw.type === "password" ? "text" : "password";
      pw.type = type;
      cpw.type = type;
    }
  </script>
</body>
</html>
