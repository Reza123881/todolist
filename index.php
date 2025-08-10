<?php
include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM taks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>To Do List</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<?php
$status_filter = $_GET['filter'] ?? 'semua';
$query = "SELECT * FROM taks";
if ($status_filter == 'selesai') {
    $query .= " WHERE status='selesai'";
} elseif ($status_filter == 'belum') {
    $query .= " WHERE status='belum'";
}
$query .= " ORDER BY id DESC";
$data = mysqli_query($conn, $query);
?>
<?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'sukses'): ?>
<script>
Swal.fire({
  icon: 'success',
  title: 'Berhasil!',
  text: 'Tugas berhasil ditambahkan/diupdate!',
  timer: 1500,
  showConfirmButton: false
});
</script>
<?php endif; ?>

<?php if (isset($_GET['pesan'])): ?>
<script>
    <?php if ($_GET['pesan'] == 'hapus_berhasil'): ?>
    Swal.fire({
        icon: 'success',
        title: 'Tugas Dihapus!',
        text: 'Tugas dengan ID <?= $_GET['id'] ?> berhasil dihapus.',
        timer: 1500,
        showConfirmButton: false
    });
    <?php elseif ($_GET['pesan'] == 'hapus_gagal_data_tidak_ditemukan'): ?>
    Swal.fire({
        icon: 'error',
        title: 'Data tidak ditemukan!',
        text: 'Tugas tidak ada dalam database.'
    });
    <?php elseif ($_GET['pesan'] == 'hapus_gagal_query'): ?>
    Swal.fire({
        icon: 'error',
        title: 'Query gagal!',
        text: 'Terjadi kesalahan saat menghapus tugas.'
    });
    <?php elseif ($_GET['pesan'] == 'hapus_gagal_id_tidak_valid'): ?>
    Swal.fire({
        icon: 'warning',
        title: 'ID tidak valid!',
        text: 'Permintaan hapus tidak sah.'
    });
    <?php endif; ?>
</script>
<?php endif; ?>


<!-- Filter Dropdown -->
<form method="GET" class="d-flex justify-content-center mb-3">
  <select name="filter" class="form-select w-25 text-center" onchange="this.form.submit()">
    <option value="semua" <?= $status_filter == 'semua' ? 'selected' : '' ?>>Tampilkan Semua</option>
    <option value="belum" <?= $status_filter == 'belum' ? 'selected' : '' ?>>Belum Selesai</option>
    <option value="selesai" <?= $status_filter == 'selesai' ? 'selected' : '' ?>>Sudah Selesai</option>
  </select>
</form>

<body class="container mt-5 text-center">
  <div class="container mt-5 text-center">
  <h2><strong>To Do List</strong></h2>

  <!-- Tombol Tambah (Trigger Modal) -->
  <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
    +
  </button>

  <!-- Modal Pop-up Tambah Tugas -->
  <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content text-start">
        <form action="tambah.php" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahModalLabel">Tambah Tugas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="tugas" class="form-label">Nama Tugas</label>
              <input type="text" name="tugas" class="form-control" placeholder="Nama Tugas" required />
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi Tugas" />
            </div>
            <div class="mb-3">
              <label for="tanggal" class="form-label">Deadline</label>
              <input type="date" name="tanggal" class="form-control" required />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Daftar Tugas -->
  <div class="mt-4">
    <?php while($row = mysqli_fetch_assoc($data)) { ?>
      <div class="card mb-2 mx-auto" style="max-width: 600px;">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div class="text-start">
            <?php if($row['status'] == 'selesai'): ?>
              <i class="bi bi-check-square-fill text-success"></i>
              <s><?= htmlspecialchars($row['nama_tugas']) ?></s>
            <?php else: ?>
              <?= htmlspecialchars($row['nama_tugas']) ?>
            <?php endif; ?>
            <div class="mt-1">
              <span class="prioritas-<?= $row['prioritas'] ?>">Prioritas: <?= ucfirst($row['prioritas']) ?></span>
            </div>
          </div>
          <div>
            <a href="selesai.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm me-1">&#10003;</a>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm me-1">&#9998;</a>
            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">&#128473;</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>