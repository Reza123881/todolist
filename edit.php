<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;
$data = mysqli_query($conn, "SELECT * FROM taks WHERE id=$id");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Tugas</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h3>Edit Tugas</h3>
  <form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
    <div class="mb-3">
      <label for="tugas" class="form-label">Nama Tugas</label>
      <input type="text" class="form-control" name="tugas" value="<?= htmlspecialchars($row['nama_tugas']) ?>" required />
    </div>
    <div class="mb-3">
      <label for="prioritas" class="form-label">Prioritas</label>
      <select class="form-control" name="prioritas">
        <option value="Penting dan Mendesak" <?= $row['prioritas'] == 'Penting dan Mendesak' ? 'selected' : '' ?>>Penting dan Mendesak</option>
        <option value="Penting tapi Tidak Mendesak" <?= $row['prioritas'] == 'Penting tapi Tidak Mendesak' ? 'selected' : '' ?>>Penting tapi Tidak Mendesak</option>
        <option value="Tidak Penting tapi Mendesak" <?= $row['prioritas'] == 'Tidak Penting tapi Mendesak' ? 'selected' : '' ?>>Tidak Penting tapi Mendesak</option>
        <option value="Tidak Penting dan Tidak Mendesak" <?= $row['prioritas'] == 'Tidak Penting dan Tidak Mendesak' ? 'selected' : '' ?>>Tidak Penting dan Tidak Mendesak</option>
      </select>
    </div>
    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
