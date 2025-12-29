<?php
include "koneksi.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function bersih($data){
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

$xnim            = bersih($_POST['nim'] ?? '');
$xnama           = bersih($_POST['nama'] ?? '');
$xtempatLahir    = bersih($_POST['tempatLahir'] ?? '');
$xtanggalLahir   = bersih($_POST['tanggalLahir'] ?? '');
$xtglLahir       = date("Y-m-d", strtotime($xtanggalLahir));
$xjmlSaudara     = bersih($_POST['jmlSaudara'] ?? '');
$xalamat         = bersih($_POST['alamat'] ?? '');
$xkota           = bersih($_POST['kota'] ?? '');
$xjk             = bersih($_POST['jk'] ?? '');  // L / P
$xstatusKeluarga = bersih($_POST['statusKeluarga'] ?? '');  // K / B
$xhobi           = isset($_POST['hobi']) ? implode(", ", $_POST['hobi']) : "";
$xemail          = bersih($_POST['email'] ?? '');
$xraw_password   = bersih($_POST['password'] ?? '');

if (empty($xraw_password) || strlen($xraw_password) < 10) {
    die("Password minimal 10 karakter.");
}

$hashed_password = password_hash($xraw_password, PASSWORD_BCRYPT);

$sql1 = "INSERT INTO `mahasiswa` 
    (`nim`, `nama`, `tempatLahir`, `tanggalLahir`, `jmlSaudara`, `alamat`, `kota`, `jenisKelamin`,
     `statusKeluarga`, `hobi`, `email`, `password`)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $koneksi->prepare($sql1);
if (!$stmt) {
    die("Prepare failed: " . $koneksi->error);
}
$stmt->bind_param(
    "ssssssssssss",
    $xnim, $xnama, $xtempatLahir, $xtglLahir, $xjmlSaudara, $xalamat,
    $xkota, $xjk, $xstatusKeluarga, $xhobi, $xemail, $hashed_password
);

if ($stmt->execute()) {
    echo "Data berhasil disimpan! <br>";
    echo '<a href="tampilDataMhs.php">Lihat Data</a>';
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
?>
