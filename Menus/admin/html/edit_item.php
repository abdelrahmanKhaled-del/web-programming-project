<?php
$conn = new mysqli("localhost", "root", "", "menus");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM menu WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc();

if (!$item) {
    die("Item not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    $stmt = $conn->prepare("
        UPDATE menu 
        SET name = ?, price = ?, category = ?
        WHERE id = ?
    ");

    $stmt->bind_param("sdsi", $name, $price, $category, $id);
    $stmt->execute();

    header("Location: view_restaurant.php?id=" . $item["restaurant_id"]);
    exit();
}
?>

<form method="POST">
    <h2>Edit Item</h2>

    Name:
    <input type="text" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required>

    Price:
    <input type="number" name="price" value="<?php echo $item['price']; ?>" required>

    Category:
    <input type="text" name="category" value="<?php echo htmlspecialchars($item['category']); ?>" required>

    <button type="submit">Update</button>
</form>