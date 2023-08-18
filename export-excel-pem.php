<?php
include 'db.php';
session_start();

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Pemasukkan_Masjid.xls");

?>

<p align="center" style="font-weight:bold; font-size:16pt;">Laporan Pemasukkan Masjid Ar-Rahmah</p>

<table border="1" align="center">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Sumber Dana</th>
        <th>Total</th>
    </tr>
    <?php
    $no = 1;
    $query_data = mysqli_query($conn, "SELECT * FROM pemasukkan ORDER BY tanggal DESC");
    while ($fetch_data = mysqli_fetch_array($query_data)) {
    ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $fetch_data['tanggal'] ?></td>
            <td><?php echo $fetch_data['sumber'] ?></td>
            <td><?php echo $fetch_data['jumlah'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>