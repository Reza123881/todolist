<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id        = $_POST['id'];
    $tugas     = mysqli_real_escape_string($conn, $_POST['tugas']);
    $prioritas = mysqli_real_escape_string($conn, $_POST['prioritas']);

    $sql = "UPDATE taks SET nama_tugas='$tugas', prioritas='$prioritas' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?pesan=sukses");
        exit();
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
} else {
    echo "Akses tidak diizinkan.";
}
?>
