<?php
// 1. Sertakan file koneksi ke database
include 'koneksi.php';

// 2. Cek apakah request yang masuk adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 3. Ambil dan amankan data dari form
    $nama_tugas = mysqli_real_escape_string($conn, $_POST['tugas'] ?? '');
    $status     = mysqli_real_escape_string($conn, $_POST['status'] ?? 'belum');
    $prioritas  = mysqli_real_escape_string($conn, $_POST['prioritas'] ?? 'Penting dan Mendesak');
    $tanggal    = mysqli_real_escape_string($conn, $_POST['tanggal'] ?? date('Y-m-d'));

    // 4. Validasi input kosong
    if (empty($nama_tugas)) {
        echo "Nama tugas tidak boleh kosong.";
        exit;
    }

    // 5. Validasi pilihan enum (opsional tapi aman)
    $status_allowed = ['belum', 'selesai'];
    $prioritas_allowed = ['Penting dan Mendesak', 'Penting tapi Tidak Mendesak', 'Tidak Penting tapi Mendesak', 'Tidak Penting dan Tidak Mendesak'];

    if (!in_array($status, $status_allowed)) {
        echo "Status tidak valid.";
        exit;
    }

    if (!in_array($prioritas, $prioritas_allowed)) {
        echo "Prioritas tidak valid.";
        exit;
    }

    // 6. Query untuk menyimpan data
    $sql = "INSERT INTO taks (nama_tugas, status, prioritas, tanggal) 
            VALUES ('$nama_tugas', '$status', '$prioritas', '$tanggal')";

    // 7. Eksekusi query
    if (mysqli_query($conn, $sql)) {
        // Jika berhasil, redirect ke index
       header("Location: index.php?pesan=sukses");
        exit();
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }

} else {
    // Jika bukan POST
    echo "Akses tidak diizinkan.";
}
?>
