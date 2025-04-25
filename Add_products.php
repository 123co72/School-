<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new PDO("sqlite:locallink.db");
include 'navbar.php';
        $seller_id = $_POST['seller_id'];
        $name = $_POST['product_name'];
        $desc = $_POST['description'];
        $price = $_POST['price'];

        $stmt = $db->prepare("INSERT INTO products (seller_id, product_name, description, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$seller_id, $name, $desc, $price]);

        $message = "Product added successfully!";
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>

    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="seller_id" value="1"> <!-- Replace with actual logged-in seller ID -->
        <input type="text" name="product_name" placeholder="Product name" required><br><br>
        <textarea name="description" placeholder="Description"></textarea><br><br>
        <input type="number" step="0.01" name="price" placeholder="Price" required><br><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>