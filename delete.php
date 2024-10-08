<?php
$db = new SQLite3('produk.db');
$id = $_GET['id'];
$db->exec("DELETE FROM products WHERE id = $id");
header("Location: index.php");
exit;
?>
