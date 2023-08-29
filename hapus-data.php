<?php
//Mencegah non-user akses page ini
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
include 'db.php';

if (isset($_GET['idpem'])) {
    //Melakukan query untuk mengambil data pemasukkan
    //Bertujuan untuk mengubah nilai di database grafikpemasukan dan grafikperbandingan
    $query_pemasukkan = mysqli_query($conn, "SELECT * FROM pemasukkan WHERE id = '" . $_GET['idpem'] . "' ");

    //Fetch data pemasukkan
    $fetch_pem = mysqli_fetch_array($query_pemasukkan);

    //Fetch nilai uang db pemasukkan
    $fetch_nilai_pem = $fetch_pem['jumlah'];
    //Mengambil tanggal dari data yang ingin dihapus
    $tanggal_pem = $fetch_pem['tanggal'];
    //Mengambil nilai tahun
    $tahun_pem = date('Y', strtotime($tanggal_pem));
    //Mengambil nilai bulan
    $bulan_pem = date('m', strtotime($tanggal_pem));

    $id_db_graf = $tahun_pem . $bulan_pem . '01';

    //Melakukan konversi dari string ke int pada variabel tahun dan bulan
    $tahun_int = intval($tahun_pem);
    $bulan_int = intval($bulan_pem);
    //Deklarasi variabel ID dengan menggabungkan nilai tahun dan bulan
    $id_db_grafpem_str = $tahun_pem . $bulan_pem;
    $id_db_grafpem_int = intval($id_db_grafpem_str);

    //Query db grafikpemasukan berdasarkan tanggal dan bulan
    $query_db_grafikpemasukkan = mysqli_query($conn, "SELECT * FROM grafikpemasukan WHERE tahun = '" . $tahun_int . "' AND bulan = '" . $bulan_pem . "' ");
    //Fetch Data db grafikpemasukan
    $fetch_db_grafik = mysqli_fetch_array($query_db_grafikpemasukkan);
    //Mengambil nilai dari grafikpemasukkan
    $fetch_nilai_db = $fetch_db_grafik['nilai'];

    //Operasi pengurangan nilai untuk db grafikpemasukan
    $nilai_akhir = $fetch_nilai_db - $fetch_nilai_pem;

    $update_db_pemasukkan = mysqli_query($conn, "UPDATE grafikpemasukan SET 
        nilai = '" . $nilai_akhir . "'
        WHERE id = '" . $id_db_grafpem_int . "'
    ");

    $query_db_grafikperbandingan = mysqli_query($conn, "SELECT * FROM grafikperbandingan WHERE id = '" . $tahun_int . "' ");
    $fetch_db_grafikperbandingan = mysqli_fetch_array($query_db_grafikperbandingan);
    $fetch_nilai_saldo = $fetch_db_grafikperbandingan['nilai'];

    $nilai_akhir2 = $fetch_nilai_saldo - $fetch_nilai_pem;

    $update_db_perbandingan = mysqli_query($conn, "UPDATE grafikperbandingan SET 
        nilai = '" . $nilai_akhir2 . "'
        WHERE id = '" . $tahun_int . "'
    ");

    $query_db_grafikperbandingan2 = mysqli_query($conn, "SELECT * FROM grafikperbandingan WHERE id = '" . $id_db_graf . "' ");
    $fetch_db_grafikperbandingan2 = mysqli_fetch_array($query_db_grafikperbandingan2);
    $fetch_nilai_saldo2 = $fetch_db_grafikperbandingan2['nilai'];

    $nilai_akhir3 = $fetch_nilai_saldo2 - $fetch_nilai_pem;

    $update_db_perbandingan2 = mysqli_query($conn, "UPDATE grafikperbandingan SET 
        nilai = '" . $nilai_akhir3 . "'
        WHERE id = '" . $id_db_graf . "'
    ");

    $hapus_pemasukkan = mysqli_query($conn, "DELETE FROM pemasukkan WHERE id = '" . $_GET['idpem'] . "' ");
    $hapus_lap_pemasukkan = mysqli_query($conn, "DELETE FROM laporankeuangan WHERE idLaporan = '" . $_GET['idpem'] . "' ");
    echo '<script>window.location="pemasukkan.php"</script>';
}

if (isset($_GET['idpeng'])) {
    //Query data pengeluaran
    $query_pengeluaran = mysqli_query($conn, "SELECT * FROM pengeluaran WHERE id = '" . $_GET['idpeng'] . "' ");

    //Fetch data pengeluaran
    $fetch_peng = mysqli_fetch_array($query_pengeluaran);

    //Fetch nilai uang db pengeluaran
    $fetch_nilai_peng = $fetch_peng['jumlah'];
    //Mengambil tanggal dari data yang ingin dihapus
    $tanggal_peng = $fetch_peng['tanggal'];
    //Mengambil nilai tahun
    $tahun_peng = date('Y', strtotime($tanggal_peng));
    //Mengambil nilai bulan
    $bulan_peng = date('m', strtotime($tanggal_peng));

    $id_db_graf = $tahun_peng . $bulan_peng . '02';

    //Konversi string ke int pada variabel tahun dan bulan
    $tahun_int = intval($tahun_peng);
    $bulan_int = intval($bulan_peng);

    $query_saldo_perbandingan = mysqli_query($conn, "SELECT * FROM grafikperbandingan WHERE id = '" . $tahun_int . "' ");
    $fetch_saldo_per = mysqli_fetch_array($query_saldo_perbandingan);
    $fetch_nilai_saldo = $fetch_saldo_per['nilai'];

    $saldo_akhir = $fetch_nilai_saldo + $fetch_nilai_peng;

    $update_saldo_perbandingan = mysqli_query($conn, "UPDATE grafikperbandingan SET
        nilai = '" . $saldo_akhir . "'
        WHERE id = '" . $tahun_int . "';
    ");

    $query_keluar_perbandingan = mysqli_query($conn, "SELECT * FROM grafikperbandingan WHERE id = '" . $id_db_graf . "' ");
    $fetch_keluar_per = mysqli_fetch_array($query_keluar_perbandingan);
    $fetch_nilai_keluar = $fetch_keluar_per['nilai'];

    $keluar_akhir = $fetch_nilai_keluar - $fetch_nilai_peng;

    $update_keluar_perbandingan = mysqli_query($conn, "UPDATE grafikperbandingan SET
        nilai = '" . $keluar_akhir . "'
        WHERE id = '" . $id_db_graf . "'
    ");

    $hapus_pengeluaran = mysqli_query($conn, "DELETE FROM pengeluaran WHERE id = '" . $_GET['idpeng'] . "' ");
    $hapus_lap_pengeluaran = mysqli_query($conn, "DELETE FROM laporankeuangan WHERE idLaporan = '" . $_GET['idpeng'] . "' ");
    echo '<script>window.location="pengeluaran.php"</script>';
}

if (isset($_GET['idkeg'])) {
    $hapus_kegiatan = mysqli_query($conn, "DELETE FROM informasikegiatan WHERE id_kegiatan = '" . $_GET['idkeg'] . "' ");
    $hapus_gambar_kegiatan = mysqli_query($conn, "DELETE  FROM gambarkegiatan WHERE id_kegiatan = '" . $_GET['idkeg'] . "' ");
    echo '<script>window.location="kegiatan.php"</script>';
}

if (isset($_GET['idas'])) {
    $hapus_aset = mysqli_query($conn, "DELETE FROM asset WHERE id = '" . $_GET['idas'] . "' ");
    echo '<script>window.location="asset.php"</script>';
}

if (isset($_GET['idak'])) {
    $hapus_akun = mysqli_query($conn, "DELETE FROM `admin` WHERE id = '" . $_GET['idak'] . "' ");
    echo '<script>window.location="kelola-admin.php"</script>';
}
