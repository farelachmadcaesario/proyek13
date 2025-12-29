<?php
    session_start();
        if (!isset($_SESSION['username']))  
            {
                header("Location: login.php");
                exit;
            }

include "koneksi.php";

if (isset($_GET['kode']) && is_numeric($_GET['kode'])) {
    
    $id = $_GET['kode'];

    $sql = "DELETE FROM mahasiswa WHERE id = ? LIMIT 1";
    
    $stmt = $koneksi->prepare($sql);
    
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<script>
                    alert('BERHASIL: 1 Data mahasiswa telah dihapus.'); 
                    window.location='tampildatamhs.php';
                  </script>";
        } else {
            echo "<script>
                    alert('GAGAL: Data tidak ditemukan (Mungkin sudah dihapus sebelumnya).'); 
                    window.location='tampildatamhs.php';
                  </script>";
        }
    } else {
        echo "Gagal menghapus: " . $koneksi->error;
    }

    $stmt->close();

} else {
    echo "<script>
            alert('ERROR: ID Data tidak valid!'); 
            window.location='tampildatamhs.php';
          </script>";
}

$koneksi->close();
?>