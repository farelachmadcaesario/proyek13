<?php
    session_start();
        if (!isset($_SESSION['username']))  
            {
                header("Location: login.php");
                exit;
            }
include "koneksi.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function bersih($data){
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}


$id              = $_POST['id'];
$xnim            = bersih($_POST['nim'] ?? '');
$xnama           = bersih($_POST['nama'] ?? '');
$xtempatLahir    = bersih($_POST['tempatLahir'] ?? '');
$xtanggalLahir   = bersih($_POST['tanggalLahir'] ?? '');
$xjmlSaudara     = bersih($_POST['jmlSaudara'] ?? '');
$xalamat         = bersih($_POST['alamat'] ?? '');
$xkota           = bersih($_POST['kota'] ?? '');
$xjk             = bersih($_POST['jk'] ?? '');
$xstatusKeluarga = bersih($_POST['statusKeluarga'] ?? '');
$xhobi           = isset($_POST['hobi']) ? implode(", ", $_POST['hobi']) : "";
$xemail          = bersih($_POST['email'] ?? '');
$xraw_password   = bersih($_POST['password'] ?? '');


if (!empty($xraw_password)) {
    if (strlen($xraw_password) < 10) {
        die("Password baru minimal 10 karakter.");
    }
    $hashed_password = password_hash($xraw_password, PASSWORD_BCRYPT);

    $sql = "UPDATE mahasiswa SET 
            nim=?, nama=?, tempatLahir=?, tanggalLahir=?, jmlSaudara=?, 
            alamat=?, kota=?, jenisKelamin=?, statusKeluarga=?, hobi=?, 
            email=?, password=? 
            WHERE id=?";
            
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssssssssssssi", 
        $xnim, $xnama, $xtempatLahir, $xtanggalLahir, $xjmlSaudara, 
        $xalamat, $xkota, $xjk, $xstatusKeluarga, $xhobi, 
        $xemail, $hashed_password, $id);

} else {
    $sql = "UPDATE mahasiswa SET 
            nim=?, nama=?, tempatLahir=?, tanggalLahir=?, jmlSaudara=?, 
            alamat=?, kota=?, jenisKelamin=?, statusKeluarga=?, hobi=?, 
            email=? 
            WHERE id=?";
            
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssssssssssi", 
        $xnim, $xnama, $xtempatLahir, $xtanggalLahir, $xjmlSaudara, 
        $xalamat, $xkota, $xjk, $xstatusKeluarga, $xhobi, 
        $xemail, $id);
}

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil diperbarui!'); window.location='tampildatamhs.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
?>