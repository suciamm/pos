<?php
require_once('tcpdf/tcpdf.php');

// Membuat instance TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set informasi dokumen
$pdf->SetCreator('ATI Store');
$pdf->SetAuthor('ATI Store');
$pdf->SetTitle('Laporan Penjualan');
$pdf->SetSubject('Laporan Penjualan');
$pdf->SetKeywords('TCPDF, PDF, laporan, penjualan');

// Add halaman
$pdf->AddPage();

// // Add halaman
// $pdf->AddPage();

// // Teks header
// $html = '<h1 style="text-align:center;">Laporan Penjualan</h1>';
// $html .= '<p style="text-align:right;">Tanggal: ' . date('M d, Y H:i:s A') . '</p>';
// $html .= '<p style="text-align:right;">Kode Penjualan: ' . base64_decode($_GET['id']) . '</p>';
// $html .= '<p style="text-align:right;">Metode Pembayaran: ' . strtoupper(base64_decode($_GET['pay'])) . '</

// Teks header
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Penjualan', 0, 1, 'C');

$pdf->Ln(5); // Spasi

// Informasi pembayaran
$pdf->SetFont('helvetica', '', 12);
$sales_code = base64_decode($_GET['id']);
$payment = strtolower(base64_decode($_GET['pay']));
$pdf->Cell(0, 10, 'Metode Pembayaran: ' . strtoupper($payment), 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, 'Tanggal: ', 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, date('M d, Y H:i:s A'), 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, 'Kode Penjualan: ', 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $sales_code, 0, 1);

$pdf->Ln(5); // Spasi

// Tabel detail pesanan
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, 'ITEM', 1, 0, 'C');
$pdf->Cell(30, 10, 'QTY', 1, 0, 'C');
$pdf->Cell(45, 10, 'HARGA', 1, 0, 'C');
$pdf->Cell(45, 10, 'SUBTOTAL', 1, 1, 'C');

// Data detail pesanan (diganti dengan data Anda)
$order_detail = [
    ['product' => 'Produk A', 'qty' => 2, 'price' => 50000, 'subtotal' => 100000],
    ['product' => 'Produk B', 'qty' => 1, 'price' => 75000, 'subtotal' => 75000]
];

$pdf->SetFont('helvetica', '', 12);
foreach ($order_detail as $item) {
    $pdf->Cell(45, 10, $item['product'], 1, 0);
    $pdf->Cell(30, 10, $item['qty'], 1, 0, 'C');
    $pdf->Cell(45, 10, 'Rp ' . number_format($item['price'], 0, ',', '.'), 1, 0, 'R');
    $pdf->Cell(45, 10, 'Rp ' . number_format($item['subtotal'], 0, ',', '.'), 1, 1, 'R');
}

$pdf->Ln(5); // Spasi

