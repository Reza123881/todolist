<?php
include 'koneksi.php';

$id = intval($_GET['id']); // Ubah ke integer agar aman
$query = "UPDATE taks SET status='selesai' WHERE id=$id";
mysqli_query($conn, $query);

header("Location: index.php?pesan=sukses");
exit;
?>
