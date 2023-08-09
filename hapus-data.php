<?php
include 'db.php';

if (isset($_GET['idpem'])) {
    $hapus_pemasukkan = mysqli_query($conn, "DELETE FROM pemasukkan WHERE id = '" . $_GET['idpem'] . "' ");
    $hapus_lap_pemasukkan = mysqli_query($conn, "DELETE FROM laporankeuangan WHERE id = '" . $_GET['idpem'] . "' ");
    echo '<script>window.location="pemasukkan.php"</script>';
}

if (isset($_GET['idpeng'])) {
    $hapus_pengeluaran = mysqli_query($conn, "DELETE FROM pengeluaran WHERE id = '" . $_GET['idpeng'] . "' ");
    $hapus_lap_pengeluaran = mysqli_query($conn, "DELETE FROM laporankeuangan WHERE id = '" . $_GET['idpeng'] . "' ");
    echo '<script>window.location="pengeluaran.php"</script>';
}

if (isset($_GET['idkeg'])) {
    $hapus_kegiatan = mysqli_query($conn, "DELETE FROM informasikegiatan WHERE id = '" . $_GET['idkeg'] . "' ");
    echo '<script>window.location="kegiatan.php"</script>';
}

if (isset($_GET['idas'])) {
    $hapus_aset = mysqli_query($conn, "DELETE FROM asset WHERE id = '" . $_GET['idas'] . "' ");
    echo '<script>window.location="asset.php"</script>';
}
