<?php
$conn = new mysqli("localhost", "root", "", "menus");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("No restaurant selected.");
}

$restaurant_id = (int) $_GET["id"];

if (isset($_POST['delete_id'])) {
    $delete_id = (int) $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM menu WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    header("Location: view_restaurant.php?id=" . $restaurant_id . "&success=deleted");
    exit();
}

$stmt = $conn->prepare("SELECT name, image FROM restaurant WHERE id = ?");
$stmt->bind_param("i", $restaurant_id);
$stmt->execute();
$restaurant = $stmt->get_result()->fetch_assoc();
$stmt = $conn->prepare("SELECT id, name, price, category FROM menu WHERE restaurant_id = ?");
$stmt->bind_param("i", $restaurant_id);
$stmt->execute();
$items = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $restaurant["name"]; ?></title>
    <link rel="stylesheet" href="../css/view_restaurant.css">
</head>
<body>

<div class="container">
    <a href="restaurants.php" class="back-btn">⬅ Back</a>
    <?php if (isset($_GET['success'])): ?>
        <div class="success-msg">Item deleted successfully ✔</div>
    <?php endif; ?>

    <div class="header">
        <img src="/MENUS/images/<?php echo $restaurant['image']; ?>" class="logo">
        <h2><?php echo $restaurant["name"]; ?> - Menu</h2>
    </div>
    <table>
        <tr>
            <th>Item</th>
            <th>Category</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>

        <?php if ($items->num_rows > 0): ?>
            <?php while ($row = $items->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["category"]; ?></td>
                    <td><?php echo number_format($row["price"], 2); ?> EGP</td>
                    <td>
                        <a href="../html/edit_item.php?id=<?php echo $row["id"]; ?>" class="edit-btn">
                            Edit
                        </a>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                            <button class="delete-btn" onclick="return confirm('Delete item?')">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No menu items found</td></tr>
        <?php endif; ?>
    </table>
    <div class="actions">
        <a href="add_menu.php?id=<?php echo $restaurant_id; ?>" class="btn">
            + Add New Item
        </a>
    </div>

</div>

</body>
</html>