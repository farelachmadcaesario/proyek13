<?php
require 'fpdf/fpdf.php';
require 'koneksi.php';

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'LAPORAN DATA MAHASISWA',0,1,'C');
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,'Universitas Dian Nuswantoro',0,1,'C');
        $this->Line(10, 30, 200, 30);
        $this->Ln(15);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$sql = "SELECT * FROM mahasiswa ORDER BY nim ASC";
$result = mysqli_query($koneksi, $sql);

$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages(); 
$pdf->AddPage();

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(230,230,230); 

$pdf->Cell(10, 10, 'No.', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'NIM', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Nama Lengkap', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Tempat Lahir', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Tgl Lahir', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Kota', 1, 1, 'C', true); 

$pdf->SetFont('Arial','',10);
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 8, $no++, 1, 0, 'C');
    $pdf->Cell(30, 8, $row['nim'], 1, 0, 'C');
    $pdf->Cell(50, 8, $row['nama'], 1, 0, 'L'); 
    $pdf->Cell(40, 8, $row['tempatLahir'], 1, 0, 'L');
    $pdf->Cell(30, 8, $row['tanggalLahir'], 1, 0, 'C');
    $pdf->Cell(30, 8, $row['kota'], 1, 1, 'C');
}

$pdf->Output();
?>