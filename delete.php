<?php
include 'koneksi.php';

// Ambil dan validasi parameter ID
$id = $_GET['id'] ?? null;

if ($id === null || !is_numeric($id)) {
    // ID tidak valid, redirect dengan pesan gagal
    header("Location: index.php?pesan=hapus_gagal_id_tidak_valid");
    exit;
}

// Escape ID agar aman dari SQL Injection
$id = intval($id);

// Cek apakah data tugas benar-benar ada
$cek = mysqli_query($conn, "SELECT * FROM taks WHERE id = $id");

if (mysqli_num_rows($cek) === 0) {
    // Jika tidak ada data, redirect dengan pesan
    header("Location: index.php?pesan=hapus_gagal_data_tidak_ditemukan");
    exit;
}

// Eksekusi perintah hapus
$hapus = mysqli_query($conn, "DELETE FROM taks WHERE id = $id");

if ($hapus) {
    header("Location: index.php?pesan=hapus_berhasil&id=$id");
    exit;
} else {
    header("Location: index.php?pesan=hapus_gagal_query&id=$id");
    exit;
}
?>
