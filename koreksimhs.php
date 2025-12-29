<?php
    session_start();
        if (!isset($_SESSION['username']))  
            {
                header("Location: login.php");
                exit;
            }
include "koneksi.php";

$id = $_GET['kode'];

$stmt = $koneksi->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Data tidak ditemukan!");
}

$hobi_array = explode(", ", $row['hobi']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koreksi Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container-small">
    <div class="card">
        <h2>Koreksi Data Mahasiswa</h2>
        
        <form action="updatedatamhs.php" method="POST">
            
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" value="<?= $row['nim'] ?>" required>
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?= $row['nama'] ?>" required>
            </div>

            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempatLahir" value="<?= $row['tempatLahir'] ?>" required>
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggalLahir" value="<?= $row['tanggalLahir'] ?>" required>
            </div>

            <div class="form-group">
                <label>Jumlah Saudara</label>
                <input type="number" name="jmlSaudara" value="<?= $row['jmlSaudara'] ?>" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" rows="3"><?= $row['alamat'] ?></textarea>
            </div>

            <div class="form-group">
                <label>Kota</label>
                <select name="kota" required>
                    <option value="">-- Pilih Kota --</option>
                    <option value="Semarang" <?= ($row['kota'] == 'Semarang') ? 'selected' : '' ?>>Semarang</option>
                    <option value="Solo" <?= ($row['kota'] == 'Solo') ? 'selected' : '' ?>>Solo</option>
                    <option value="Brebes" <?= ($row['kota'] == 'Brebes') ? 'selected' : '' ?>>Brebes</option>
                    <option value="Kudus" <?= ($row['kota'] == 'Kudus') ? 'selected' : '' ?>>Kudus</option>
                    <option value="Demak" <?= ($row['kota'] == 'Demak') ? 'selected' : '' ?>>Demak</option>
                    <option value="Salatiga" <?= ($row['kota'] == 'Salatiga') ? 'selected' : '' ?>>Salatiga</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="jk" value="L" <?= ($row['jenisKelamin'] == 'L') ? 'checked' : '' ?> required> Laki-laki
                    </label>
                    <label>
                        <input type="radio" name="jk" value="P" <?= ($row['jenisKelamin'] == 'P') ? 'checked' : '' ?> required> Perempuan
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="statusKeluarga" value="K" <?= ($row['statusKeluarga'] == 'K') ? 'checked' : '' ?> required> Kawin
                    </label>
                    <label>
                        <input type="radio" name="statusKeluarga" value="B" <?= ($row['statusKeluarga'] == 'B') ? 'checked' : '' ?> required> Belum Kawin
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Hobi</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="hobi[]" value="Membaca" <?= in_array('Membaca', $hobi_array) ? 'checked' : '' ?>> Membaca</label>
                    <label><input type="checkbox" name="hobi[]" value="Olahraga" <?= in_array('Olahraga', $hobi_array) ? 'checked' : '' ?>> Olahraga</label>
                    <label><input type="checkbox" name="hobi[]" value="Musik" <?= in_array('Musik', $hobi_array) ? 'checked' : '' ?>> Musik</label>
                    <label><input type="checkbox" name="hobi[]" value="Traveling" <?= in_array('Traveling', $hobi_array) ? 'checked' : '' ?>> Traveling</label>
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= $row['email'] ?>" required>
            </div>

            <div class="form-group">
                <label>Password Baru (Opsional)</label>
                <input type="password" name="password" placeholder="Isi hanya jika ingin mengganti password">
                <small style="color: #888;">Biarkan kosong jika tidak ingin mengubah password.</small>
            </div>

            <div style="margin-top: 20px;">
                <input type="submit" value="Update Data" class="btn btn-primary" style="width: 100%;">
                <a href="tampildatamhs.php" style="display:block; text-align:center; margin-top:10px; text-decoration:none; color:#666;">Batal</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>