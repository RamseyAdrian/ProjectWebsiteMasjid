<?php
session_start();
include 'db.php';

$_SESSION['ex-masuk'] = 0;
$_SESSION['ex-keluar'] = 0;
$_SESSION['ex-saldo'] = 0;

// include autoloader
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

extract($_POST);

if (isset($_POST['export'])) {
    $query = "SELECT * FROM laporankeuangan WHERE tanggal BETWEEN '" . $_SESSION['tanggal_mulai'] . "' AND '" . $_SESSION['tanggal_hingga'] . "' ORDER BY tanggal ";
    $result = mysqli_query($conn, $query);
    $no = 1;
    $saldo = 0;
    $jumlah_masuk = 0;
    $jumlah_keluar = 0;
    $html = '';
    $html .= '
        <h2 align = "center">Laporan Keuangan Masjid Ar-Rahmah</h2>
        <h4 align = "center">' . $_SESSION['tanggal_mulai'] . ' Sampai ' . $_SESSION['tanggal_hingga'] . '</h4>
        <table style = "width:100%; border-collapse:collapse;">
            <tr>
                <th style = "border:1px solid #ddd; padding :5px; text-align:left;">No</th>
                <th style = "border:1px solid #ddd; padding :5px; text-align:left;">Tanggal</th>
                <th style = "border:1px solid #ddd; padding :5px; text-align:left;">Transaksi</th>
                <th style = "border:1px solid #ddd; padding :5px; text-align:left;">Penanggung Jawab</th>
                <th style = "border:1px solid #ddd; padding :5px; text-align:left;">Pemasukan</th>
                <th style = "border:1px solid #ddd; padding :5px; text-align:left;">Pengeluaran</th>
                <th style = "border:1px solid #ddd; padding :5px; text-align:left;">Saldo</th>
            </tr>
    ';

    while ($fetch_data = mysqli_fetch_array($result)) {
        if ($fetch_data['jenis'] == 'Pemasukkan') {
            $saldo = $saldo + $fetch_data['nilai'];
            $jumlah_masuk = $jumlah_masuk + $fetch_data['nilai'];
            $_SESSION['ex-masuk'] = $jumlah_masuk;
            $_SESSION['ex-saldo'] = $saldo;
            $html .= '
                <tr>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $no++ . '</td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $fetch_data['tanggal'] . '</td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $fetch_data['keterangan'] . '</td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $fetch_data['penanggungjawab'] . '</td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $fetch_data['nilai'] . '</td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;"></td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $saldo . '</td>
                </tr>
            ';
        } else {
            $saldo = $saldo - $fetch_data['nilai'];
            $jumlah_keluar -= $fetch_data['nilai'];
            $_SESSION['ex-keluar'] = $jumlah_keluar;
            $_SESSION['ex-saldo'] = $saldo;
            $html .= '
                <tr>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $no++ . '</td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $fetch_data['tanggal'] . '</td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $fetch_data['keterangan'] . '</td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $fetch_data['penanggungjawab'] . '</td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;"></td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $fetch_data['nilai'] . '</td>
                    <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $saldo . '</td>
                </tr>
            ';
        }
    }

    $html .=
        '<tr>
        <td style = "border:1px solid #ddd; padding :5px; text-align:left;">Total</td>
        <td style = "border:1px solid #ddd; padding :5px; text-align:left;"></td>
        <td style = "border:1px solid #ddd; padding :5px; text-align:left;"></td>
        <td style = "border:1px solid #ddd; padding :5px; text-align:left;"></td>
        <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $_SESSION['export_masuk'] . '</td>
        <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $_SESSION['export_keluar'] . '</td>
        <td style = "border:1px solid #ddd; padding :5px; text-align:left;">' . $_SESSION['export_saldo'] . '</td>
        </tr>';

    $html .= '</table>';

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper("A4", "Portrait");
    $dompdf->render();
    $dompdf->stream("Laporan-Keuangan-Masjid-Ar-Rahmah.pdf");
}
