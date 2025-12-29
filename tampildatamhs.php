<?php
    session_start();
        if (!isset($_SESSION['username']))  
            {
                header("Location: login.php");
                exit;
            }
    include "koneksi.php";
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $data = mysqli_query($koneksi, "SELECT * FROM `mahasiswa` ORDER BY `id` DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin: 0;">Daftar Mahasiswa</h2>
            <div style="display: flex; gap: 10px;">
                <a href="tambahdatamhs.php" class="btn btn-primary btn-add">
                    + Tambah Data
                </a>
                <a href="cetak_pdf.php" target="_blank" class="btn btn-success btn-add">
                    Cetak PDF
                </a>
            </div>
        </div>  
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>TTL</th>
                        <th>Kota</th>
                        <th>JK</th>
                        <th>Status</th>
                        <th>Hobi</th>
                        <th>Email</th>
                        <th>Password</th> 
                        <th>Aksi</th> </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($data)) : 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><span style="font-weight:bold;"><?= $row['nim'] ?></span></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['tempatLahir'] ?>, <?= $row['tanggalLahir'] ?></td>
                        <td><?= $row['kota'] ?></td>
                        <td>
                            <?php if($row['jenisKelamin'] == 'L') { ?>
                                <span class="badge badge-blue">Laki-laki</span>
                            <?php } else { ?>
                                <span class="badge badge-pink">Perempuan</span>
                            <?php } ?>
                        </td>
                        <td><?= ($row['statusKeluarga'] == 'K') ? 'Kawin' : 'Belum Kawin'; ?></td>
                        <td><?= $row['hobi'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td style="color: #ccc;">•••••••</td> 
                        
                        <td>
                            <div class="action-buttons">
                                <a href="koreksimhs.php?kode=<?= $row['id']?>" class="btn btn-sm btn-warning">Edit</a>
                                
                                <a href="hapusdatamhs.php?kode=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data <?= $row['nama'] ?>?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
        <?php if(mysqli_num_rows($data) == 0): ?>
            <p style="text-align:center; padding: 20px; color: #888;">Belum ada data mahasiswa.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>