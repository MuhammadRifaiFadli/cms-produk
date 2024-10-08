<?php
// Menyertakan koneksi database
$db = new SQLite3('produk.db');

// Mendapatkan ID produk dari URL
$id = $_GET['id'];

// Query untuk mengambil data produk berdasarkan ID
$result = $db->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetchArray();

// Proses form ketika di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Query untuk memperbarui data produk
    $db->exec("UPDATE products SET name = '$name', price = '$price', description = '$description' WHERE id = $id");

    // Redirect kembali ke halaman utama setelah update
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Poppins;
        }
        .container {
            max-width: 300px;
            box-shadow: 0 0 5px grey;
            overflow: hidden;
            border-radius: 10px;
            margin: 0 auto; /* Center the container */
            padding: 20px; /* Add padding for spacing */
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        .form-container {
            width: 200px;
            display: table;
            margin: 0 auto;
        }
        .input-group {
            margin: 15px 0;
            text-align: center;
        }
        label {
            display: block;
            text-align: start;
            margin: 5px 0 5px 8px;
        }
        input, textarea {
            padding: 5px 10px;
            width: 100%; /* Make input fields full width */
            border-radius: 5px; /* Add rounded corners */
            border: 1px solid #ccc; /* Add border */
        }
        input[type="submit"], button {
            cursor: pointer;
            margin-bottom: 20px;
            padding: 7px 70px;
            background-color: #44a0a78c; /* Button background */
            color: #fff; /* Button text color */
            border: none; /* Remove border */
            border-radius: 5px; /* Add rounded corners */
        }
        button:hover {
            background-color: #36a0a0; /* Darker background on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="name">Nama Produk:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="input-group">
                <label for="price">Harga:</label>
                <input type="number" name="price" value="<?= htmlspecialchars($product['price']); ?>" required>
            </div>
            <div class="input-group">
                <label for="description">Deskripsi:</label>
                <textarea name="description" required><?= htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="input-group">
                <button type="submit">Update Produk</button>
            </div>
        </form>
    </div>
</body>
</html>
