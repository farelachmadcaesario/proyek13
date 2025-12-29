<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container-small">
    <div class="card">
        <h2>Tambah Mahasiswa Baru</h2>
        
        <form action="simpandatamhs.php" method="POST">

            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" placeholder="Contoh: A11.2023.12345" required>
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap..." required>
            </div>

            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempatLahir" placeholder="Masukkan kota lahir..." required>
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggalLahir" required>
            </div>

            <div class="form-group">
                <label>Jumlah Saudara</label>
                <input type="number" name="jmlSaudara" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>Kota</label>
                <select name="kota" required>
                    <option value="">-- Pilih Kota --</option>
                    <option value="Semarang">Semarang</option>
                    <option value="Solo">Solo</option>
                    <option value="Brebes">Brebes</option>
                    <option value="Kudus">Kudus</option>
                    <option value="Demak">Demak</option>
                    <option value="Salatiga">Salatiga</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="radio-group">
                    <label><input type="radio" name="jk" value="L" required> Laki-laki</label>
                    <label><input type="radio" name="jk" value="P" required> Perempuan</label>
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="radio-group">
                    <label><input type="radio" name="statusKeluarga" value="K" required> Kawin</label>
                    <label><input type="radio" name="statusKeluarga" value="B" required> Belum Kawin</label>
                </div>
            </div>

            <div class="form-group">
                <label>Hobi</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="hobi[]" value="Membaca"> Membaca</label>
                    <label><input type="checkbox" name="hobi[]" value="Olahraga"> Olahraga</label>
                    <label><input type="checkbox" name="hobi[]" value="Musik"> Musik</label>
                    <label><input type="checkbox" name="hobi[]" value="Traveling"> Traveling</label>
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="nama@email.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div style="margin-top: 20px;">
                <input type="submit" value="Simpan Data" class="btn btn-primary" style="width: 100%;">
                <a href="tampildatamhs.php" style="display:block; text-align:center; margin-top:10px; text-decoration:none; color:#666;">Batal / Kembali</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>