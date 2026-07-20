<?php
$conn = new mysqli("localhost", "root", "", "menus");
$result = $conn->query("SELECT * FROM restaurant");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Restaurants (Guest)</title>
    <link rel="stylesheet" href="../css/guest_restaurant.css">
    <script>
        function showPopup(event) {
            event.preventDefault();
            document.getElementById("popup").style.display = "flex";
        }
    </script>
</head>
<body>

<div class="navbar">
    <div style="display:flex; align-items:center; gap:10px;">
        <img src="../images/logo.png" style="height:60px;">
        <span>MENUS</span>
    </div>
    <div>
        Guest |
        <a href="#" onclick="showPopup(event)">📦 My Orders</a> |
        <a href="#" onclick="showPopup(event)">🛒 Cart</a>
    </div>
</div>

<div class="wrapper">

    <div class="hero">
        <h1>Find Your Favorite Food</h1>
        <p>Choose from top restaurants near you</p>
    </div>

    <div class="search-box">
        <input type="text" placeholder="Search restaurants...">
    </div>

    <div class="container">
        <?php while($row = $result->fetch_assoc()) { ?>
        <a href="#" onclick="showPopup(event)" class="card">
            <img src="../images/<?php echo $row['image'] ? $row['image'] : 'default.jpg'; ?>">
            <div class="card-content">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['location']; ?></p>
                <div class="meta">⭐ 4.5 • 30-40 min</div>
            </div>
        </a>
        <?php } ?>
    </div>

</div>


<div id="popup" class="popup">
    <div class="popup-box">
        <h3>Please Login or Sign Up</h3>
        <p>You must log in to continue.</p>
        <button onclick="window.location.href='index.html'">
            Go to Login / Signup
        </button>
    </div>
</div>

</body>
</html>
