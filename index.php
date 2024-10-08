<?php

// Menyertakan koneksi database
$db = new SQLite3('produk.db');

// Query untuk mengambil semua produk dari tabel
$result = $db->query("SELECT * FROM products");

if (!$result) {
    // Jika query gagal, tampilkan pesan error
    echo "Error dalam query: " . $db->lastErrorMsg();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS CRUD Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            max-width: 1440px;
            width: 100%;
            background: #fff;
            box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
        }
        .container h2 {
            padding: 2rem 1rem;
            text-align: center;
            background: #44a0a78c;
            color: #fff;
            font-size: 20px;
        }
        .tbl {
            width: 100%;
            border-collapse: collapse;
        }
        .tbl thead {
            background: #424949;
            color: #fff;
        }
        .tbl thead tr th {
            font-size: 21px;
            padding: 1.4rem;
            letter-spacing: 0.2rem;
            vertical-align: top;
            border: 1px solid #aab7b8;
        }
        .tbl tbody tr td {
            font-size: 1rem;
            letter-spacing: 0.2rem;
            font-weight: normal;
            text-align: center;
            border: 1px solid #aab7b8;
            padding: 1rem;
        }
        .tbl tr:nth-child(even) {
            background: #ccc;
            transition: all 0.3s ease-in;
            cursor: pointer;
        }

        /* Removed hover effect */
        .tbl tr:hover td {
            background: none; /* Remove background color on hover */
            color: inherit; /* Keep text color unchanged */
            transition: none; /* Disable transition */
            cursor: auto; /* Change cursor to default */
        }

        .tbl button {
            display: inline-block;
            border: none;
            margin: 0 auto;
            padding: 0.4rem;
            border-radius: 1px;
            outline: none;
            cursor: pointer;
        }
        .btn_trash {
            background: #e74c3c;
            color: #fff;
        }
        .btn_edit {
            color: #fff;
            background: #1e8449;
        }
        .btn_add {
            color: #fff;
            background: #0373fc;
            padding: 0.5rem 1rem; 
            align-items: center; 
            border-radius: 5px;
            cursor: pointer;
        }
        .btn_add a{
          text-decoration: none;
        }
        .btn_add i {
            margin-right: 5px; 
        }
        @media (max-width: 768px) {
            .tbl thead {
                display: none;
            }
            .tbl tr,
            .tbl td {
                display: block;
                width: 100%;
            }
            .tbl tr {
                margin-bottom: 1rem;
            }
            .tbl tbody tr td {
                text-align: right;
                position: relative;
                transition: all 0.2s ease-in;
            }
            .tbl td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 1.2rem;
                text-align: left;
            }
            .tbl_content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="tbl_content">
            <h2>CMS CRUD Produk</h2>
            <a href="create.php">
                <button class="btn_add">
                    <i class="fa-solid fa-cart-plus"></i>
                </button>
            </a>
            <table class="tbl">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    // Loop untuk menampilkan data produk
                    while ($row = $result->fetchArray()): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td>Rp <?= htmlspecialchars($row['price']); ?></td>
                        <td><?= htmlspecialchars($row['description']); ?></td>
                        <td><a href="edit.php?id=<?= $row['id']; ?>"><button class="btn_edit"><i class="fa fa-pencil"></i></button></a></td>
                        <td><a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><button class="btn_trash"><i class="fa fa-trash"></i></button></a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
