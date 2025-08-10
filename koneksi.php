<?php
$host = "localhost:3307"; // sesuaikan port Laragon kamu
$user = "root";
$pass = "";
$db   = "todo_db";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
