<?php
session_start();

// Jika sudah login, langsung ke halaman utama
if (isset($_SESSION['username'])) {
    header("Location: tampildatamhs.php");
    exit;
}

require_once "koneksi.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitasi input
    $nim      = trim($_POST['nim']);
    $password = trim($_POST['passw']);

    if (!empty($nim) && !empty($password)) {

        // PERBAIKAN 1: Nama Tabel harus 'mahasiswa', bukan 'mhs'
        // PERBAIKAN 2: Ambil kolom 'password' dan 'nama', bukan 'pass'
        $sql = "SELECT nim, nama, password FROM mahasiswa WHERE nim = ? LIMIT 1";
        
        $stmt = mysqli_prepare($koneksi, $sql);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $nim);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) === 1) {
                $data = mysqli_fetch_assoc($result);

                // Verifikasi Password Hash
                // Pastikan kolom database bernama 'password'
                if (password_verify($password, $data['password'])) {
                    
                    // Set Session
                    $_SESSION['username'] = $data['nim'];
                    $_SESSION['nama']     = $data['nama']; // Opsional: Simpan nama biar bisa disapa
                    
                    // PERBAIKAN 3: Redirect ke nama file yang benar (huruf kecil)
                    header("Location: tampildatamhs.php");
                    exit;
                } else {
                    $error = "Password yang Anda masukkan salah.";
                }
            } else {
                $error = "NIM tidak ditemukan.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = "Terjadi kesalahan query database.";
        }
    } else {
        $error = "NIM dan Password wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Override sedikit untuk posisi tengah */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container-small {
            width: 100%;
            max-width: 400px; /* Lebih kecil khusus login */
        }
    </style>
</head>
<body>

<div class="container-small">
    <div class="card">
        <h2 style="text-align:center;">Login Sistem</h2>
        <p style="text-align:center; color:#666; margin-bottom:20px;">Masukkan NIM dan Password Anda</p>

        <?php if (!empty($error)) : ?>
            <div style="background:#ffe3e3; color:#e03131; padding:10px; border-radius:4px; margin-bottom:15px; font-size:14px; text-align:center;">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" placeholder="Masukkan NIM..." required autofocus>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="passw" placeholder="Masukkan Password..." required>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:10px;">Masuk</button>
        </form>
        
        <div style="text-align:center; margin-top:15px; font-size:13px;">
            Belum punya akun? <a href="tambahdatamhs.php" style="color:var(--primary); text-decoration:none;">Daftar di sini</a>
        </div>
    </div>
</div>

</body>
</html>