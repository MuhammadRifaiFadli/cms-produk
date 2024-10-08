<?php

// Create a connection to the SQLite database
$db = new SQLite3('produk.db');

// Check if the database connection was successful
if (!$db) {
    echo "Database connection failed: " . $db->lastErrorMsg();
    exit;
}

// Create the products table if it does not exist
$result = $db->query("CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    price REAL NOT NULL,
    description TEXT NOT NULL
)");

// Check if the table creation query was successful
if (!$result) {
    echo "Error creating table: " . $db->lastErrorMsg();
    exit;
}

echo "Database and table created successfully!";
?>
